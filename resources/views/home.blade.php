@extends('layouts.header')
@section('header')

<link rel="stylesheet" href="{{asset('design/assets/libs/jvectormap/jquery-jvectormap.css')}}">
@endsection
@section('content')

<!--  Header End -->
          <!-- Welcome Section Start -->
          <section class="welcome">
            <div class="row">
              <div class="col-lg-12 col-xl-6 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body position-relative">
                    <div>
                      <h5 class="mb-1 fw-bold">Welcome {{auth()->user()->name}}</h5>
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
                         100 
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
                      <h5>Refill Sold Quantity(2025)</h5>
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
                      <h5 class="mb-0 fw-bold">Latest Transaction</h5>

                 
                    </div>

                    <div class="table-responsive" data-simplebar>
                      <table class="table table-borderless align-middle text-nowrap">
                        <thead>
                          <tr>
                          <tr>
                            <th scope="col">Profile</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Dealer</th>
                            <th scope="col">Points Earned  <Br>Dealer</th>
                            <th scope="col">Points Earned  <Br>End User</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Avg Consumption/Week</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($transactions->take(20) as $transaction)
                            <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="me-4">
                                  <img src="{{asset('design//assets/images/profile/user-2.jpg')}}" width="50" class="rounded-circle" alt="" />
                                </div>

                                <div>
                                  <h6 class="mb-1 fw-bolder">Juan Dela Cruz</h6>
                                  <p class="fs-3 mb-0">Bicol</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="fs-3 fw-normal mb-0">2.00</p>
                            </td>
                            <td>
                              <p class="fs-3 mb-0">
                               Dealer 1
                              </p>
                            </td>
                            <td>
                              <span
                                class="badge bg-success-subtle rounded-pill text-success border-success border fs-2">2</span>
                            </td>
                            <td>
                              <span
                                class="badge bg-success-subtle rounded-pill text-success border-success border fs-2">2</span>
                            </td>
                            <td>
                              {{date("M. d, Y")}}
                            </td>
                            <td>
                              5
                            </td> 
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
{{-- 
              <div class="col-lg-12 col-xl-6 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <h5 class="card-title">Stove Distribution (35 pcs)</h5>
                    <div id="usa" class="h-270">
                      
                    </div>
                    
                    <div class="mt-4">
                      <div class="hstack gap-4 mb-4">
                        <h6 class="mb-0 flex-shrink-0 w">Bicol</h6>
                        <div class="progress bg-light-subtle mt-1 w-100 " style='height:10px; '>
                          <div class="progress-bar text-bg-info" role="progressbar" style="width: 100%" aria-valuenow="28"
                            aria-valuemin="0" aria-valuemax="100">100%</div>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
          </section>
          <!-- Educators End -->
@endsection
@section('javascript')

  {{-- <script src="../assets/js/dashboards/dashboard.js"></script> --}}


<script src="{{asset('design/assets/l ibs/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('design/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('design/assets/js/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
<script src="{{asset('design/assets/js/dashboards/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
{{-- <script src="{{asset('design/assets/js/dashboards/dashboard2.js')}}"></script> --}}
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

@endsection
