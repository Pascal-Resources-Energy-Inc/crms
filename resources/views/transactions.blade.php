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
                    PHP 1,245,678
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
                    3,450.00
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
                    20,000.00
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
                    <div class="filter-container">
                        <label for="dealerFilter" class="form-label">Filter by Dealer</label>
                        <select class="form-select" id="dealerFilter">
                            <option value="All">All Dealers</option>
                            <option value="Dealer 1">Dealer 1</option>
                            <option value="Dealer 2">Dealer 2</option>
                            <option value="Dealer 3">Dealer 3</option>
                            <option value="Dealer 4">Dealer 4</option>
                            <option value="Dealer 5">Dealer 5</option>
                            <option value="Dealer 6">Dealer 6</option>
                            <option value="Dealer 7">Dealer 7</option>
                        </select>
                    </div>
                    <h5>Transaction History</h5>
                    <table class="table table-bordered table-striped transaction-table">
                        <thead class="">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Dealer</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="transactionBody">
                            <!-- Transactions will be inserted here dynamically -->
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
    // Generate random transaction data and populate the dashboard and table
    document.addEventListener("DOMContentLoaded", function () {
        const dealers = ["Dealer 1", "Dealer 2", "Dealer 3", "Dealer 4", "Dealer 5", "Dealer 6", "Dealer 7"];
        let totalQty = 0;
        let totalAmount = 0;
        let dealerSales = Array(7).fill(0); // Array to keep track of sales by dealer
        let allTransactions = []; // To hold all transactions for filtering

        // Function to generate random transactions
        function generateTransaction(id) {
            const transactionDate = new Date(2025, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28) + 1).toLocaleDateString();
            const quantity = Math.floor(Math.random() * 10) + 1; // Random quantity between 1 and 10
            const amount = (Math.random() * 1000 + 100).toFixed(2); // Random amount between 100 and 1100
            const dealer = dealers[Math.floor(Math.random() * 7)]; // Random dealer between 1 to 7
            const status = ["Completed", "Pending", "Failed"][Math.floor(Math.random() * 3)];

            // Update the totals
            totalQty += quantity;
            totalAmount += parseFloat(amount);
            dealerSales[dealers.indexOf(dealer)] += quantity;

            // Store the transaction
            const transaction = {
                id: id,
                date: transactionDate,
                quantity: quantity,
                amount: amount,
                dealer: dealer,
                status: status
            };

            allTransactions.push(transaction);

            return transaction;
        }

        // Generate 50 random transactions
        for (let i = 1; i <= 50; i++) {
            generateTransaction(i);
        }

        // Function to update the transaction table based on dealer filter
        function updateTransactionTable(dealerFilter = "All") {
            let filteredTransactions = allTransactions;

            if (dealerFilter !== "All") {
                filteredTransactions = allTransactions.filter(transaction => transaction.dealer === dealerFilter);
            }

            // Insert transactions into table body
            const transactionRows = filteredTransactions.map(transaction => {
                return `
                    <tr>
                        <td>TXN${transaction.id}</td>
                        <td>${transaction.date}</td>
                        <td>${transaction.quantity}</td>
                        <td>PHP ${transaction.amount}</td>
                        <td>${transaction.dealer}</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td><a href="#" class="btn btn-primary btn-view">View</a></td>
                    </tr>
                `;
            }).join('');

            document.getElementById("transactionBody").innerHTML = transactionRows;

            // Update Dashboard Stats based on filtered transactions
            const filteredTotalQty = filteredTransactions.reduce((acc, transaction) => acc + transaction.quantity, 0);
            const filteredTotalAmount = filteredTransactions.reduce((acc, transaction) => acc + parseFloat(transaction.amount), 0);

            // document.getElementById("totalQty").innerText = filteredTotalQty;
            // document.getElementById("totalAmount").innerText = `PHP ${filteredTotalAmount.toFixed(2)}`;
            // document.getElementById("dealerSales").innerText = `${dealerFilter} - ${filteredTotalQty}`;
        }

        // Initial load of the table and stats
        updateTransactionTable();

        // Add event listener to the dealer filter dropdown
        document.getElementById("dealerFilter").addEventListener("change", function () {
            const selectedDealer = this.value;
            updateTransactionTable(selectedDealer);
        });

    });
</script>
@endsection
