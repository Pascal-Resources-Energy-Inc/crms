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
        flex-wrap: wrap;
        gap: 15px;
    }
    .dashboard-stats div {
        text-align: center;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 30%;
        min-width: 250px;
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
    
    /* Responsive card styling */
    .stretch {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .stretch .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    /* Responsive table wrapper */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table-responsive table {
        min-width: 700px; /* Minimum width to ensure readability */
    }
    
    /* Mobile adjustments */
    @media (max-width: 768px) {
        .dashboard-stats {
            flex-direction: column;
        }
        
        .dashboard-stats div {
            width: 100%;
        }
        
        /* Stack cards on mobile */
        .row .col-md-4,
        .row .col-8 {
            margin-bottom: 20px;
        }
        
        /* Ensure equal height cards on mobile */
        .card-equal-height {
            min-height: 200px;
        }
        
        .card-body {
            padding: 15px;
        }
        
        .card-header {
            font-size: 1.1rem;
            padding: 10px 15px;
        }
        
        /* Table font size adjustment for mobile */
        .table {
            font-size: 11px;
        }
        
        /* Button adjustments for mobile */
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.375rem 0.75rem;
        }
    }
    
    /* Tablet adjustments */
    @media (min-width: 769px) and (max-width: 991px) {
        .card-body {
            padding: 18px;
        }
        
        .table {
            font-size: 13px;
        }
    }
    
    /* Small mobile adjustments */
    @media (max-width: 480px) {
        .card-header {
            font-size: 1rem;
        }
        
        .card-body {
            padding: 10px;
        }
        
        .table {
            font-size: 10px;
        }
        
        .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        /* Avatar size adjustment */
        .img-fluid.rounded-circle {
            width: 80px !important;
            height: 80px !important;
        }
    }
    
    /* Ensure buttons don't break on small screens */
    .btn-responsive {
        height: 43px;
        width: 200px;
        white-space: nowrap;
    }

    .center-btn {
    display: flex;
    justify-content: center;
    align-items: center;
}

    
    
</style>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<section class="welcome">
    <!-- Customer Info Section -->
    <div class="row">
        <!-- Dealer Information Card -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Dealer Information</h5>
                </div>
                <div class="card-body">
                    <div class='text-center mb-3'>
                        <img src="{{$dealer->avatar}}" 
                             onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" 
                             alt="Avatar Image" 
                             class="img-fluid rounded-circle" 
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>  
                    
                    <div class='text-center mb-3'>
                        <button type="button" 
                                class="btn btn-primary btn-sm btn-responsive" 
                                data-bs-toggle="modal"  
                                data-bs-target="#uploadAvatarModal" 
                                title="Upload Avatar">
                            <i class="fas fa-camera"></i>
                            <span class="d-none d-sm-inline ms-1">Upload Avatar</span>
                        </button>
                    </div>
                    
                    <!-- Customer Personal Details -->
                    <div class="dealer-details">
                        <p class="mb-2"><strong>Name:</strong> <span class="text-break">{{$dealer->name}}</span></p>
                        <p class="mb-2"><strong>Contact:</strong> <span class="text-break">{{$dealer->number}}</span></p>
                        <p class="mb-2"><strong>Address:</strong> <span class="text-break">{{$dealer->address}}</span></p>
                        <p class="mb-2"><strong>Store Name:</strong> <span class="text-break">{{$dealer->store_name}}</span></p>
                        <p class="mb-2"><strong>Store Type:</strong> <span class="text-break">{{$dealer->store_type}}</span></p>
                        <p class="mb-2"><strong>Facebook:</strong> <span class="text-break">{{$dealer->facebook}}</span></p>
                        <p class="mb-2"><strong>Email:</strong> <span class="text-break">{{$dealer->user->email}}</span></p>
                    </div>

                    <!-- QR Code Generation -->
                    <div id="qrcode" class="mt-4 text-center">
                      
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-lg-8 col-md-12">
            <!-- ID and Contract Cards Row -->
            <div class='row mb-4'>
                <!-- Valid ID Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="card shadow-sm h-100 card-equal-height">
                        @if($dealer->valid_id)
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-3">
                                    <i class="bi bi-person-vcard-fill me-2"></i> Valid ID Information
                                    <button type="button" 
                                            data-bs-toggle="modal"  
                                            data-bs-target="#viewValidId" 
                                            class="btn btn-primary btn-sm btn-radius ms-2">
                                        <i class="bi bi-file-earmark"></i>
                                    </button>
                                </h5>
                                <hr>
                                <div class="flex-grow-1">
                                    <p class="mb-2">
                                        <strong><i class="bi bi-card-text me-2"></i>ID Type:</strong> 
                                        <span class="text-break">{{$dealer->valid_id}}</span>
                                    </p>
                                    <p class="mb-0">
                                        <strong><i class="bi bi-hash me-2"></i>ID Number:</strong> 
                                        <span class="text-break">{{$dealer->valid_id_number}}</span>
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="card-title">
                                    <i class="bi bi-person-vcard"></i> Upload Valid ID
                                </h5>
                                <p class="card-text text-muted mb-3">Submit a valid government-issued ID.</p>
                                <div class="center-btn">
                                    <button class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#uploadIdModal">
                                        <i class="bi bi-upload"></i>
                                        <span class="d-sm-inline ms-1">Upload ID</span>
                                    </button>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Contract Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    @if($dealer->signature)
                        <div class="card shadow-sm h-100 card-equal-height">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="card-title">
                                    <i class="mdi mdi-file-document-check-outline"></i> Signed Contract
                                </h5>
                                <p class="text-success mb-3">
                                    <i class="bi bi-check-circle-fill"></i> Contract completed
                                </p>
                                <button type="button" 
                                        class="btn btn-success btn-sm btn-responsive" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#contractView">
                                    <i class="bi bi-file-text"></i> 
                                    <span class="d-sm-inline ms-1">View Contract</span>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="card shadow-sm h-100 card-equal-height">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="card-title">
                                    <i class="bi bi-file-earmark-text"></i> Contract Signing
                                </h5>
                                <p class="card-text text-muted mb-3">Review and sign the contract.</p>
                                <div class="center-btn">
                                    <button class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#contractModal">
                                        <i class="bi bi-pencil-square"></i>
                                        <span class="d-sm-inline ms-1">Sign Contract</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Transactions Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Transactions</h5>
                        </div>
                        <div class="card-body">
                            <!-- Responsive Table Wrapper -->
                            <div class="table-responsive">
                                <table class="table" style='font-size:12px; border-collapse: collapse;'>
                                    <thead>
                                        <tr style="border-bottom: 2px solid #dee2e6;">
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Transaction No.</th>
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Product</th>
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Quantity</th>
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Points Earned</th>
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Amount</th>
                                            <th style="padding: 12px 8px; font-weight: 600; color: #495057;">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                        <tr style="border-bottom: 1px solid #dee2e6;">
                                            <td style="padding: 12px 8px;">{{$transaction->id}}</td>
                                            <td style="padding: 12px 8px;">{{$transaction->item}}</td>
                                            <td style="padding: 12px 8px;">{{$transaction->qty}}</td>
                                            <td style="padding: 12px 8px;">
                                                <span class='text-success'>{{$transaction->points_client}}</span>
                                            </td>
                                            <td style="padding: 12px 8px;">{{number_format($transaction->qty*$transaction->price,2)}}</td>
                                            <td style="padding: 12px 8px;">{{date('M d, Y',strtotime($transaction->created_at))}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox"></i> No transactions found
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Mobile-friendly pagination (if you have pagination) -->
                            @if(isset($transactions) && method_exists($transactions, 'links'))
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $transactions->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('change_avatar_dealer')
@include('upload_valid_id_dealer')
@include('viewValidIdDealer')
@include('sign_contract_dealer')
@include('view_contract_signed_dealer')
@endsection

@section('javascript')
<script>
  const canvas = document.getElementById('signatureCanvas');
  const ctx = canvas.getContext('2d');
  let drawing = false;

  canvas.addEventListener('mousedown', () => drawing = true);
  canvas.addEventListener('mouseup', () => {
    drawing = false;
    ctx.beginPath();
    saveSignatureAsFile(); // Save after drawing
  });
  canvas.addEventListener('mouseout', () => drawing = false);
  canvas.addEventListener('mousemove', draw);

  function draw(e) {
    if (!drawing) return;
    const rect = canvas.getBoundingClientRect();
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000';
    ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
  }

  function clearSignature() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('contract_signature').value = '';
  }

  function saveSignatureAsFile() {
    canvas.toBlob(function (blob) {
      const file = new File([blob], "signature.png", { type: "image/png" });

      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);

      const input = document.getElementById('contract_signature');
      input.files = dataTransfer.files;
    }, 'image/png');
  }
