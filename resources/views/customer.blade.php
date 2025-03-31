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
     <!-- Customer Info Section -->
     <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class='text-center'>
                    <img src="{{url('design/assets/images/profile/user-5.jpg')}}" alt="Customer Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                    </div>  
                    <br>
                    <!-- Customer Personal Details -->
                    <p><strong>Name:</strong> Juan Dela Cruz</p>
                    <p><strong>Contact:</strong> (0917) 123 4567</p>
                    <p><strong>Address:</strong> 123 Mabini St., Quezon City</p>
                    <p><strong>Area:</strong> Metro Manila</p>
                    <p><strong>Stove ID:</strong> ST12345</p>

                    <!-- QR Code Generation -->
                    <div id="qrcode" class="mt-4 text-center">
                      
                    </div>
                  
                </div>
            </div>
        </div>

        <!-- Purchase History Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Purchase History</h5>
                </div>
                <div class="card-body">
                    <!-- Purchase History Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transaction No.</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Purchase 1 -->
                            <tr>
                                <td>123</td>
                                <td>330g LPG Cylinder</td>
                                <td>5</td>
                                <td>PHP XXX.00</td>
                                <td>March 1, 2025</td>
                            </tr>
                            <!-- Sample Purchase 2 -->
                            <tr>
                                <td>124</td>
                                <td>230g LPG Cylinder</td>
                                <td>3</td>
                                <td>PHP XXX.00</td>
                                <td>March 10, 2025</td>
                            </tr>
                            <!-- Sample Purchase 3 -->
                            <tr>
                                <td>125</td>
                                <td>330g LPG Cylinder</td>
                                <td>2</td>
                                <td>PHP XXX.00</td>
                                <td>March 20, 2025</td>
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
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    // Valid data for QR code generation
    const customerData = {
        customerId: 'ST12345',
        name: 'Juan Dela Cruz',
        contact: '(0917) 123 4567',
        address: '123 Mabini St., Quezon City',
        area: 'Metro Manila'
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
