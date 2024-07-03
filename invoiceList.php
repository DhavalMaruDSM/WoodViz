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
                            <button class="btn btn-outline-warning" id="searchbtninvoice">Search</button>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="assets/js/tabulator.min.js"></script>
    <script src="assets/js/invoiceList.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>
