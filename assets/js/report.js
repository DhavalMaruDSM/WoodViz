$(document).ready(function () {

    var customerReportTable = new Tabulator("#customerReport-table", {
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
                title: "customer_id",
                field: "customer_id",
                sorter: "number",
            },
            {
                field: "actions",
                title: "Actions",
                formatter: function (cell, formatterParams) {
                    let div = document.createElement("div");

                    let view = document.createElement("button");
                    view.className = "btn btn-sm btn-primary me-2";
                    view.innerHTML = "View";
                    view.onclick = function () {
                        let rowData = cell.getRow().getData();
                        allInvoice(rowData);
                    };
                    div.appendChild(view);
                    return div;
                }
            }
        ]
    });

    var productReportTable = new Tabulator("#productReport-table", {
        height: 300,
        layout: "fitColumns",
        columns: [
            { title: "Product Name", field: "productName", sorter: "string" },
            { title: "Total Product Sale", field: "totalProductSale", sorter: "number" },
            { title: "Total Sale Amount", field: "totalSaleAmt", sorter: "number" },
            { field: "actions", title: "Actions", formatter: function (cell, formatterParams) {
                let div = document.createElement("div");

                let view = document.createElement("button");
                view.className = "btn btn-sm btn-primary me-2";
                view.innerHTML = "View";
                view.onclick = function () {
                    let rowData = cell.getRow().getData();
                    allInvoice(rowData);
                };
                div.appendChild(view);
                return div;
            }}
        ]
    });

    var transactionActivityTable = new Tabulator("#transactionActivity-table", {
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
            }
        ]
    });

    var categoryReportTable = new Tabulator("#categoryReport-table", {
        height: 300,
        layout: "fitColumns",
        columns: [
            {
                title: "Category",
                field: "categoryName",
                sorter: "string",
            },
            {
                title: "Total Sale Quantity",
                field: "totalCategorySale",
                sorter: "number",
            },
            {
                title: "Total Sale Amount",
                field: "totalCategorySaleAmt",
                sorter: "number",
            }
        ]
    });

    // Invoice Table
    var invoiceTable = new Tabulator("#invoice-table", {
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
                field: "invoice_date",
                sorter: "date",
            },
            {
                title: "Amount",
                field: "invoice_value",
                sorter: "number",
            },
            {
                field: "actions",
                title: "Actions",
                formatter: function (cell, formatterParams) {
                    let div = document.createElement("div");

                    let button1 = document.createElement("button");
                    button1.className = "btn btn-sm btn-primary me-2";
                    button1.innerHTML = "Button";
                    button1.onclick = function () {
                        let rowData = cell.getRow().getData();
                    };
                    div.appendChild(button1);
                    return div;
                }
            }
        ]
    });

    function fetchCustomerReport(fromDate, toDate) {
        $.ajax({
            type: "GET",
            url: "php/fetchReportCusttable.php",
            data: {
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                console.log("Customer report fetched successfully:", response);
                renderCustomerReport(response);
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching customer report:", error);
                console.log(xhr.responseText);
                alert("Failed to fetch customer report. Please try again later.");
            }
        });
    }

    function fetchProductReport(fromDate, toDate) {
        $.ajax({
            type: "GET",
            url: "php/fetchProductReport.php",
            data: { fromDate: fromDate, toDate: toDate },
            success: function(response) {
                console.log("Product report fetched successfully:", response);
                productReportTable.setData(JSON.parse(response));
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching product report:", error);
                console.log(xhr.responseText);
                alert("Failed to fetch product report. Please try again later.");
            }
        });
    }

    function fetchTransactionActivity(fromDate, toDate) {
        $.ajax({
            type: "GET",
            url: "php/fetchTransactionActivity.php",
            data: {
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                console.log("Transaction activity fetched successfully:", response);
                renderTransactionActivity(response);
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching transaction activity:", error);
                console.log(xhr.responseText);
                alert("Failed to fetch transaction activity. Please try again later.");
            }
        });
    }

    function fetchCategoryReport(fromDate, toDate) {
        $.ajax({
            type: "GET",
            url: "php/fetchCategoryReport.php",
            data: { fromDate: fromDate, toDate: toDate },
            success: function(response) {
                console.log("Category report fetched successfully:", response);
                categoryReportTable.setData(JSON.parse(response));
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching category report:", error);
                console.log(xhr.responseText);
                alert("Failed to fetch category report. Please try again later.");
            }
        });
    }

    function renderCustomerReport(data) {
        customerReportTable.setData(data);
    }

    function renderTransactionActivity(data) {
        transactionActivityTable.setData(data);
    }

    
    function allInvoice(rowData) {
        var modal = new bootstrap.Modal(document.getElementById('invoiceModal'));
        modal.show();
    
        if (!rowData.customer_id) {
            console.error("No invoice_id provided in rowData:", rowData);
            alert("No invoice details found. Please try again.");
            return;
        }
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;
    
        $.ajax({
            type: "GET",
            url: "php/CustomerReportView.php",
            data: {
                cname: rowData.customer_id,
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                console.log("Invoice details fetched successfully:", response);
                if (response.error) {
                    console.error("Server returned an error:", response.error);
                    alert("Failed to fetch invoice details. Please try again later.");
                    return;
                }
                invoiceTable.setData(response);
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching invoice details:", error);
                console.log(xhr.responseText);
                alert("Failed to fetch invoice details. Please try again later.");
            }
        });
    }
    
    

    document.getElementById('generateButton').addEventListener('click', function() {
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;
        
        var activeTabId = $('#reporttab .nav-link.active').attr('id');
        
        switch (activeTabId) {
            case 'customerReport':
                fetchCustomerReport(fromDate, toDate);
                break;
            case 'productReport':
                fetchProductReport(fromDate, toDate);
                break;
            case 'transactionActivity':
                fetchTransactionActivity(fromDate, toDate);
                break;
            case 'categoryReport':
                fetchCategoryReport(fromDate, toDate);
                break;
            default:
                console.log('Unknown tab clicked');
                break;
        }
    });

    $('#transactionActivityButton').click(function() {
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;
        fetchTransactionActivity(fromDate, toDate);
    });

});
