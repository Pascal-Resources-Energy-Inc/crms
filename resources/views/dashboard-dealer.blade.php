@extends('layouts.header')

@section('content')
<!--  Header End -->
          <!-- Welcome Section Start -->
          <section class="welcome">
            <div class="row">
              <div class="col-lg-12 col-xl-6 d-flex align-items-strech">
                <div class="card w-100">
                  <div class="card-body position-relative">
                    <div>
                      <h5 class="mb-1 fw-bold">Welcome Jonathan Deo</h5>
                      <p class="fs-3 mb-3 pb-1">Check all the statistics</p>
                      <button class="btn btn-primary rounded-pill" type="button">
                        Visit Now
                      </button>
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
                          2,358.00 <span class="fs-2 fw-light">+23%</span>
                        </h5>
                        <p class="opacity-50 mb-0 ">Qty Sold</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4 d-flex align-items-strech">
                    <div class="card danger-card overflow-hidden text-bg-primary w-100">
                      <div class="card-body p-4">
                        <div class="mb-7">
                          <i class="ti ti-report-money fs-8 fw-lighter"></i>
                        </div>
                        <h5 class="text-white fw-bold fs-14">
                          356 <span class="fs-2 fw-light">+8%</span>
                        </h5>
                        <p class="opacity-50 mb-0">Carbon Credit</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4 d-flex align-items-strech">
                    <div class="card info-card overflow-hidden text-bg-primary w-100">
                      <div class="card-body p-4">
                        <div class="mb-7">
                          <i class="ti ti-currency-dollar fs-8 fw-lighter"></i>
                        </div>
                        <h5 class="text-white fw-bold fs-14 text-nowrap">
                          $235.8K <span class="fs-2 fw-light">-3%</span>
                        </h5>
                        <p class="opacity-50 mb-0">Earnings</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5>Dealer Quantity Sold (2025)</h5>
                      <div id="chart-bar-stacked"></div>
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
              <div class="col-lg-12 col-xl-8 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex mb-4 justify-content-between align-items-center">
                      <h5 class="mb-0 fw-bold">Top Dealer</h5>

                 
                    </div>

                    <div class="table-responsive" data-simplebar>
                      <table class="table table-borderless align-middle text-nowrap">
                        <thead>
                          <tr>
                            <th scope="col">Profile</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total Sales</th>
                            <th scope="col">Carbon Credit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="me-4">
                                  <img src="{{asset('design//assets/images/profile/user-2.jpg')}}" width="50" class="rounded-circle" alt="" />
                                </div>

                                <div>
                                  <h6 class="mb-1 fw-bolder">Dealer 1</h6>
                                  <p class="fs-3 mb-0">Bicol</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="fs-3 fw-normal mb-0">20.00</p>
                            </td>
                            <td>
                              <p class="fs-3 mb-0">
                                PHP 20,000.00
                              </p>
                            </td>
                            <td>
                              <span
                                class="badge bg-success-subtle rounded-pill text-success border-success border fs-2">50</span>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-xl-4 d-flex align-items-stretch">
                <div class="card acedamic w-100">
                  <div class="card-body">
                  
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Educators End -->
@endsection
@section('javascript')


<script src="{{asset('design/assets/libs/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('design/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('design/assets/js/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
<script src="{{asset('design/assets/js/dashboards/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{asset('design/assets/js/dashboards/dashboard2.js')}}"></script>

<script src="{{asset('design/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('design/assets/js/apex-chart/apex.bar.init.js')}}"></script>

@endsection
