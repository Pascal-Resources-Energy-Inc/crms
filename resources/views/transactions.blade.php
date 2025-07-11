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
    @media (max-width: 768px) {
  .modal-dialog {
    margin: 1rem;
    max-width: 100%;
  }

  .chosen-container {
    width: 100% !important;
  }

  .chosen-drop {
    max-height: 200px;
    overflow-y: auto;
  }
}
</style>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>


<!-- Select2 JS -->
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@endsection
@section('content')
<section class="welcome">
    <div class="row">
       <div class="col-sm-8 col-lg-8 col-xl-8">
          <div class="row">
        <!-- Right Column: Dashboard Stats -->
            <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                      @if(auth()->user()->role == "Admin")
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addTransactionModalAdmin">
                          <i class="bi bi-plus-lg"></i> Search Name
                        </button>
                      @else
                        <h5>Transactions 
                             <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                          Scan QR
                      </button>
                          <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                          <i class="bi bi-plus-lg"></i> Search Name
                        </button>
                     
                      </h5> 
                      @endif
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped transaction-table" id="example" style="width:100%">
                              <thead>
                                  <tr>
                                      <th scope="col">ID</th>
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
                              <tbody id="transactionBody">
                                  @foreach($transactions as $transaction)
                                  <tr>
                                      <td>{{$transaction->id}}</td>
                                      <td>{{date('M d, Y',strtotime($transaction->created_at))}}</td>
                                      <td>{{number_format($transaction->qty,2)}}</td>
                                      <td>{{number_format($transaction->qty * $transaction->price,2)}}</td>
                                      <td>{{$transaction->dealer->name}}</td>
                                      <td>{{$transaction->customer->name}}</td>
                                      <td><span class='text-success'>{{$transaction->points_dealer}}</span></td>
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
       </div>
        <div class="col-sm-4 col-lg-4 col-xl-4">
             <div class="row">
            <!-- Total Sales -->
                <div class="col-sm-6 col-lg-6 ">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                          <div class="mb-7">
                            <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                          </div>
                          <h5 class="text-white fw-bold fs-14 text-nowrap">
                          {{ $transactions->sum(function($transaction) {
                                return $transaction->price * $transaction->qty;
                            }) }}
                          </h5>
                          <p class="opacity-50 mb-0 ">Total Sales</p>
                        </div>
                      </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="card danger-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                          <div class="mb-7">
                            <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                          </div>
                          <h5 class="text-white fw-bold fs-14 text-nowrap">
                            {{$transactions->count()}}
                          </h5>
                          <p class="opacity-50 mb-0 ">Transactions</p>
                        </div>
                      </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="card info-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                          <div class="mb-7">
                            <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                          </div>
                          <h5 class="text-white fw-bold fs-14 text-nowrap">
                            {{$transactions->sum('qty')}}
                          </h5>
                          <p class="opacity-50 mb-0 ">Qty Sold</p>
                        </div>
                      </div>
                </div>
                <div class="col-sm-6 col-lg-6 ">
                    <div class="card info-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                          <div class="mb-7">
                            <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                          </div>
                          <h5 class="text-white fw-bold fs-14 text-nowrap">
                            {{$transactions->sum('points_dealer') + $transactions->sum('points_client')}}
                          </h5>
                          <p class="opacity-50 mb-0 ">Total Points</p>
                        </div>
                      </div>
                </div>
             </div>
        </div>
      
    </div>
</section>
@if(auth()->user()->role == "Admin")

  @include('new_transaction_admin')

@else
  @include('new_transaction')
@endif
@include('qr_scanner')
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Chosen JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Buttons extension -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

