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
        <div class="container mb-3 mt-5">
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
                            onclick="filterTable('Pending')"
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
