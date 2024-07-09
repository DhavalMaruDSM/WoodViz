var table=new Tabulator("#customerReport-table",{
    height: 300,
    layout: "fitColumns",
    columns: [
    {
        title: "Customer Name",
        field: "customerName",
        sorter: "string",
    },
    {
        title: "Total Bills Generated",
        field: "totalBillsGenerated",
        sorter: "number",
    },
    {
        title: "Total Bill Amount",
        field: "totalBillAmt",
        sorter: "number",
    },
    {
        title: "Balance",
        field: "balance",
        sorter: "number",
    },
    {
        field: "actions",
        title: "Actions",
        formatter: function (cell, formatterParams) 
        {
            let div = document.createElement("div");

            let view = document.createElement("button");
            view.className = "btn btn-sm btn-primary me-2";
            view.innerHTML = "View";
            view.onclick = function () 
            {
                let rowData = cell.getRow().getData();
                allInvoice(rowData);
            };
            div.appendChild(view);
            return div;
        }
    }
    ]
});

var table=new Tabulator("#productReport-table",{
    height: 300,
    layout: "fitColumns",
    columns: [
    {
        title: "Product Name",
        field: "productName",
        sorter: "string",
    },
    {
        title: "Total Product Sale",
        field: "totalProductSale",
        sorter: "number",
    },
    {
        title: "Total Sale Amount",
        field: "totalSaleAmt",
        sorter: "number",
    },
    {
        field: "actions",
        title: "Actions",
        formatter: function (cell, formatterParams) 
        {
            let div = document.createElement("div");

            let view1 = document.createElement("button");
            view1.className = "btn btn-sm btn-primary me-2";
            view1.innerHTML = "View";
            view1.onclick = function () 
            {
                let rowData = cell.getRow().getData();
                allInvoice(rowData);
            };
            div.appendChild(view1);
            return div;
        }
    }
    ]
});

function allInvoice(rowData) {
    var modal = new bootstrap.Modal(document.getElementById('invoiceModal'));
    modal.show();
}

var table=new Tabulator("#transactionActivity-table",{
    height: 300,
    layout: "fitColumns",
    columns: [
    {
        title: "Date",
        field: "date",
        sorter: "date",
    },
    {
        title: "Invoice Id",
        field: "invoice_id",
        sorter: "number",
    },
    {
        title: "Customer Name",
        field: "customerName",
        sorter: "string",
    },
    {
        title: "Payment Mode",
        field: "paymentMode",
        sorter: "string",
    },
    {
        title: "Ref",
        field: "ref",
        sorter: "string",
    },
    {
        title: "Value",
        field: "value",
        sorter: "number",
    },
    ]
});

var table=new Tabulator("#categoryReport-table",{
    height: 300,
    layout: "fitColumns",
    columns: [
    {
        title: "Category",
        field: "category",
        sorter: "string",
    },
    {
        title: "Total Sale Quantity",
        field: "totalSaleQuantity",
        sorter: "number",
    },
    {
        title: "Total Sale Amount",
        field: "totalSaleAmt",
        sorter: "number",
    },
    ]
});

var table=new Tabulator("#invoice-table",{
    height: 300,
    layout: "fitColumns",
    columns: [
    {
        title: "Invoice Id",
        field: "invoice_id",
        sorter: "number",
    },
    {
        title: "Invoice Date",
        field: "date",
        sorter: "date",
    },
    {
        title: "Amount",
        field: "Amt",
        sorter: "number",
    },
    {
        field: "actions",
        title: "Actions",
        formatter: function (cell, formatterParams) 
        {
            let div = document.createElement("div");

            let button1 = document.createElement("button");
            button1.className = "btn btn-sm btn-primary me-2";
            button1.innerHTML = "Button";
            button1.onclick = function () 
            {
                let rowData = cell.getRow().getData();
            };
            div.appendChild(button1);
            return div;
        }
    }
    ]
});