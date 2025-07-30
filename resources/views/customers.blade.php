@extends('layouts.header')
@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
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

.dataTables_length {
  float: left;
  margin-top: 15px;
  margin-bottom: 5px;
}

.dataTables_filter {
  float: right;
  margin-top: 15px;
  margin-bottom: 5px;
}

</style>

@endsection
@section('content')
<section class="welcome">
    <div class="row">
        <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Customers <button class="btn-sm btn-success btn" data-bs-toggle="modal"  data-bs-target="#new_customer">+ Add</button></h5>
                    
                    <table id="example" class="table table-bordered table-striped " style="width:100%">
                        <thead>
                          <tr>
                              <th>Customer Name</th>
                              <th>Contact Number</th>
                              <th>Email Address</th>
                              <th style="display:none;">Date Start</th>
                              <th style="display:none;">As of Now</th>
                              <th>Serial Number</th>
                              <th>Address</th>
                              <th>Total Points</th>
                              <th>Last Transaction</th>
                              <th style="display:none;">Remarks</th>
                              <th style="display:none;">Status</th>
                          </tr>
                        </thead>
                        <tbody id="customerBody">
                            @foreach($customers as $customer)
                          <tr>
                              <td><a href='view-client/{{$customer->id}}'>{{ strtoupper($customer->name) }}</a></td>
                              <td>{{ $customer->number }}</td>
                              <td>{{ $customer->email_address }}</td>
                              <td style="display:none;">
                                  @php
                                      $firstTransaction = $customer->transactions->sortBy('date')->first();
                                  @endphp

                                  {{ $firstTransaction ? date('M d, Y', strtotime($firstTransaction->date)) : 'No Data' }}
                              </td>
                              <td style="display:none;">
                                  {{ \Carbon\Carbon::now()->format('M d, Y') }}
                              </td>
                              <td>
                                  @if($customer->serial)
                                      {{ $customer->serial->serial_number }}
                                  @endif
                              </td>
                              <td>{{ $customer->address }}</td>
                              <td>{{ $customer->transactions->sum('points_client') }}</td>
                              <td>
                                  @php
                                      $transaction = ($customer->transactions)->sortByDesc('date')->first();
                                  @endphp
                                  @if($transaction)
                                      {{ date('M d, Y', strtotime($transaction->date)) }}
                                  @else
                                      No Data
                                  @endif
                              </td>
                             
                              <td style="display:none;">@if($customer->serial && !empty($customer->serial->remarks)) SN# @if($customer->serial) {{ $customer->serial->serial_number }} @endif used to be owned by @if($customer->serial && $customer->serial->remarks) @php $previousOwner = \App\Client::find($customer->serial->remarks); @endphp {{ $previousOwner ? $previousOwner->name : 'Unknown Client' }} @endif  @endif</td>
                              <td style="display:none;">{{ $customer->status ?? '' }}</td>
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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Buttons extension -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
  var table = $('#example').DataTable({
    dom: '<"row"<"col-sm-12"B>>' +
         '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
         '<"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    
    pageLength: 25,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Export Excel',
        className: 'btn btn-sm btn-success',
        title: 'Customers',
        exportOptions: {
          columns: [5, 0, 1, 2, 3, 4, 7, 6, 8, 9, 10],
          modifier: {
            search: 'applied',
            order: 'current',
            page: 'all'
          },
          rows: function (idx, data, node) {
            return true;
          }
        }
      }
    ],
    rowCallback: function(row, data, index) {
      if (data[10] === 'Inactive') {
        $(row).hide();
      }
      return row;
    }
  });
});
</script>
<script>
  $(document).ready(function(){
    $('.chosen-select').chosen({
      width: '100%'
    });
  });
</script>
<script>
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
