<?php
include("components/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="main" style="background-color: #F5F5F5;">
        <div class="container my-3">
            <div class="row">
                <div class="col-md-10">
                    <span class="fw-bolder fs-3 ms-4">Invoices</span>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-warning" id="newInvoiceBtn">+ New Invoice</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row m-2">
                <div class="col-md-3">
                    <div class="card m-2 p-3 border-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="m-1 p-2 pe-3 bg-info bg-opacity-25 rounded"><i class="text-info bi bi-file-earmark-text h3"></i></div>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content center">
                                    <div class="col-md-12">
                                        <small class="text-dark text-opacity-75">&nbsp;Total Invoice</small>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="fw-bold fs-4" id="totalIncome"><i class="bi bi-currency-rupee"></i>20000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div><span class="text-dark text-opacity-50">No of Invoice:&nbsp;</span><span class="fw-bold" id="invcount">32</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card m-2 p-3 border-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="m-1 p-2 pe-3 bg-warning bg-opacity-25 rounded"><i class="text-warning bi bi-file-earmark-check h3"></i></div>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content center">
                                    <div class="col-md-12">
                                        <small class="text-dark text-opacity-75">&nbsp;Paid Invoices</small>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="fw-bold fs-4" id="totalPaid"><i class="bi bi-currency-rupee"></i>30000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div><span class="text-dark text-opacity-50">No of Invoice:&nbsp;</span><span class="fw-bold" id="paidcount">12</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card m-2 p-3 border-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="m-1 p-2 pe-3 bg-success bg-opacity-10 rounded"><i class="text-success bi bi-file-earmark-arrow-up h3"></i></div>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content center">
                                    <div class="col-md-12">
                                        <small class="text-dark text-opacity-75">&nbsp;Unpaid Invoices</small>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="fw-bold fs-4" id="totalPending"><i class="bi bi-currency-rupee"></i>2000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div><span class="text-dark text-opacity-50">No of Invoice:&nbsp;</span><span class="fw-bold" id="unpaidctn">2</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card m-2 p-3 border-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="m-1 p-2 pe-3 bg-danger bg-opacity-25 rounded"><i class="text-danger bi bi-file-earmark-x h3"></i></div>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content center">
                                    <div class="col-md-12">
                                        <small class="text-dark text-opacity-75">&nbsp;Cancelled</small>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="fw-bold fs-4" id="totalCancelled"><i class="bi bi-currency-rupee"></i>10000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div><span class="text-dark text-opacity-50">No of Invoice:&nbsp;</span><span class="fw-bold" id="calctn">10</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-3">
            <div class="card m-2 border-0">
                <div class="card-header p-2 pt-0">
                    <ul class="nav nav-tabs card-header-tabs" id="mytab" role="tablist">
                        <li class="nav-item" role="allinvoice1">
                            <button 
                            class="nav-link active" 
                            id="allinvoice" 
                            data-bs-toggle="tab" 
                            onclick="filterTable('')"
                            data-bs-target="#allinvoice-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="allinvoice-tab-pane" 
                            aria-selected="true">
                                All Invoice
                            </button>
                        </li>
                        <li class="nav-item" role="paidinvoice1">
                            <button 
                            class="nav-link" 
                            onclick="filterTable('Paid')"
                            id="paidinvoice" 
                            data-bs-toggle="tab" 
                            data-bs-target="#paidinvoice-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="paidinvoice-tab-pane" 
                            aria-selected="false">
                                Paid Invoices
                            </button>
                        </li>
                        <li class="nav-item" role="unpaidinvoice1">
                            <button 
                            class="nav-link" 
                            id="unpaidinvoice" 
                            data-bs-toggle="tab" 
                            data-bs-target="#unpaidinvoice-tab-pane"
                            onclick="filterTable('Unpaid')"
                            type="button" 
                            role="tab" 
                            aria-controls="unpaidinvoice-tab-pane" 
                            aria-selected="false">
                                Pending Invoices
                            </button>
                        </li>
                        <li class="nav-item" role="cancelled1">
                            <button 
                            class="nav-link" 
                            id="cancelled" 
                            data-bs-toggle="tab" 
                            data-bs-target="#cancelled-tab-pane"
                            type="button" 
                            onclick="filterTable('Cancelled')"
                            role="tab" 
                            aria-controls="cancelled-tab-pane" 
                            aria-selected="false">
                                Cancelled
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="m-3">
                        <div class="input-group" style="padding: 1px;">
                            <i class="bi bi-search p-2" style="color: orange; -webkit-text-stroke: 1px;"></i>
                            <select class="form-select" id="searchSelect" required>
                                <option disabled selected>Select Search</option>
                                <option value="invoiceNo">Invoice Number</option>
                                <option value="customerName">Customer Name</option>
                            </select>
                            <input type="search" class="form-control" id="searchInput" placeholder="Search here..">
                            <button class="btn btn-outline-warning" onclick="searchfun()" id="searchbtninvoice">Search</button>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div 
                        class="tab-pane fade show active" 
                        role="tabpanel"
                        tabindex="0">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="allinvoice-table"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="paymentform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="invoiceNo" class="form-label">Invoice Number:</label>
                                <input type="text" class="form-control" id="invoiceNo" name="invoiceNo" placeholder="Enter Invoice Number" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="customername" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="customername" name="customername" placeholder="Enter Customer Name" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="paymentValue" class="form-label">Payment Value:</label>
                                <input type="number" class="form-control" value="0" id="paymentValue" name="paymentValue" required >
                            </div>
                        </div><div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="Refrence number" class="form-label">Refrence Number :</label>
                                <input type="text" class="form-control" value="0" id="refrence-number" name="refrence-number" required >
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="paymentMode" class="form-label">Payment Mode:</label>
                                <select class="form-select" id="paymentMode" required>
                                    <option disabled selected>Select a Payment Mode</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="Net Banking">Net Banking</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="paymentStatus" class="form-label">Payment Status:</label>
                                <select class="form-select" id="paymentStatus" required>
                                    <option disabled selected>Select Payment Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="Partially paid">Partially paid</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="paymentButton">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="assets/js/js/tabulator.min.js"></script>
    <script src="assets/js/invoiceList.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>