{{-- <script>
 $(document).ready(function() {
  $('#customerSelect').select2({
    dropdownParent: $('#addTransactionModal') // ✅ replace with your modal's ID
  });
  $('#customerSelect123').select2({
    dropdownParent: $('#addTransactionModalAdmin') // ✅ replace with your modal's ID
  });
  $('#dealer').select2({
    dropdownParent: $('#addTransactionModalAdmin') // ✅ replace with your modal's ID
  });
});
</script> --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#customerSelect', {
      create: false,
      allowEmptyOption: true,
      placeholder: "Search Customer"
    });
    new TomSelect('#dealer', {
      create: false,
      allowEmptyOption: true,
      placeholder: "Search Dealer"
    });
  });
</script>
<script>
 $(document).ready(function() {
  $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Export Excel',
        className: 'btn btn-sm btn-success',
        title: 'Transactions'
      }
    ]
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Qty buttons
  document.getElementById('qtyMinus').addEventListener('click', () => {
    const qtyInput = document.getElementById('qtyInput');
    let val = parseInt(qtyInput.value);
    if (val > 1) qtyInput.value = val - 1;
  });

  document.getElementById('qtyPlus').addEventListener('click', () => {
    const qtyInput = document.getElementById('qtyInput');
    qtyInput.value = parseInt(qtyInput.value) + 1;
  });
  document.getElementById('qtyMinusa').addEventListener('click', () => {
    const qtyInput = document.getElementById('qtyInputa');
    let val = parseInt(qtyInput.value);
    if (val > 1) qtyInput.value = val - 1;
  });

  document.getElementById('qtyPlusa').addEventListener('click', () => {
    const qtyInput = document.getElementById('qtyInputa');
    qtyInput.value = parseInt(qtyInput.value) + 1;
  });

  // Simple filter function for select + search input
  function filterSelect(inputId, selectId) {
    const input = document.getElementById(inputId);
    const select = document.getElementById(selectId);

    input.addEventListener('input', () => {
      const filter = input.value.toLowerCase();
      for (let option of select.options) {
        const text = option.text.toLowerCase();
        option.style.display = text.includes(filter) ? '' : 'none';
      }
    });
  }

  filterSelect('customerSearch', 'customerSelect');
  filterSelect('itemSearch', 'itemSelect');
</script>
<script>
 let html5QrcodeScanner = null;

function startScanner() {
    if (!html5QrcodeScanner) {
        // clear any leftover content in the reader div:
        document.getElementById("reader").innerHTML = "";

        html5QrcodeScanner = new Html5Qrcode("reader");
    }

    const config = { fps: 10, qrbox: 250 };

    html5QrcodeScanner.start(
        { facingMode: "environment" }, 
        config,
        qrCodeMessage => {
            document.getElementById('result').innerText = qrCodeMessage;
            fetchUserInfo(qrCodeMessage);
            html5QrcodeScanner.stop();
        },
        errorMessage => {
            // optional: handle scanning errors
        }
    ).catch(err => {
        console.error("Unable to start scanning.", err);
    });
}

function stopScanner() {
    if (html5QrcodeScanner) {
        html5QrcodeScanner.stop().then(() => {
            html5QrcodeScanner.clear();
            html5QrcodeScanner = null;
        }).catch(err => {
            console.warn("Failed to stop scanner", err);
            html5QrcodeScanner = null;
        });
    }
}
function fetchUserInfo(userId) {
          fetch(`{{ url('get-user') }}/${userId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('userId').value = data.user.id;
                document.getElementById('userName').value = data.user.name;

                // Open transaction modal after success
                var qrModal = bootstrap.Modal.getInstance(document.getElementById('qrScannerModal'));
                qrModal.hide();
                var transactionModal = new bootstrap.Modal(document.getElementById('addTransactionModaldd'));
                transactionModal.show();
            } else {
                alert("User not found");
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error fetching user info:', error);
            alert("Error fetching user info");
        });
    }


document.getElementById('qrScannerModal').addEventListener('shown.bs.modal', startScanner);
document.getElementById('qrScannerModal').addEventListener('hidden.bs.modal', stopScanner);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
