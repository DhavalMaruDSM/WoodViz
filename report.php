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
                <div class="col-md-12">
                    <span class="fw-bolder fs-3 ms-4">Reports</span>
                </div>
            </div>
        </div>
        <div class="container mb-3">
            <div class="card m-2 border-0">
                <div class="card-header p-2 pt-0">
                    <ul class="nav nav-tabs card-header-tabs" id="reporttab" role="tablist">
                        <li class="nav-item" role="customerReport1">
                            <button 
                            class="nav-link active" 
                            id="customerReport" 
                            data-bs-toggle="tab" 
                            data-bs-target="#customerReport-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="customerReport-tab-pane" 
                            aria-selected="true">
                                Customer Report
                            </button>
                        </li>
                        <li class="nav-item" role="productReport1">
                            <button 
                            class="nav-link" 
                            id="productReport" 
                            data-bs-toggle="tab" 
                            data-bs-target="#productReport-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="productReport-tab-pane" 
                            aria-selected="false">
                                Product Wise Report
                            </button>
                        </li>
                        <li class="nav-item" role="transactionActivity1">
                            <button 
                            class="nav-link" 
                            id="transactionActivity" 
                            data-bs-toggle="tab" 
                            data-bs-target="#transactionActivity-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="transactionActivity-tab-pane" 
                            aria-selected="false">
                                Transaction Activity
                            </button>
                        </li>
                        <li class="nav-item" role="categoryReport1">
                            <button 
                            class="nav-link" 
                            id="categoryReport" 
                            data-bs-toggle="tab" 
                            data-bs-target="#categoryReport-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="categoryReport-tab-pane" 
                            aria-selected="false">
                                Category Wise Report
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                <div class="m-3" style="padding: 1px;">
                        <form id="paymentform">
                            <div class="row">
                                <div class="mb-3 col-md-5">
                                    <label for="fromDate" class="form-label">From Date:</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="toDate" class="form-label">To Date:</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate" required>
                                </div>
                                <div class="mt-4 mb-3 pt-2 col-md-2">
                                    <button class="btn btn-success" type="button" id="generateButton">Generate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="m-3">
                        <div class="mb-4 pb-3">
                            <button class="btn btn-warning" type="button" id="downloadButton">Download XLSX</button>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div 
                        class="tab-pane fade show active" 
                        id="customerReport-tab-pane"
                        role="tabpanel"
                        aria-labelledby="customerReport"
                        tabindex="0">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="customerReport-table"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div 
                        class="tab-pane fade" 
                        id="productReport-tab-pane"
                        role="tabpanel"
                        aria-labelledby="productReport"
                        tabindex="0">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="productReport-table"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div 
                        class="tab-pane fade" 
                        id="transactionActivity-tab-pane"
                        role="tabpanel"
                        aria-labelledby="transactionActivity"
                        tabindex="0">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="transactionActivity-table"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div 
                        class="tab-pane fade" 
                        id="categoryReport-tab-pane"
                        role="tabpanel"
                        aria-labelledby="categoryReport"
                        tabindex="0">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="categoryReport-table"></div>
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
    <script src="assets/js/report.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>