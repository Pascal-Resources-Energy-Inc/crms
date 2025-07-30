@extends('layouts.header')
@section('header')

<link rel="stylesheet" href="{{asset('design/assets/libs/jvectormap/jquery-jvectormap.css')}}">
@endsection
@section('content')

<!--  Header End -->
          <!-- Welcome Section Start -->
          @if(auth()->user()->role == "Admin")
          @include('alert')
          <section class="welcome">
            <div class="row">
              <div class="col-lg-12 col-xl-6 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body position-relative">
                    <div>
                      <h5 class="mb-1 fw-bold">Welcome {{auth()->user()->name ?? ''}}</h5>
                      {{-- <p class="fs-3 mb-3 pb-1">Check all the statistics</p> --}}
                      {{-- <button class="btn btn-primary rounded-pill" type="button">
                        Visit Now
                      </button> --}}
                    </div>
                    <div class="school-img d-none d-sm-block">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>

                    <div class="d-sm-none d-block text-center">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-xl-6">
                <div class="row">
                  <div class="col-sm-4 d-flex align-items-strech">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                      <div class="card-body p-4">
                        <div class="mb-7">
                          <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                        </div>
                        <h5 class="text-white fw-bold fs-14 text-nowrap">
                          {{number_format($transactions_details->sum('qty'),2)}} 
                        </h5>
                        <p class="opacity-50 mb-0 ">Qty Sold</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4 d-flex align-items-strech">
                    <div class="card danger-card overflow-hidden text-bg-primary w-100">
                      <div class="card-body p-4">
                        <div class="mb-7">
                          <i class="ti ti-current-location fs-8 fw-lighter"></i>
                        </div>
                        <h5 class="text-white fw-bold fs-14">
                          {{count($dealers)}} 
                        </h5>
                        <p class="opacity-50 mb-0">Dealer</p>
                      </div>
                    </div>
                  </div>  

                  <div class="col-sm-4 d-flex align-items-strech">
                    <div class="card info-card overflow-hidden text-bg-primary w-100">
                      <div class="card-body p-4">
                        <div class="mb-7">
                          <i class="ti ti-user fs-8 fw-lighter"></i>
                        </div>
                        <h5 class="text-white fw-bold fs-14 text-nowrap">
                         {{$customers->count()}} 
                        </h5>
                        <p class="opacity-50 mb-0">Customers</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
                <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
                  <div class="card w-100">
                    <div class="card-body">
                      <h5>Refill Sold Quantity({{date('Y')}})</h5>
                      <div id="chart-bar-stacked"></div>
                    </div>
                  </div>
                </div>
                {{-- <div class="col-lg-12 col-xl-6 d-flex align-items-stretch">
                  <div class="card w-100">
                   
                    <div class="card-body">
                      <h5>Stove Distributed(2025)</h5>
                      <div id="chart-bar-stacked-stove"></div>
                      <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="fs-4 mb-0 fw-bold">Stove Goals</h5>
                        <p class="text-primary fw-normal fs-3 mb-0">100</p>
                      </div>
                      <div class="progress bg-light-subtle" style="height: 10px">
                        <div class="progress-bar bg-primary  rounded" style="width: 35%;height: 10px;" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">35%</div>
                      </div>
                     
                    </div>
                  </div>
                </div> --}}
              </div>
          </section>
          <section>
            <div class="row">
              <div class="col-lg-7 col-xl-7 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex mb-4 justify-content-between align-items-center">
                      <h5 class="mb-0 fw-bold">Latest Transaction</h5>
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-muted">Show</span>
                        <select class="form-select form-select-sm me-2" id="entriesPerPage" onchange="updateTableEntries()" style="width: auto;">
                          <option value="10" selected>10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select>
                        <span class="text-muted">entries</span>
                      </div>
                    </div>

                    
                    <div class="table-responsive" data-simplebar>
                      <table class="table table-borderless align-middle text-nowrap">
                        <thead>
                        <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Customer Points</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-table-body">
                          @foreach($transactions_details as $index => $transaction)
                            <tr class="transaction-row" data-customer-id="{{$transaction->customer->id ?? 0}}" 
                                style="{{$index >= 10 ? 'display: none;' : ''}}">
                              <td>{{date('M d, Y',strtotime($transaction->date))}}</td>
                              <td>
                                <a style="cursor: pointer"
                                  class="customer-link text-decoration-none fw-bold text-primary" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#transactionModal" 
                                  onclick="showTransactionDetails('{{date('M d, Y',strtotime($transaction->created_at))}}', '{{number_format($transaction->qty,2)}}', '{{number_format($transaction->qty*$transaction->price,2)}}', '{{strtoupper($transaction->dealer->name ?? '')}}', '{{strtoupper($transaction->customer->name ?? '')}}', '{{$transaction->points_dealer}}', '{{$transaction->points_client}}', '{{$transaction->item}}')">
                                  {{strtoupper($transaction->customer->name ?? 'Unknown')}}
                                </a>
                              </td>
                              <td><span class='text-success'>{{$transaction->points_client}}</span></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <small class="text-muted" id="entriesInfo">
                        Showing 1 to {{min(10, $transactions_details->count())}} of {{$transactions_details->count()}} entries
                    </small>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="transactionModalLabel">Transaction Details <span id="customerName" style="display:none"></span></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive">
                        <table class="table table-striped align-middle text-nowrap">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Dealer</th>
                              <th scope="col">Customer</th>
                              <th scope="col">Dealer Points</th>
                              <th scope="col">Customer Points</th>
                              <th scope="col">Item</th>
                            </tr>
                          </thead>
                          <tbody id="customerTransactions">
                            <!-- Customer transactions will be here -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-xl-5 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex mb-4 justify-content-between align-items-center">
                       <h5 class="mb-0 fw-bold">Top 10 Dealers</h5>
                    </div>
                        <div class="table-responsive" data-simplebar>
                          <small>
                        <table class="table table-borderless align-middle table-bordered table-striped text-nowrap">
                          <thead>
                          <tr>
                                  <th scope="col">Dealer</th>
                                  <th scope="col">Total Points</th>
                                  <th scope="col">Last Transaction</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($dealers as $dealer)
                              <tr>
                                <td>{{strtoupper( $dealer->dealer->name ?? 'Unknown' )}}</td>
                                <td>{{number_format($dealer->total_points,2)}}</td>
                                <td>{{date('M d, Y',strtotime($dealer->latest_transaction))}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                          </small>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
          @endif
          @if(auth()->user()->role == "Dealer")

          <section class="welcome">
            <div class="row">
              <div class="col-lg-12 col-xl-6 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body position-relative">
                    <div>
                      <h5 class="mb-1 fw-bold">Welcome  {{auth()->user()->name}}</h5>
                      {{-- <p class="fs-3 mb-3 pb-1">Check all the statistics</p> --}}
                      <a href='{{url('user-profile')}}' ><button class="btn btn-primary rounded-pill" type="button">
                       View Profile
                      </button>
                      </a>
                    </div>
                    <div class="school-img d-none d-sm-block">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>

                    <div class="d-sm-none d-block text-center">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-xl-6 text-left">
                <div class="card w-100 stretch">
                  <div class="card-body position-relative ">
                    <div class='row'>
                      
                      <div class="col-lg-12 col-xl-6">
                        Dealer ID: {{date('Y',strtotime($dealer->created_at))}}-{{$dealer->id}}<br>
                        Name: {{$dealer->name}} <br>
                        Contact No.: {{$dealer->number}} <br>
                        Registered: {{date('M d,Y',strtotime($dealer->created_at))}} <br>
                      </div>
                    </div>
                   
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-success">
                        <i class="ti ti-credit-card fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Total Points</h4>
                        <span class="text-muted">Earned</span>
                      </div>
                      <div class="ms-auto align-self-center">
                        <h2 class="fs-7 mb-0">{{($dealer->sales)->sum('points_dealer')}}</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-warning">
                        <i class="ti ti-box-multiple fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Quantity </h4>
                        <span class="text-muted">Sold</span>
                      </div>
                      <div class="ms-auto align-self-center">
                        <h2 class="fs-7 mb-0">{{($dealer->sales)->sum('qty')}}</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-danger">
                        <i class="ti ti-currency-dollar fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Inventory </h4>
                        <span class="text-muted"><small>as of {{date('M d, Y')}}</small></span>
                      </div>
                      <div class="ms-auto align-self-center">
                        <h5 class="fs-7 mb-0">0.00</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
          @endif
          @if(auth()->user()->role == "Client")

          <section class="welcome">
            <div class="row">
              <div class="col-lg-12 col-xl-6 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body position-relative">
                    <div>
                      <h5 class="mb-1 fw-bold">Welcome {{auth()->user()->name}}</h5>
                      <p class="fs-3 mb-3 pb-1">Check all the statistics</p>
                      <a href='{{url('/user-profile')}}'><button class="btn btn-primary rounded-pill" type="button">
                       View Profile
                      </button>
                      </a>
                    </div>
                    <div class="school-img d-none d-sm-block">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>

                    <div class="d-sm-none d-block text-center">
                      <img src="{{asset('design//assets/images/backgrounds/school.png')}}" class="img-fluid" alt="" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-xl-6 text-left">
                <div class="card w-100 stretch">
                  <div class="card-body position-relative ">
                    <div class='row'>
                      <div class="col-lg-12 col-xl-4">
                        
                          <div id="qrcode"></div>
                        
                      </div>
                      <div class="col-lg-12 col-xl-6">
                        Serial Number ID: {{$customer->serial->serial_number}}<br>
                        Name: {{$customer->name}} <br>
                        Contact No.: {{$customer->number}} <br>
                        Registered: {{date('M d, Y',strtotime($customer->created_at))}} <br>
                      </div>
                    </div>
                   
                    
                  </div>
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-success">
                        <i class="ti ti-credit-card fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Total Points</h4>
                        <span class="text-muted">Earned</span>
                      </div>
                      <div class="ms-auto align-self-center">
                        <h2 class="fs-7 mb-0">{{($customer->transactions)->sum('points_client')}}</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-warning">
                        <i class="ti ti-box-multiple fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Quantity </h4>
                        <span class="text-muted">Purchased</span>
                      </div>
                      <div class="ms-auto align-self-center">
                        <h2 class="fs-7 mb-0">{{($customer->transactions)->sum('qty')}}</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-4 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex flex-row">
                      <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-danger">
                        <i class="ti ti-currency-dollar fs-6"></i>
                      </div>
                      <div class="ms-3 align-self-center">
                        <h4 class="mb-0 fs-5">Last </h4>
                        <span class="text-muted">Purchased</span>
                      </div>
                      <div class="ms-auto align-self-center">
                        @php
                            $trans = $transactions_details->first();
                        @endphp
                        <h5 class="fs-7 mb-0">
                          @if($trans)
                            {{date('M d, Y',strtotime($trans->created_at))}}
                          @else
                          No Data
                          @endif
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
          <!-- Welcome Section End -->

          <!-- Profit Section Start -->
       
          <!-- Profit Section End -->

          <!-- Grades Start -->
          <!-- Grades End -->

          <!-- Educators Start -->
          <section>
           <div class="row">
              <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex mb-4 justify-content-between align-items-center">
                      <h5 class="mb-0 fw-bold">Purchase History</h5>

                 
                    </div>

                    <div class="table-responsive" data-simplebar>
                      <table class="table table-borderless align-middle text-nowrap">
                        <thead>
                         <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Dealer</th>
                                <th scope="col">Customer Points</th>
                                <th scope="col">Item</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($transactions_details as $transaction)
                            <tr>
                              <td>{{date('M d, Y',strtotime($transaction->created_at))}}</td>
                              <td>{{number_format($transaction->qty,2)}}</td>
                              <td>{{number_format($transaction->qty*$transaction->price,2)}}</td>
                              <td>{{$transaction->dealer->name}}</td>
                              <td><span class='text-success'>{{$transaction->points_client}}</span></td>
                              <td>{{$transaction->item}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
          @endif

          
@endsection
@section('javascript')

<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
 @if(auth()->user()->role == "Client")
      <script>
          const qrcode = new QRCode(document.getElementById('qrcode'), {
              text: "{{ $customer->serial->serial_number }}",
              width: 128,
              height: 128,
              colorDark : '#000',
              colorLight : '#fff',
              correctLevel : QRCode.CorrectLevel.H
          });
      </script>
  @endif


<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  {{-- <script src="../assets/js/dashboards/dashboard.js"></script> --}}


<script src="{{asset('design/assets/l ibs/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('design/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('design/assets/js/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
<script src="{{asset('design/assets/js/dashboards/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
{{-- <script src="{{asset('design/assets/js/dashboards/dashboard2.js')}}"></script> --}}

<script>
const allTransactions = {!! json_encode(
    $transactions_details->map(function($transaction) {
        return [
            'date' => date('M d, Y', strtotime($transaction->created_at)),
            'quantity' => number_format($transaction->qty, 2),
            'amount' => number_format($transaction->qty * $transaction->price, 2),
            'dealer' => strtoupper($transaction->dealer->name ?? ''),
            'customer' => strtoupper($transaction->customer->name ?? ''),
            'dealer_points' => $transaction->points_dealer,
            'customer_points' => $transaction->points_client,
            'item' => $transaction->item,
            'customer_id' => optional($transaction->customer)->id ?? 0
        ];
    })
) !!};

function showTransactionDetails(date, quantity, amount, dealer, customer, dealerPoints, customerPoints, item) {
    document.getElementById('customerName').textContent = customer;
    
    const tbody = document.getElementById('customerTransactions');
    tbody.innerHTML = '';
    
    const row = `
        <tr>
            <td>${date}</td>
            <td>${quantity}</td>
            <td>${amount}</td>
            <td>${dealer}</td>
            <td>${customer}</td>
            <td><span class='text-success'>${dealerPoints}</span></td>
            <td><span class='text-success'>${customerPoints}</span></td>
            <td>${item}</td>
        </tr>
    `;
    tbody.innerHTML = row;
}

function loadCustomerTransactions(customerId, customerName) {
    document.getElementById('customerName').textContent = customerName;
    
    const customerTransactions = allTransactions.filter(transaction => 
        transaction.customer_id == customerId
    );
    
    const tbody = document.getElementById('customerTransactions');
    tbody.innerHTML = '';
    
    customerTransactions.forEach(transaction => {
        const row = `
            <tr>
                <td>${transaction.date}</td>
                <td>${transaction.quantity}</td>
                <td>${transaction.amount}</td>
                <td>${transaction.dealer}</td>
                <td>${transaction.customer}</td>
                <td><span class='text-success'>${transaction.dealer_points}</span></td>
                <td><span class='text-success'>${transaction.customer_points}</span></td>
                <td>${transaction.item}</td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
    
    if (customerTransactions.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center">No transactions found for this customer.</td></tr>';
    }
}

function updateTableEntries() {
    const entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
    const allRows = document.querySelectorAll('.transaction-row');
    const totalEntries = allRows.length;
    
    allRows.forEach((row, index) => {
        if (index < entriesPerPage) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    const showing = Math.min(entriesPerPage, totalEntries);
    document.getElementById('entriesInfo').textContent = 
        `Showing 1 to ${showing} of ${totalEntries} entries`;
}
</script>

<script>
   const categories = @json($categories);
    const qty = @json($qty);
  $(function () {
  
  // Stacked Bar Chart -------> BAR CHART (Vertical)
  var options_stacked = {
    series: [
      {
        name: "LPG Cylinder",  // Unified series name
        data: qty, // Data for Jan to Dec
      }
    ],
    chart: {
      fontFamily: "inherit",
      type: "bar",
      height: 350,
      stacked: true,
      toolbar: {
        show: false,
      },
    },
    grid: {
      borderColor: "transparent",
    },
    // Updated color palette for better contrast
    colors: [
      "#4F80FF",  // A calming blue color
    ],
    plotOptions: {
      bar: {
        horizontal: false, // Change this to false to make the bars vertical
      },
    },
    stroke: {
      width: 1,
      colors: ["#fff"],
    },
    xaxis: {
      categories: categories,
      labels: {
        formatter: function (val) {
          return val + "";
        },
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    yaxis: {
      title: {
        text: undefined,
      },
      labels: {
        formatter: function (val) {
          return val ;
        },
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val ;
        },
      },
      theme: "dark",
    },
    fill: {
      opacity: 1,
    },
    legend: {
      position: "top",
      horizontalAlign: "left",
      offsetX: 40,
      labels: {
        colors: ["#a1aab2"],
      },
    },
  };

  var chart_bar_stacked = new ApexCharts(
    document.querySelector("#chart-bar-stacked"),
    options_stacked
  );
  chart_bar_stacked.render();


});

</script>
{{-- <script src="{{asset('design/assets/js/apex-chart/apex.bar.init.js')}}"></script> --}}
<script src="{{asset('design/assets/js/dashboards/dashboard.js')}}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var myModal = new bootstrap.Modal(document.getElementById('homeModal'));
    myModal.show();
  });
</script>
@endsection
