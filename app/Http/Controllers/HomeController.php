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
    public function index()
    {
        $dealer = "";
        $customer = "";
       $threeDaysAgo = Carbon::now()->subDays(3)->toDateString();
        $customers_less = Client::whereDoesntHave('latestTransaction', function ($q) use ($threeDaysAgo) {
            $q->where('date', '>', $threeDaysAgo);
        })
        // ->with('latestTransaction')
        ->orderBy(
            DB::raw('(SELECT date FROM transaction_details WHERE transaction_details.client_id = clients.id ORDER BY date DESC LIMIT 1)'),
            'desc'
        )
        ->get();
// dd($customers_less);
        $customers = Client::whereHas('transactions')->get();
        $currentYear = Carbon::now()->year;
        $transactions = Transaction::orderBy('id','desc')->get();
        $dealers = Dealer::get();
        $transactions_details = TransactionDetail::orderBy('id','desc')->get();
        
        $currentYear = Carbon::now()->year;

         if(auth()->user()->role == "Dealer")
        {
            $dealer = Dealer::with('sales')->where('user_id',auth()->user()->id)->first();
             $transactions_details = TransactionDetail::where('dealer_id',auth()->user()->id)->orderBy('id','desc')->get();
        }
         if(auth()->user()->role == "Client")
        {
                $customer = Client::where('user_id',auth()->user()->id)->first();
             $transactions_details = TransactionDetail::where('client_id',$customer->id)->orderBy('id','desc')->get();
        }

        // Step 1: Fetch monthly sales
        $sales = DB::table('transaction_details')
            ->selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month_name, SUM(qty) as total_qty')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at), MONTHNAME(created_at)'))
            ->orderBy('month_number')
            ->get()
            ->keyBy('month_number');

        // Step 2: Generate full months with default qty = 0
        $allMonths = collect(range(1, 12))->map(function ($monthNumber) use ($sales) {
            return [
                'month' => Carbon::create()->month($monthNumber)->format('F'), // Full month name
                'total_qty' => $sales->get($monthNumber)->total_qty ?? 0,
            ];
        });

        // Step 3: Separate into categories and qty arrays
        $categories = $allMonths->pluck('month')->toArray();
        $qty = $allMonths->pluck('total_qty')->toArray();   

      $dealers = TransactionDetail::select(
            'dealer_id',
            DB::raw('SUM(points_dealer) as total_points'),
            DB::raw('MAX(created_at) as latest_transaction')
        )
        ->with('dealer') // eager load the related dealer
        ->groupBy('dealer_id')
        ->orderByDesc('total_points')
        ->get();

        return view('home',
            array(
            
            'transactions' => $transactions,
            'transactions_details' => $transactions_details,
            'dealers' => $dealers,
            'categories' =>  $categories,
            'qty' =>  $qty,
            'customers' =>  $customers,
            'dealer' =>  $dealer,
            'customer' =>  $customer,
            'customers_less' =>  $customers_less,
            

            )
        );
    }
}
