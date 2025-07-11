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
                    <img src="{{$profile->avatar}}" onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" alt="Avatar Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                    </div>  
                    <br>
                   
                    <!-- Customer Personal Details -->
                    <p><strong>Name:</strong> {{$profile->name}}</p>
                    <p><strong>Contact:</strong> {{$profile->number}}</p>
                    <p><strong>Address:</strong> {{$profile->address}}</p>
                    @if(auth()->user()->role == "Client")
                    <p><strong>Serial Number:</strong> {{$profile->serial->serial_number}}</p>
                    @else
                    <p><strong>Store Name:</strong> {{$profile->store_name}}</p>
                    <p><strong>Store Type:</strong> {{$profile->store_type}}</p>
                    @endif
                    <p><strong>facebook:</strong> {{$profile->facebook}}</p>
                    

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
                        @if($profile->valid_id)
                            <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-vcard-fill me-2"></i> Valid ID Information  &nbsp;
                                <button type="button" data-bs-toggle="modal"  data-bs-target="#viewValidId" class="btn btn-primary btn-sm btn-radius">
                                    <i class="bi bi-file-earmark"></i>
                                </button>
                            </h5>
                            <hr>
                            <p class="mb-2">
                                <strong><i class="bi bi-card-text me-2"></i>ID Type:</strong> {{$profile->valid_id}}
                            </p>
                            <p class="mb-0">
                                <strong><i class="bi bi-hash me-2"></i>ID Number:</strong> {{$profile->valid_id_number}}
                            </p>
                            </div>
                        @else
                        
                        @endif
                    </div>
                        </div>
                        <div class="col-md-6">
                            @if($profile->signature)
                        <div class="card shadow-sm stretch" >
                            <div class="card-body text-center">
                            <h6 class="card-title"><i class="mdi mdi-file-document-check-outline"></i> Signed Contract</h6>

                            @if($profile->signature)
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contractView">
                            <i class="bi bi-file-text"></i> View Signed Contract
                            </button>
                            @else
                            <p class="text-muted"><i class="mdi mdi-close-circle-outline"></i> No contract uploaded.</p>
                            @endif
                        </div>
                    @else

                      
                    @endif
                </div>
            </div>

          <div class='row'>  
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
    </div>
    
@if(auth()->user()->role == "Dealer")

@php
    $dealer = $profile;
@endphp
@include('view_contract_signed_dealer')
@include('viewValidIdDealer')
@else
@php
    $customer = $profile;
@endphp
@include('viewValidId')
@include('view_contract_signed')
@endif
</section>
@endsection

