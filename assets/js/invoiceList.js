function statusFormatter(cell, formatterParams, onRendered) {
    const value = cell.getValue();
    let colorClass = 'bg-secondary'; 
    
    if (value === 'Paid') {
        colorClass = 'bg-success'; 
    } else if (value === 'Pending') {
        colorClass = 'bg-warning'; 
    }  else if (value === 'Cancelled') {
        colorClass = 'bg-danger'; 
    }

    return `<span class="badge ${colorClass}">${value}</span>`;
}

const invoiceData = [
    {
        invoiceNo: 1001,
        createdDate: "2024-06-25",
        customerName: "John Doe",
        totalAmt: 500,
        paidAmt: 300,
        balance: 200,
        dueDate: "2024-07-10",
        paymentMode: "Credit Card",
        status: "Pending",
    },
    {
        invoiceNo: 1002,
        createdDate: "2024-06-26",
        customerName: "Jane Smith",
        totalAmt: 800,
        paidAmt: 800,
        balance: 0,
        dueDate: "2024-07-15",
        paymentMode: "Cash",
        status: "Paid",
    },
    {
        invoiceNo: 1004,
        createdDate: "2024-06-28",
        customerName: "Bob Johnson",
        totalAmt: 1200,
        paidAmt: 0,
        balance: 1200,
        dueDate: "2024-07-25",
        paymentMode: "Cheque",
        status: "Cancelled",
    },
    // Add more dummy data as needed
];

let table = new Tabulator("#allinvoice-table", {
    height: 600,
    layout: "fitColumns",
    data: invoiceData,
    columns: [
        { title: "Invoice No.", field: "invoiceNo", sorter: "number" },
        { title: "Created Date", field: "createdDate", sorter: "date" },
        { title: "Customer Name", field: "customerName", sorter: "string" },
        { title: "Total Amount", field: "totalAmt", sorter: "number" },
        { title: "Paid Amount", field: "paidAmt", sorter: "number" },
        { title: "Balance", field: "balance", sorter: "number" },
        { title: "Due Date", field: "dueDate", sorter: "date" },
        { title: "Payment Mode", field: "paymentMode", sorter: "string" },
        { title: "Status", field: "status", sorter: "string", formatter: statusFormatter },
        {
            field: "actions",
            title: "Actions",
            formatter: function (cell, formatterParams) {
                let div = document.createElement("div");

                let button = document.createElement("button");
                button.className = "btn btn-sm btn-primary me-2";
                button.innerHTML = "Edit";
                button.onclick = function () {
                    let rowData = cell.getRow().getData();
                    fillForm(rowData); // Replace with your edit function
                };
                div.appendChild(button);

                return div;
            },
        },
    ],
});

function filterTable(status) {
    if (status) {
        table.setFilter("status", "=", status);
    } else {
        table.clearFilter();
    }
}

function calculateTotals() {
    let totalIncome = 0;
    let totalIncome_count = 0;
    let totalPaid = 0;
    let totalPaid_count = 0;
    let totalPending = 0;
    let totalPending_count = 0;
    let totalCancelled = 0;
    let totalCancelled_count = 0;

    invoiceData.forEach(invoice => {
        totalIncome += invoice.totalAmt;
        totalIncome_count++;
        if (invoice.status === 'Paid') {
            totalPaid += invoice.totalAmt;
            totalPaid_count++;
        } else if (invoice.status === 'Pending') {
            totalPending += invoice.totalAmt;
            totalPending_count++;
        } else if (invoice.status === 'Cancelled') {
            totalCancelled += invoice.totalAmt;
            totalCancelled_count++;
        }
    });

    document.getElementById('totalIncome').textContent = `₹${totalIncome}`;
    document.getElementById('invcount').textContent = `${totalIncome_count}`;
    document.getElementById('totalPaid').textContent = `₹${totalPaid}`;
    document.getElementById('paidcount').textContent = `${totalPaid_count}`;
    document.getElementById('totalPending').textContent = `₹${totalPending}`;
    document.getElementById('unpaidctn').textContent = `${totalPending_count}`;
    document.getElementById('totalCancelled').textContent = `₹${totalCancelled}`;
    document.getElementById('calctn').textContent = `${totalCancelled_count}`;
}

// Call the function to calculate totals on page load
window.onload = calculateTotals;
