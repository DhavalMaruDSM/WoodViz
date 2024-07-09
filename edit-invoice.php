<?php
include("components/header.php");
$invoice_id = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : null;
?>

<div class="main" style="background-color: 	#F5F5F5;">

    <div class="container mt-5">
        <h1>Edit Invoice</h1>

        <form id="invoice-form">
            <div class="row">
            <div class="mb-3 col-2">
                    <label for="invoice-number" class="form-label">Invoice Number</label>
                    <input type="text" class="form-control" id="invoice-number" value="0624001" readonly>
                </div>
                <div class="mb-3 col-2">
                    <label for="edit-customer-name" class="form-label">Customer Name</label>
                    <select class="form-select" id="edit-customer-name">
                        <option value="">Select a Customer</option>
                        <option value="customer1">Customer 1</option>
                        <option value="customer2">Customer 2</option>
                        <option value="customer3">Customer 3</option>
                    </select>
                </div>
                <div class="mb-3 col-4">
                    <label for="customer-address1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="customer-address1" readonly>
                </div>
                <div class="mb-3 col-4">
                    <label for="customer-address2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="customer-address2" readonly>
                </div>
                
            </div>
            <div class="row">
                <div class="mb-3 col-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" readonly>
                </div>
                <div class="mb-3 col-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" readonly>
                </div>
                <div class="mb-3 col-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control" id="pincode" readonly>
                </div>
                <div class="mb-3 col-3">
                    <label for="state-code" class="form-label">State Code</label>
                    <input type="text" class="form-control" id="state-code" readonly>
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
                    <label for="edit-invoice-date" class="form-label">Invoice Date</label>
                    <input type="date" class="form-control" id="edit-invoice-date">
                </div>
                <div class="mb-3 col-3">
                    <label for="edit-due-date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="edit-due-date">
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
            <button type="submit" class="btn btn-warning col-2 m-4 mt-5">Edit Invoice</button>
        </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/tabulator-tables@5.3.2/dist/js/tabulator.min.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const invoiceId = <?php echo json_encode($_GET['invoice_id'] ?? null); ?>;
    initializeDateFields();
    fetchCustomers();
    fetchProducts(function() {
        if (invoiceId) {
            fetchInvoiceDetails(invoiceId);
        }
    });

document.getElementById("add-row").addEventListener("click", function(event) {
                event.preventDefault();
                table.addRow({});
            });
});

let table;

function fetchInvoiceDetails(invoiceId) {
    $.ajax({
        url: 'php/get-invoice-details.php',
        method: 'GET',
        data: { invoice_id: invoiceId },
        success: function(data) {
            const invoice = JSON.parse(data);

            if (invoice.error) {
                console.error('Error fetching invoice:', invoice.error);
                return;
            }

            $('#invoice-number').val(invoice.invoice_id);
            $('#edit-customer-name').val(invoice.customer_id).change();
            $('#edit-invoice-date').val(invoice.invoice_date);
            $('#edit-due-date').val(invoice.due_date);
            $('#note').val(invoice.note);
            $('#customer-address1').val(invoice.address_line_1);
            $('#customer-address2').val(invoice.address_line_2);
            $('#city').val(invoice.city);
            $('#state').val(invoice.state);
            $('#pincode').val(invoice.pincode);
            $('#state-code').val(invoice.state_code);
            $('#gst').val(invoice.gst);
            $('#pan').val(invoice.pan);
            table.setData(invoice.items).then(function() {
                console.log('Data successfully loaded into Tabulator');
            }).catch(function(error) {
                console.error('Error loading data into Tabulator:', error);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching invoice details:', error);
        }
    });
}

function initializeDateFields() {
    var today = new Date();
    document.getElementById('edit-invoice-date').value = formatDate(today);
    document.getElementById('edit-due-date').value = formatDate(addDays(today, 5));
}

function formatDate(date) {
    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var year = date.getFullYear();
    return year + '-' + month + '-' + day;
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

function fetchCustomers() {
    $.ajax({
        url: 'php/get-customer.php',
        method: 'GET',
        success: function(data) {
            var customers = JSON.parse(data);
            var customerSelect = $('#edit-customer-name');
            customerSelect.empty().append('<option value="">Select a Customer</option>');
            customers.forEach(function(customer) {
                customerSelect.append('<option value="' + customer.id + '">' + customer.name + '</option>');
            });
            console.log(customers);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching customers:', error);
        }
    });
}
$('#edit-customer-name').change(function() {
            var customerId = $(this).val();
            $.ajax({
                url: 'php/get-customer-details.php',
                method: 'GET',
                data: { customer_id: customerId },
                success: function(data) {
                    var customer = JSON.parse(data);
                    $('#customer-address1').val(customer.address_line_1);
                    $('#customer-address2').val(customer.address_line_2);
                    $('#city').val(customer.city);
                    $('#state').val(customer.state);
                    $('#pincode').val(customer.pincode);
                    $('#state-code').val(customer.state_code);
                    $('#gst').val(customer.gst);
                    $('#pan').val(customer.pan);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching customer details:', error);
                }
            });
        });


function fetchProducts(callback) {
    $.ajax({
        url: 'php/get-product.php',
        method: 'GET',
        success: function(data) {
            var products = JSON.parse(data);
            var uniqueProducts = [];
            var productValues = {};
            var productIds = new Set();

            products.forEach(function(product) {
                if (!productIds.has(product.product_id)) {
                    productIds.add(product.product_id);
                    uniqueProducts.push(product);
                    productValues[product.product_id] = product.name;
                }
            });

            initializeTabulator(productValues, uniqueProducts);
            if (callback) callback();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', error);
        }
    });
}
function fetchProductDetails(product_id, row) {
            $.ajax({
                url: 'php/get-product-details.php',
                method: 'GET',
                data: { product_id: product_id },
                success: function(data) {
                    var product = JSON.parse(data);
                    row.update({
                        rate: product.price,
                        cgst: product.cgst,
                        sgst: product.sgst,
                        igst: product.igst
                    });
                    updateRowAmounts(row);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product details:', error);
                }
            });
        }

function initializeTabulator(productValues, products) {
    table = new Tabulator("#invoice-table", {
        layout: "fitColumns",
        columns: [
            { title: "Product ID", field: "product_id", visible: false },
            {
                title: "Item",
                field: "product_name",
                editor: "select",
                editorParams: function(cell) {
                    return {
                        values: getAvailableProducts(cell, productValues)
                    };
                },
                cellEdited: function(cell) {
    var selectedProductId = cell.getValue();
    var selectedProduct = products.find(product => product.product_id == selectedProductId);
    if (selectedProduct) {
        cell.getRow().update({
            product_id: selectedProduct.product_id,
            product_name: selectedProduct.name,
            Taxable : selectedProduct.Taxable,
            rate: selectedProduct.price,
            cgst: selectedProduct.cgst_percent,
            sgst: selectedProduct.sgst_percent,
            igst: selectedProduct.igst_percent,
            unit_price: selectedProduct.price
        });
        fetchProductDetails(selectedProduct.product_id, cell.getRow());
        updateRowAmounts(cell.getRow());
    } else {
        console.error('Product not found');
    }
}

            },
            { title: "Qty", field: "quantity", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
            { title: "Rate", field: "unit_price", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
            { title: "Taxable", field: "Taxable", bottomCalc: "sum" },
            { title: "Cgst (%)", field: "cgst", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
            { title: "Cgst Amount", field: "cgst_amount", bottomCalc: "sum" },
            { title: "Sgst (%)", field: "sgst", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
            { title: "Sgst Amount", field: "sgst_amount", bottomCalc: "sum" },
            { title: "Igst (%)", field: "igst", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
            { title: "Igst Amount", field: "igst_amount", bottomCalc: "sum" },
            { title: "Total Value", field: "total_value", bottomCalc: "sum" },
            {title: "Actions", field: "actions", formatter: deleteButtonFormatter, width: 100, align: "center"}
        ],
        cellEdited: function(cell) {
            updateRowAmounts(cell.getRow());
        },
        
        data: [], // Initialize with empty data, will be set dynamically
    });
    function deleteButtonFormatter(cell, formatterParams) {
        var button = document.createElement("button");
        button.innerHTML = "Delete";
        button.addEventListener("click", function() {
            cell.getRow().delete();
        });
        return button;
    }
}

function getAvailableProducts(cell, productValues) {
    var table = cell.getTable();
    var rows = table.getRows();
    var selectedProductIds = rows.map(row => row.getData().product_id);
    var availableProducts = Object.assign({}, productValues);

    selectedProductIds.forEach(function(productId) {
        delete availableProducts[productId];
    });

    return availableProducts;
}

function updateRowAmounts(row) {
    var data = row.getData();
    var unitPrice = parseFloat(data.unit_price) || 0;
    var quantity = parseFloat(data.quantity || data.qty) || 1;
    var Taxable = unitPrice * quantity;
    var cgstPercent = parseFloat(data.cgst || data.cgst_percent) || 0;
    var sgstPercent = parseFloat(data.sgst || data.sgst_percent) || 0;
    var igstPercent = parseFloat(data.igst || data.igst_percent) || 0;
    var cgstAmount = (Taxable * cgstPercent / 100).toFixed(2);
    var sgstAmount = (Taxable * sgstPercent / 100).toFixed(2);
    var igstAmount = (Taxable * igstPercent / 100).toFixed(2);
    var totalValue = (parseFloat(Taxable) + parseFloat(cgstAmount) + parseFloat(sgstAmount) + parseFloat(igstAmount)).toFixed(2);

    row.update({
        Taxable: Taxable.toFixed(2),
        cgstPercent:cgstPercent,
        cgst_amount: cgstAmount,
        sgst_amount: sgstAmount,
        igst_amount: igstAmount,
        total_value: totalValue,
        total: totalValue // Including the 'total' field if needed
    });
}

$('#invoice-form').on('submit', function(e) {
    e.preventDefault();
    const invoiceData = {
        invoice_id: <?php echo json_encode($_GET['invoice_id'] ?? null); ?>,
        customer_id: $('#edit-customer-name').val(),
        invoice_date: $('#edit-invoice-date').val(),
        due_date: $('#edit-due-date').val(),
        note: $('#note').val(),
        items: table.getData(),
    };

    $.ajax({
        url: 'php/edit-invoice.php',
        method: 'POST',
        data: invoiceData,
        success: function(response) {
            console.log('Invoice edited successfully:', response);
            alert('Invoice updated successfully!');
        window.location.href = 'invoicelist.php';
        },
        error: function(xhr, status, error) {
            console.error('Error editing invoice:', error);
        }
    });
});
</script>
</div>

<?php
include("components/footer.php");
?>