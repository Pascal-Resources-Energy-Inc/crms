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
        <!-- Right Column: Dashboard Stats -->
        <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Customers</h5>
                    
                    <!-- Search Bar -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="customerSearch" placeholder="Search Customer by Name, Stove ID...">
                        </div>
                    </div>
    
                    <!-- Customers Table -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Area</th>
                                <th>Stove ID</th>
                                <th>330g Qty</th>
                                <th>230g Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="customerBody">
                            <tr>
                                <td>Juan Dela Cruz</td>
                                <td>(0917) 123 4567</td>
                                <td>123 Mabini St., Quezon City</td>
                                <td>Metro Manila</td>
                                <td>ST12345</td>
                                <td>5</td>
                                <td>3</td>
                                <td><a href="{{url('customer')}}" class="btn btn-primary btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>Ana Santos</td>
                                <td>(0921) 987 6543</td>
                                <td>456 Roxas Blvd., Manila</td>
                                <td>Metro Manila</td>
                                <td>ST12346</td>
                                <td>8</td>
                                <td>2</td>
                                <td><a href="{{url('customer')}}" class="btn btn-primary btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>Pedro Martinez</td>
                                <td>(0932) 234 5678</td>
                                <td>789 Quezon Ave., Davao</td>
                                <td>Davao City</td>
                                <td>ST12347</td>
                                <td>3</td>
                                <td>1</td>
                                <td><a href="{{url('customer')}}" class="btn btn-primary btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>Maria Lopez</td>
                                <td>(0945) 345 6789</td>
                                <td>101 Bonifacio St., Cebu</td>
                                <td>Cebu City</td>
                                <td>ST12348</td>
                                <td>6</td>
                                <td>4</td>
                                <td><a href="{{url('customer')}}" class="btn btn-primary btn-view">View</a></td>
                            </tr>
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
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('customerSearch');
        const customerRows = document.querySelectorAll('#customerBody tr');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            customerRows.forEach(row => {
                const customerName = row.cells[0].textContent.toLowerCase();
                const stoveId = row.cells[4].textContent.toLowerCase();

                if (customerName.includes(searchTerm) || stoveId.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
