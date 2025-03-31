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
                    5
                  </h5>
                  <p class="opacity-50 mb-0 ">Active Dealers</p>
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
                    5
                  </h5>
                  <p class="opacity-50 mb-0 ">Inctive Dealers</p>
                </div>
              </div>
        </div>
      
      </div>
    <div class="row">
        <!-- Right Column: Dashboard Stats -->
        <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Dealers</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Dealer Name</th>
                                <th scope="col">Total Sales</th>
                                <th scope="col">Address</th>
                                <th scope="col">Area</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dealerBody">
                            <!-- Dealers will be inserted here dynamically -->
                            @foreach(range(1, 20) as $i)
                            <tr>
                                <td>Dealer {{ $i }}</td>
                                <td>PHP {{ number_format(rand(100000, 500000), 2) }}</td> <!-- Random sales -->
                                <td>Address {{ $i }}</td>
                                <td>Area {{ $i }}</td>
                                <td>
                                    <span class="badge {{ rand(0, 1) ? 'bg-success' : 'bg-danger' }}">
                                        {{ rand(0, 1) ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td><a href="{{url('dealer')}}" class="btn btn-primary btn-view">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    // Add logic for filtering the table by dealer (static data)
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("dealerFilter").addEventListener("change", function () {
            const selectedDealer = this.value;
            filterDealersByName(selectedDealer);
        });

        function filterDealersByName(dealerName) {
            const rows = document.querySelectorAll('#dealerBody tr');
            rows.forEach(row => {
                const dealerColumn = row.cells[0].textContent;
                if (dealerName === 'All' || dealerColumn === dealerName) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection
