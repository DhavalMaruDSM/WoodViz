function statusFormatter(cell, formatterParams, onRendered) {
    const value = cell.getValue();
    let colorClass = 'bg-secondary';

    if (value === 'Paid') {
        colorClass = 'bg-success';
    } else if (value === 'Unpaid') {
        colorClass = 'bg-warning';
    } else if (value === 'Cancelled') {
        colorClass = 'bg-danger';
    }

    return `<span class="badge ${colorClass}">${value}</span>`;
}

let invoiceData = [];    // Add more dummy data as needed

let table = new Tabulator("#allinvoice-table", {
    height: 600,
    layout: "fitColumns",
    data: invoiceData,
    columns: [
        { title: "Invoice No.", field: "invoice_id", sorter: "number" },
        { title: "Created Date", field: "invoice_date", sorter: "date" },
        { title: "Customer Name", field: "name", sorter: "string" },
        { title: "Total Amount", field: "total_value", sorter: "number" },
        { title: "Paid Amount", field: "paid_amount", sorter: "number" },
        { title: "Balance", field: "balance", sorter: "number" },
        { title: "Due Date", field: "due_date", sorter: "date" },
        { title: "Payment Mode", field: "payment_mode", sorter: "string" },
        { title: "Status", field: "payment_status", sorter: "string", formatter: statusFormatter },
        {
            field: "actions",
            title: "Actions",
            width: 200,  // Increased width for better visibility of buttons
            formatter: function (cell, formatterParams) {
                let div = document.createElement("div");
                let editLink = document.createElement("a");
                editLink.href = "#"; 
                editLink.className = "btn btn-sm btn-primary me-2";
                editLink.innerHTML = "Edit";
                editLink.onclick = function (e) {
                    e.preventDefault();
                    let rowData = cell.getRow().getData();
                    let urlParams = new URLSearchParams(rowData).toString();
                    window.location.href = `edit-invoice.php?id=${rowData.invoice_id}`;
                };
                div.appendChild(editLink);

                let sendBillLink = document.createElement("a");
                sendBillLink.href = "#";
                sendBillLink.className = "btn btn-sm btn-secondary me-2";
                sendBillLink.innerHTML = "Send Bill";
                sendBillLink.onclick = function (e) {
                    e.preventDefault();
                    let rowData = cell.getRow().getData();
                    window.location.href = `#`;
                };
                div.appendChild(sendBillLink);

                let paymentButton = document.createElement("button");
                paymentButton.className = "btn btn-sm btn-success";
                paymentButton.innerHTML = "Pay";
                paymentButton.onclick = function () {
                    let rowData = cell.getRow().getData();
                    showPaymentModel(rowData); // Pass the entire row data here
                };
                div.appendChild(paymentButton);
                return div;
            }
        }
    ],
});

function showPaymentModel(rowData) {
    var modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();

    document.getElementById("invoiceNo").value = rowData.invoice_id;
    document.getElementById("customername").value = rowData.name;
    document.getElementById("paymentValue").value = rowData.total_value - rowData.paid_amount;
    document.getElementById("paymentMode").value = ''; 
    document.getElementById("paymentStatus").value = ''; 

    document.getElementById("paymentButton").onclick = function (e) {
        e.preventDefault(); 

        const paymentData = {
            invoice_id: document.getElementById("invoiceNo").value,
            customername: document.getElementById("customername").value,
            paymentValue: document.getElementById("paymentValue").value,
            paymentMode: document.getElementById("paymentMode").value,
            paymentStatus: document.getElementById("paymentStatus").value
        };

        console.log('Sending payment data:', paymentData); 

        fetch('php/updatePayment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(paymentData),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response data:', data); 
            if (data.success) {
            
                fetchInvoiceData();
                modal.hide();
            } else {
                alert('Failed to process payment: ' + data.message);
            }
        })
        .catch(error => {
            alert("An error occurred: " + error);
            console.error('Error:', error); 
        });
    };
}


function filterTable(status) {
    if (status) {
        table.setFilter("payment_status", "=", status);
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
        totalIncome += parseFloat(invoice.total_value);
        totalIncome_count++;
        if (invoice.payment_status === 'Paid') {
            totalPaid += parseFloat(invoice.total_value);
            totalPaid_count++;
        } else if (invoice.payment_status === 'Unpaid') {
            totalPending += parseFloat(invoice.total_value);
            totalPending_count++;
        } else if (invoice.payment_status === 'Cancelled') {
            totalCancelled += parseFloat(invoice.total_value);
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

function searchfun() {
    let dr = document.getElementById("searchSelect").value;
    let sbox = document.getElementById("searchInput").value;
    table.setFilter(dr, 'like', sbox);
}

function fetchInvoiceData() {
    fetch('php/Invoice_fetch.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data); // Debugging log
            invoiceData = data; 
            table.setData(invoiceData); 
            calculateTotals(); 
        })
        .catch(error => console.error('Error fetching invoice data:', error));
}

window.onload = function () {
    calculateTotals();
    fetchInvoiceData();
};
