var table=new Tabulator("#allinvoice-table",{
    height: 600,
    layout: "fitColumns",
    columns: [{
        title: "Invoice No.",
        field: "invoiceNo",
        sorter: "number",
    },
    {
        title: "Created Date",
        field: "createdDate",
        sorter: "date",
    },
    {
        title: "Customer Name",
        field: "customerName",
        sorter: "string",
    },
    {
        title: "Total Amount",
        field: "totalAmt",
        sorter: "number",
    },
    {
        title: "Paid Amount",
        field: "paidAmt",
        sorter: "number",
    },
    {
        title: "Balance",
        field: "balance",
        sorter: "number",
    },
    {
        title: "Due Date",
        field: "dueDate",
        sorter: "number",
    },
    {
        title: "Payment Mode",
        field: "paymentMode",
        sorter: "string",
    },
    {
        title: "Status",
        field: "status",
        sorter: "string",
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