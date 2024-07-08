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

            let Button1 = document.createElement("button");
            Button1.className = "btn btn-sm btn-primary me-2";
            Button1.innerHTML = "Button";
            Button1.onclick = function () 
            {
                let rowData = cell.getRow().getData();
                fillForm(rowData);
            };
            div.appendChild(Button1);
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
    ]
});

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