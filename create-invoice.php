<?php
include("components/header.php");
?>

<div class="main" style="background-color: 	#F5F5F5;">

<div class="container mt-5">
        <h1>Create Invoice</h1>

        <form id="invoice-form">
            <div class="row">
                <div class="mb-3 col-3">
                    <label for="invoice-number" class="form-label">Invoice Number</label>
                    <input type="text" class="form-control" id="invoice-number" value="0624001" readonly>
                </div>
                <div class="mb-3 col-3">
                    <label for="customer-name" class="form-label">Customer Name</label>
                    <select class="form-select" id="customer-name">
                        <option value="">Select a Customer</option>
                        <option value="customer1">Customer 1</option>
                        <option value="customer2">Customer 2</option>
                        <option value="customer3">Customer 3</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="customer-address" class="form-label">Customer Address</label>
                    <input type="text" class="form-control" id="customer-address" readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-3">
                    <label for="gst" class="form-label">GST Number</label>
                    <input type="text" class="form-control" id="gst" readonly>
                </div>
                <div class="mb-3 col-3">
                    <label for="pan" class="form-label">PAN Number</label>
                    <input type="text" class="form-control" id="pan" readonly>
                </div>
            
                <div class="mb-3 col-3">
                    <label for="invoice-date" class="form-label">Invoice Date</label>
                    <input type="date" class="form-control" id="invoice-date">
                </div>
                <div class="mb-3 col-3">
                    <label for="due-date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="due-date">
                </div>
            </div>
            

        <button class="btn btn-warning mb-3" id="add-row">Add Row</button>
        <div id="invoice-table"></div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="note" class="form-label">Note</label>
                <textarea class="form-control" id="note" rows="2"></textarea>
            </div>
            <div class="col-3"></div>
            <button type="submit" class="btn btn-warning col-2 m-4 mt-5">Create Invoice</button>
        </div>
    </form>
    </div>
    <script src="https://unpkg.com/tabulator-tables@5.3.2/dist/js/tabulator.min.js"></script>
    
    <script>
    // Sample data
    var tabledata = [
        { item: "Item 1", qty: 1, rate: 100, taxable: 100, cgst_percent: 5, cgst_amount: 5, sgst_percent: 5, sgst_amount: 5, igst_percent: 10, igst_amount: 10, total: 120 },
        { item: "Item 2", qty: 2, rate: 200, taxable: 400, cgst_percent: 5, cgst_amount: 20, sgst_percent: 5, sgst_amount: 20, igst_percent: 10, igst_amount: 40, total: 480 },
        { item: "Item 3", qty: 1, rate: 150, taxable: 150, cgst_percent: 5, cgst_amount: 7.5, sgst_percent: 5, sgst_amount: 7.5, igst_percent: 10, igst_amount: 15, total: 180 }
    ];

    // Initialize Tabulator
    var table = new Tabulator("#invoice-table", {
        data: tabledata,
        layout: "fitColumns",
        columns: [
            { title: "Item", field: "item", editor: "select", editorParams: {
                values: ["Item 1", "Item 2", "Item 3"]
            }},
            { title: "Qty", field: "qty", editor: "input" },
            { title: "Rate", field: "rate", editor: "input" },
            { title: "Taxable", field: "taxable", bottomCalc: "sum" },
            { title: "Cgst (%)", field: "cgst_percent" },
            { title: "Cgst Amount", field: "cgst_amount", bottomCalc: "sum" },
            { title: "Sgst (%)", field: "sgst_percent" },
            { title: "Sgst Amount", field: "sgst_amount", bottomCalc: "sum" },
            { title: "Igst (%)", field: "igst_percent" },
            { title: "Igst Amount", field: "igst_amount", bottomCalc: "sum" },
            { title: "Total", field: "total", bottomCalc: "sum" },
            {
                title: "Actions", field: "actions", formatter: function(cell, formatterParams) {
                    var button = document.createElement("button");
                    button.classList.add("btn", "btn-danger", "btn-sm");
                    button.innerHTML = "Delete";
                    button.addEventListener("click", function() {
                        cell.getRow().delete();
                    });
                    return button;
                }
            }
        ]
    });

    document.getElementById("add-row").addEventListener("click", function() {
        table.addRow({});
    });
    </script>

</div>


<?php
include("components/footer.php");
?>