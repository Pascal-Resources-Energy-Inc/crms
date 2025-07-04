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
    <style>
    #signatureCanvas {
      border: 1px solid #ccc;
      touch-action: none;
    }
    .select2-selection{

      border-color:#aebcc3 !important;
    }
  </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
/* Match Bootstrap 4 .form-control */
.chosen-container .chosen-single {
  height: calc(2.25rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  box-shadow: none;
}

.chosen-container-active.chosen-with-drop .chosen-single {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.chosen-container .chosen-drop {
  border: 1px solid #ced4da;
  border-top: none;
  border-radius: 0 0 0.25rem 0.25rem;
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
}

.chosen-container .chosen-results {
  max-height: 200px;
  overflow-y: auto;
}

.chosen-container .chosen-search input {
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
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
                    <h5>Customers <button class="btn-sm btn-success btn" data-bs-toggle="modal"  data-bs-target="#new_customer">+ Add</button></h5>
                    <!-- Customers Table -->
                    <table id="example" class="table table-bordered table-striped " style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                                <th>Serial Number</th>
                                <th>Address</th>
                                <th>Total Points</th>
                                <th>Last Transaction</th>
                            </tr>
                        </thead>
                        <tbody id="customerBody">
                            @foreach($customers as $customer)
                            <tr>
                                <td><a href='view-client/{{$customer->id}}'> {{$customer->name}}</a></td>
                                <td>{{$customer->number}}</td>
                                <td>{{$customer->email_address}}</td>
                                <td>
                                    @if($customer->serial)
                                        {{ $customer->serial->serial_number }}
                                    @endif
                                </td>
                                <td>
                                   {{$customer->address}}
                                </td>
                                <td> {{$customer->transactions->sum('points_client')}}</td>
                                <td>
                                  @php
                                    $transaction = ($customer->transactions)->sortByDesc('created_at')->first();
                                  @endphp

                                    @if($transaction)
                                    {{date('M d, Y',strtotime($transaction->updated_at))}}
                                    @else
                                    No Data
                                  @endif
                                </td>
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
@include('new_customer')
@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<!-- JSZip (required for Excel export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Buttons extension JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    $('#example').DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'excelHtml5',
          text: 'Export to Excel',
          title: 'DataExport'
        }
      ]
    });
  });
</script>
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