</script>
<script>
  const modal = document.getElementById('imageModal');
  const video = document.getElementById('video');
  const preview = document.getElementById('preview');
  const imageInput = document.getElementById('image_data');

  function openModal() {
    modal.style.display = 'flex';
  }

  function closeModal() {
    modal.style.display = 'none';
    stopCamera();
  }

  function handleFileUpload(event) {
     stopCamera();
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        imageInput.value = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }

  function enableCamera() {
    document.getElementById('cameraSection').style.display = 'block';
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        video.srcObject = stream;
      })
      .catch(err => {
        alert("Camera access denied: " + err);
      });
  }

  function captureImage() {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);
    const imageData = canvas.toDataURL('image/png');
    preview.src = imageData;
    imageInput.value = imageData;
    stopCamera();
  }

  function stopCamera() {
    const stream = video.srcObject;
    if (stream) {
      stream.getTracks().forEach(track => track.stop());
    }
    video.srcObject = null;
    cameraSection.style.display = 'none';
  }
  
</script>
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    // Valid data for QR code generation
    const customerData = {
        customerId: 'ST12345',
    };

    // Create a JSON string of the customer data
    const customerDataString = JSON.stringify(customerData);

    // Generate QR code for the customer data
    QRCode.toCanvas(document.getElementById('qrcode'), customerDataString, function(error) {
        if (error) {
            console.error(error);
        } else {
            console.log('QR code generated!');
        }
    });
</script>

@endsection