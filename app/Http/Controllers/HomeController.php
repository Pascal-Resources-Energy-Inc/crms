<?php

namespace App\Http\Controllers;
use App\Transaction;
use App\Dealer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Client;
use Illuminate\Support\Collection;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
    public function index(Request $request)
    {
        $dealer = null;
        $customer = null;
        $threeDaysAgo = Carbon::now()->subDays(7)->toDateString();

        // Get selected year and month
        $selectedYear = $request->get('year', Carbon::now()->year);
        $selectedMonth = $request->get('month', null);
        $viewType = $selectedMonth ? 'monthly' : 'yearly';

        // Customers with last transaction older than 7 days
        $customers_less = Client::whereDoesntHave('latestTransaction', function ($q) use ($threeDaysAgo) {
                $q->where('date', '>=', $threeDaysAgo);
            })
            ->whereHas('latestTransaction')
            ->orderByDesc(
                DB::raw('(SELECT date FROM transaction_details 
                        WHERE transaction_details.client_id = clients.id 
                        ORDER BY date DESC LIMIT 1)')
            )
            ->limit(50) // 🔹 LIMIT results to avoid huge memory usage
            ->get();

        // Only fetch IDs & names for dropdowns
        $customers = Client::select('id', 'name')
            ->whereHas('transactions')
            ->get();

        // If logged in as Dealer
         $transactions_details = TransactionDetail::select('id', 'price', 'qty', 'date', 'client_id', 'points_dealer', 'points_client')
            ->orderByDesc('id')
            ->limit(20)
            ->get();
            
        $total_qty = TransactionDetail::sum('qty');
        if (auth()->user()->role == "Dealer") {
            $dealer = Dealer::select('id', 'user_id', 'name')
                ->where('user_id', auth()->user()->id)
                ->first();

            $transactions_details = TransactionDetail::where('dealer_id', auth()->user()->id)
                ->select('id', 'price', 'qty', 'date', 'client_id', 'points_dealer')
                ->orderByDesc('id')
                ->limit(500) // 🔹 Only load latest 500 for dashboard
                ->get();

            $total_sales = TransactionDetail::where('dealer_id', auth()->user()->id)
                ->select(DB::raw('SUM(price * qty) as total'))
                ->value('total');
            $total_qty = TransactionDetail::where('dealer_id', auth()->user()->id)->sum('qty');
        }

        // If logged in as Client
        elseif (auth()->user()->role == "Client") {
           $customer = Client::with('serial')
            ->where('user_id', auth()->id()) // shorthand for auth()->user()->id
            ->select('id', 'user_id', 'name')
            ->first();

            $transactions_details = TransactionDetail::where('client_id', $customer->id)
                ->select('id', 'price', 'qty', 'date', 'dealer_id', 'points_client')
                ->orderByDesc('id')
                ->limit(500)
                ->get();

            $total_sales = TransactionDetail::where('client_id', $customer->id)
                ->select(DB::raw('SUM(price * qty) as total'))
                ->value('total');

                $total_qty = TransactionDetail::where('client_id', auth()->user()->id)->sum('qty');
        }

        // 🔹 Only calculate global total if dealer/client total isn't already set
        if (!isset($total_sales)) {
            $total_sales = TransactionDetail::select(DB::raw('SUM(price * qty) as total'))
                ->value('total');
        }

        // Chart data
        $chartData = $viewType === 'monthly'
            ? $this->getDailyData($selectedYear, $selectedMonth)
            : $this->getMonthlyData($selectedYear);

        $categories = $chartData['categories'];
        $qty = $chartData['qty'];

        // Dropdown options
        $availableYears = $this->getAvailableYears();
        $availableMonths = $this->getAvailableMonths($selectedYear);

        // Dealers leaderboard
        $dealers = TransactionDetail::select(
                'dealer_id',
                DB::raw('SUM(points_dealer) as total_points'),
                DB::raw('MAX(date) as latest_transaction')
            )
            ->with(['dealer:id,name']) // 🔹 Only load dealer id & name
            ->groupBy('dealer_id')
            ->orderByDesc('total_points')
            ->limit(20) // 🔹 Prevent large dataset
            ->get();

        // Top customers
        $top_customers = TransactionDetail::select(
                'client_id',
                DB::raw('SUM(points_client) as total_points'),
                DB::raw('MAX(created_at) as latest_transaction')
            )
            ->with(['customer:id,name']) // 🔹 Only load customer id & name
            ->whereNotNull('client_id')
            ->groupBy('client_id')
            ->orderByDesc('total_points')
            ->limit(10)
            ->get();

        // Trends
        $salesTrend = $this->calculateSalesTrend();
        $qtyTrend = $this->calculateQtyTrend();

        return view('home', [
            'transactions_details' => $transactions_details ?? collect(),
            'dealers' => $dealers,
            'categories' => $categories,
            'qty' => $qty,
            'customers' => $customers,
            'dealer' => $dealer,
            'customer' => $customer,
            'customers_less' => $customers_less,
            'total_sales' => $total_sales,
            'top_customers' => $top_customers,
            'sales_trend' => $salesTrend,
            'qty_trend' => $qtyTrend,
            'available_years' => $availableYears,
            'available_months' => $availableMonths,
            'selected_year' => $selectedYear,
            'selected_month' => $selectedMonth,
            'view_type' => $viewType,
            'total_qty' => $total_qty,
        ]);
    }

    public function getChartDataAjax(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $month = $request->get('month', null);
        $viewType = $month ? 'monthly' : 'yearly';
        
        if (!is_numeric($year) || $year < 1900 || $year > Carbon::now()->year + 10) {
            return response()->json(['error' => 'Invalid year'], 400);
        }
        
        if ($month !== null && (!is_numeric($month) || $month < 1 || $month > 12)) {
            return response()->json(['error' => 'Invalid month'], 400);
        }
        
        if ($viewType === 'monthly') {
            $chartData = $this->getDailyData($year, $month);
        } else {
            $chartData = $this->getMonthlyData($year);
        }
        
        $availableMonths = $this->getAvailableMonths($year);
        
        $totalRecords = DB::table('transaction_details')
            ->whereYear('created_at', $year)
            ->when($month, function ($query) use ($year, $month) {
                return $query->whereMonth('created_at', $month);
            })
            ->count();
        
        return response()->json([
            'categories' => $chartData['categories'],
            'qty' => $chartData['qty'],
            'year' => (int) $year,
            'month' => $month ? (int) $month : null,
            'view_type' => $viewType,
            'available_months' => $availableMonths,
            'total_records' => $totalRecords,
            'debug' => [
                'requested_year' => $year,
                'requested_month' => $month,
                'data_found' => $totalRecords > 0
            ]
        ]);
    }

    /**
     * Get monthly sales data for a specific year
     */
    private function getMonthlyData($year)
    {
        $year = (int) $year;
        
        $sales = DB::table('transaction_details')
            ->selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month_name, SUM(qty) as total_qty')
            ->whereYear('created_at', $year)
            ->whereNotNull('created_at')
            ->groupBy(DB::raw('MONTH(created_at), MONTHNAME(created_at)'))
            ->orderBy('month_number')
            ->get();

        $salesData = $sales->keyBy('month_number');

        $allMonths = collect(range(1, 12))->map(function ($monthNumber) use ($salesData) {
            $monthData = $salesData->get($monthNumber);
            return [
                'month' => Carbon::create()->month($monthNumber)->format('F'),
                'total_qty' => $monthData ? (int) $monthData->total_qty : 0,
            ];
        });

        $categories = $allMonths->pluck('month')->toArray();
        $qty = $allMonths->pluck('total_qty')->toArray();

        return [
            'categories' => $categories,
            'qty' => $qty
        ];
    }

    /**
     * Get daily sales data for a specific year and month
     */
    private function getDailyData($year, $month)
    {
        $year = (int) $year;
        $month = (int) $month;
        
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        
        $sales = DB::table('transaction_details')
            ->selectRaw('DAY(created_at) as day_number, SUM(qty) as total_qty')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereNotNull('created_at')
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy('day_number')
            ->get();

        $salesData = $sales->keyBy('day_number');

        $allDays = collect(range(1, $daysInMonth))->map(function ($dayNumber) use ($salesData) {
            $dayData = $salesData->get($dayNumber);
            return [
                'day' => $dayNumber,
                'total_qty' => $dayData ? (int) $dayData->total_qty : 0,
            ];
        });

        $categories = $allDays->pluck('day')->toArray();
        $qty = $allDays->pluck('total_qty')->toArray();

        return [
            'categories' => $categories,
            'qty' => $qty
        ];
    }

   
    private function getAvailableYears()
    {
        $years = DB::table('transaction_details')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->whereNotNull('created_at')
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($years)) {
            $years = [Carbon::now()->year];
        }

        return $years;
    }

    /**
     * Get available months for a specific year
     */
    private function getAvailableMonths($year)
    {
        $months = DB::table('transaction_details')
            ->selectRaw('DISTINCT MONTH(created_at) as month_number, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', $year)
            ->whereNotNull('created_at')
            ->orderBy('month_number')
            ->get()
            ->map(function ($month) {
                return [
                    'number' => $month->month_number,
                    'name' => $month->month_name
                ];
            })
            ->toArray();

        return $months;
    }

    private function calculateSalesTrend()
    {
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;
        
        $currentYearSales = TransactionDetail::whereYear('created_at', $currentYear)->sum('price');
        $previousYearSales = TransactionDetail::whereYear('created_at', $previousYear)->sum('price');
        
        if ($previousYearSales == 0) {
            return [
                'percentage' => $currentYearSales > 0 ? 100 : 0,
                'trend' => $currentYearSales > 0 ? 'up' : 'neutral',
                'icon' => $currentYearSales > 0 ? 'ti-trending-up' : 'ti-minus'
            ];
        }
        
        $percentageChange = (($currentYearSales - $previousYearSales) / $previousYearSales) * 100;
        
        return [
            'percentage' => round(abs($percentageChange), 2),
            'trend' => $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'neutral'),
            'icon' => $percentageChange > 0 ? 'ti-trending-up' : ($percentageChange < 0 ? 'ti-trending-down' : 'ti-minus')
        ];
    }

    private function calculateQtyTrend()
    {
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;
        
        $currentYearQty = TransactionDetail::whereYear('created_at', $currentYear)->sum('qty');
        $previousYearQty = TransactionDetail::whereYear('created_at', $previousYear)->sum('qty');
        
        if ($previousYearQty == 0) {
            return [
                'percentage' => $currentYearQty > 0 ? 100 : 0,
                'trend' => $currentYearQty > 0 ? 'up' : 'neutral',
                'icon' => $currentYearQty > 0 ? 'ti-trending-up' : 'ti-minus'
            ];
        }
        
        $percentageChange = (($currentYearQty - $previousYearQty) / $previousYearQty) * 100;
        
        return [
            'percentage' => round(abs($percentageChange), 2),
            'trend' => $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'neutral'),
            'icon' => $percentageChange > 0 ? 'ti-trending-up' : ($percentageChange < 0 ? 'ti-trending-down' : 'ti-minus')
        ];
    }

    public function about()
    {
        return view('about');
    }
    
    public function storelocation()
    {
        $dealers = $this->getFormattedDealers();
        $customers = $this->getFormattedCustomers();
        $locations = $dealers->concat($customers);
        return view('storelocation', compact('locations'));
    }

    public function getLocationsForMap()
    {
        $dealers = $this->getFormattedDealers(true);
        $customers = $this->getFormattedCustomers(true);
        $locations = $dealers->concat($customers);
        return response()->json($locations);
    }

    public function getLocationDetails($id, $type)
    {
        $location = null;

        if ($type === 'dealer') {
            $location = Dealer::select('id', 'name', 'address', 'store_name', 'store_type', 'number', 'email_address', 'latitude', 'longitude')
                ->where('id', $id)
                ->where('status', 'Active')
                ->first();

            if ($location) {
                $location->location_type = 'dealer';
            }
        } elseif ($type === 'customer') {
            $location = Client::select('id', 'name', 'address', 'number', 'email_address')
                ->where('id', $id)
                ->first();

            if ($location) {
                $location->store_name = $location->name;
                $location->store_type = null;
                $location->location_type = 'customer';
                $location->latitude = null;
                $location->longitude = null;
            }
        }

        if (!$location) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        return response()->json($location);
    }

    private function getFormattedDealers($withCoordinates = false)
    {
        $columns = ['id', 'name', 'address', 'store_name', 'store_type', 'number', 'email_address'];

        if ($withCoordinates) {
            $columns[] = 'latitude';
            $columns[] = 'longitude';
        }

        return Dealer::select($columns)
            ->where('status', 'Active')
            ->whereNotNull('address')
            ->get()
            ->map(function ($dealer) {
                $dealer->location_type = 'dealer';
                return $dealer;
            });
    }

    private function getFormattedCustomers($withCoordinates = false)
    {
        $customers = Client::select('id', 'name', 'address', 'number', 'email_address')
            ->whereNotNull('address')
            ->get()
            ->map(function ($customer) use ($withCoordinates) {
                $customer->store_name = $customer->name;
                $customer->store_type = null;
                $customer->location_type = 'customer';

                if ($withCoordinates) {
                    $customer->latitude = null;
                    $customer->longitude = null;
                }

                return $customer;
            });

        return $customers;
    }
}