<?php
include("components/header.php");
?>

<div class="main" style="background-color: 	#F5F5F5;">

<div class="container mt-5">
        <h1>Create Invoice</h1>
        <button class="btn btn-warning mb-3" id="add-row">Add Row</button>
        <div id="invoice-table"></div>
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

    // Add row function
    document.getElementById("add-row").addEventListener("click", function() {
        table.addRow({});
    });
    </script>

</div>


<?php
include("components/footer.php");
?>