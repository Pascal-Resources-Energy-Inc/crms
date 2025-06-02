@extends('layouts.header')
@section('css')
<style>
    /* Custom styling */
    .transaction-table th {
        text-align: center;
    }
    .btn-view {
        width: 100px;
        font-size: 14px;
    }
    .dashboard-stats {
        display: flex;
        justify-content: space-around;
    }
    .dashboard-stats div {
        text-align: center;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 30%;
    }
    /* Welcome section styling */
    .welcome {
        margin-top: 20px;
    }
    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .card-body {
        padding: 20px;
    }
    .filter-container {
        margin-bottom: 20px;
    }
</style>
@endsection
@section('content')
<section class="welcome">
    <div class="row">
        <!-- Total Sales -->
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <div class="card warning-card overflow-hidden text-bg-primary w-100">
                <div class="card-body p-4">
                  <div class="mb-7">
                    <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                  </div>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    0.00
                  </h5>
                  <p class="opacity-50 mb-0 ">Total Sales</p>
                </div>
              </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <div class="card danger-card overflow-hidden text-bg-primary w-100">
                <div class="card-body p-4">
                  <div class="mb-7">
                    <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                  </div>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    0.00
                  </h5>
                  <p class="opacity-50 mb-0 ">Transactions</p>
                </div>
              </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <div class="card info-card overflow-hidden text-bg-primary w-100">
                <div class="card-body p-4">
                  <div class="mb-7">
                    <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                  </div>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    0.00
                  </h5>
                  <p class="opacity-50 mb-0 ">Qty Sold</p>
                </div>
              </div>
        </div>
      
      
      </div>
    <div class="row">
        <!-- Right Column: Dashboard Stats -->
        <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Transactions</h5>
                    <table class="table table-bordered table-striped transaction-table">
                        <thead class="">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Dealer</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Points Earned</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="transactionBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
@endsection
