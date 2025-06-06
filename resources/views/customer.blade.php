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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
@section('content')
<section class="welcome">
     <!-- Customer Info Section -->
     <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class='text-center'>
                    <img src="{{$customer->avatar}}" onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" alt="Avatar Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                    </div>  
                    <br>
                   <div class='text-center'>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#uploadAvatarModal" title="Upload Avatar">
                        <i class="fas fa-camera"></i>
                        <span class="sr-only">Upload Avatar</span>
                        </button>
                    </div>
                    <!-- Customer Personal Details -->
                    <p><strong>Name:</strong> {{$customer->name}}</p>
                    <p><strong>Contact:</strong> {{$customer->number}}</p>
                    <p><strong>Address:</strong> {{$customer->address}}</p>
                    <p><strong>Serial Number:</strong> {{$customer->serial->serial_number}}</p>
                    <p><strong>facebook:</strong> {{$customer->facebook}}</p>

                    <!-- QR Code Generation -->
                    <div id="qrcode" class="mt-4 text-center">
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class='row'>
                <div class="col-md-6">
                     <div class="card shadow-sm stretch">
                        @if($customer->valid_id)
                            <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-vcard-fill me-2"></i> Valid ID Information  &nbsp;
                                <button type="button" data-bs-toggle="modal"  data-bs-target="#viewValidId" class="btn btn-primary btn-sm btn-radius">
                                    <i class="bi bi-file-earmark"></i>
                                </button>
                            </h5>
                            <hr>
                            <p class="mb-2">
                                <strong><i class="bi bi-card-text me-2"></i>ID Type:</strong> {{$customer->valid_id}}
                            </p>
                            <p class="mb-0">
                                <strong><i class="bi bi-hash me-2"></i>ID Number:</strong> {{$customer->valid_id_number}}
                            </p>
                            </div>
                        @else
                        <div class="card-body text-center">
                        <h5 class="card-title"><i class="bi bi-person-vcard"></i> Upload Valid ID</h5>
                        <p class="card-text">Submit a valid government-issued ID.</p>
                        <button class="btn btn-danger" type='button' data-bs-toggle="modal"  data-bs-target="#uploadIdModal">
                            <i class="bi bi-upload"></i> Upload ID
                        </button>
                        </div>
                        @endif
                    </div>
                        </div>
                        <div class="col-md-6">
                            @if($customer->signature)
                        <div class="card shadow-sm stretch" >
                            <div class="card-body text-center">
                            <h6 class="card-title"><i class="mdi mdi-file-document-check-outline"></i> Signed Contract</h6>

                            @if($customer->signature)
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contractView">
                            <i class="bi bi-file-text"></i> View Signed Contract
                            </button>
                            @else
                            <p class="text-muted"><i class="mdi mdi-close-circle-outline"></i> No contract uploaded.</p>
                            @endif
                        </div>
                    @else

                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                            <h5 class="card-title"><i class="bi bi-file-earmark-text"></i> Contract Signing</h5>
                            <p class="card-text">Review and sign the contract.</p>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#contractModal">
                                <i class="bi bi-pencil-square"></i> Sign Contract
                            </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Transactions</h5>
                </div>
                <div class="card-body">
                    <!-- Purchase History Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" style='font-size:12px;'>
                            <thead>
                                <tr>
                                    <th>Transaction No.</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Points Earned</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->item}}</td>
                                    <td>{{$transaction->qty}}</td>
                                    <td><span class='text-success'>{{$transaction->points_client}}</span></td>
                                    <td>{{number_format($transaction->qty*$transaction->price,2)}}</td>
                                    <td>{{date('M d, Y',strtotime($transaction->created_at))}}</td>
                                </tr>
                                @endforeach
                                <!-- Sample Purchase 1 -->
                                {{-- <tr>
                                    <td>123</td>
                                    <td>330g LPG Cylinder</td>
                                    <td>5</td>
                                    <td>PHP XXX.00</td>
                                    <td>March 1, 2025</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
           
        </div>
    </div>
    

</section>
@include('change_avatar')
@include('upload_valid_id')
@include('sign_contract')
@include('viewValidId')
@include('view_contract_signed')
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
