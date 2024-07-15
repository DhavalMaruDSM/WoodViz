<?php
include("components/header.php");
?>

<div class="main" style="background-color: 	#F5F5F5;">

    <div class="container mt-5">
        <h1>Create Invoice</h1>

        <form id="invoice-form">
            <div class="row">
            <div class="mb-3 col-2">
                    <label for="invoice-number" class="form-label">Invoice Number</label>
                    <input type="text" class="form-control" id="invoice-number" value="0624001" readonly>
                </div>
                <div class="mb-3 col-2">
                    <label for="customer-name" class="form-label">Customer Name</label>
                    <select class="form-select" id="customer-name">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/tabulator-tables@5.3.2/dist/js/tabulator.min.js"></script>
    <script>
        var table;
        var productValues = {}; 
        var products = [];

        document.addEventListener("DOMContentLoaded", function() {
            initializeDateFields();
            fetchProducts();
            fetchCustomers();
            generateInvoiceNumber();

            $("#invoice-form").submit(function(event) {
                event.preventDefault();
                createInvoice();
            });

            document.getElementById("add-row").addEventListener("click", function(event) {
                event.preventDefault();
                table.addRow({});
            });
        });

        function initializeDateFields() {
            var today = new Date();
            document.getElementById('invoice-date').value = formatDate(today);
            document.getElementById('due-date').value = formatDate(addDays(today, 5));
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

        function fetchProducts() {
            $.ajax({
                url: 'php/get-product.php',
                method: 'GET',
                success: function(data) {
                    products = JSON.parse(data);
                    var uniqueProducts = [];
                    var productIds = new Set();

                    products.forEach(function(product) {
                        if (!productIds.has(product.product_id)) {
                            productIds.add(product.product_id);
                            uniqueProducts.push(product);
                            productValues[product.product_id] = product.name;
                        }
                    });

                    initializeTabulator(productValues, uniqueProducts);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products:', error);
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
                                });
                                fetchProductDetails(selectedProduct.product_id, cell.getRow());
                            } else {
                                console.error('Product not found');
                            }
                        }
                    },
                    { title: "Qty", field: "qty", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
                    { title: "Rate", field: "rate", editor: "input", cellEdited: function(cell) { updateRowAmounts(cell.getRow()); } },
                    { title: "Taxable", field: "taxable", bottomCalc: "sum" },
                    { title: "Cgst (%)", field: "cgst_percent" },
                    { title: "Cgst Amount", field: "cgst_amount", bottomCalc: "sum" },
                    { title: "Sgst (%)", field: "sgst_percent" },
                    { title: "Sgst Amount", field: "sgst_amount", bottomCalc: "sum" },
                    { title: "Igst (%)", field: "igst_percent" },
                    { title: "Igst Amount", field: "igst_amount", bottomCalc: "sum" },
                    { title: "Total", field: "total", bottomCalc: "sum" },
                    {
                        title: "Actions",
                        formatter: function(cell) {
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

        function fetchProductDetails(product_id, row) {
            $.ajax({
                url: 'php/get-product-details.php',
                method: 'GET',
                data: { product_id: product_id },
                success: function(data) {
                    var product = JSON.parse(data);
                    row.update({
                        rate: product.price,
                        cgst_percent: product.cgst,
                        sgst_percent: product.sgst,
                        igst_percent: product.igst
                    });
                    updateRowAmounts(row);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product details:', error);
                }
            });
        }

        function updateRowAmounts(row) {
            var data = row.getData();
            var qty = parseFloat(data.qty) || 1;
            var rate = parseFloat(data.rate) || 0;
            var taxable = qty * rate;
            var cgst_percent = parseFloat(data.cgst_percent) || 0;
            var sgst_percent = parseFloat(data.sgst_percent) || 0;
            var igst_percent = parseFloat(data.igst_percent) || 0;
            var cgst_amount = (taxable * cgst_percent) / 100;
            var sgst_amount = (taxable * sgst_percent) / 100;
            var igst_amount = (taxable * igst_percent) / 100;
            var total = taxable + cgst_amount + sgst_amount + igst_amount;

            row.update({
                taxable: taxable.toFixed(2),
                cgst_amount: cgst_amount.toFixed(2),
                sgst_amount: sgst_amount.toFixed(2),
                igst_amount: igst_amount.toFixed(2),
                total: total.toFixed(2)
            });
        }

        function fetchCustomers() {
            $.ajax({
                url: 'php/get-customer.php',
                method: 'GET',
                success: function(data) {
                    var customers = JSON.parse(data);
                    var customerSelect = $('#customer-name');
                    customerSelect.empty().append('<option value="">Select a Customer</option>');
                    customers.forEach(function(customer) {
                        customerSelect.append('<option value="' + customer.id + '">' + customer.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching customers:', error);
                }
            });
        }

        $('#customer-name').change(function() {
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

        function generateInvoiceNumber() {
    $.ajax({
        url: 'php/get-latest-invoice-number.php',
        method: 'GET',
        async: false,
        success: function(data) {
            console.log("Generated new invoice number:", data);
            document.getElementById('invoice-number').value = data;
        },
        error: function(xhr, status, error) {
            console.error('Error generating invoice number:', error);
        }
    });
}

        function createInvoice() {
            var invoiceData = {
                invoice_number: $('#invoice-number').val(),
                customer_id: $('#customer-name').val(),
                customer_name: $('#customer-name option:selected').text(),
                address_line_1: $('#customer-address1').val(),
                address_line_2: $('#customer-address2').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                pincode: $('#pincode').val(),
                state_code: $('#state-code').val(),
                gst_number: $('#gst').val(),
                pan_number: $('#pan').val(),
                invoice_date: $('#invoice-date').val(),
                due_date: $('#due-date').val(),
                note: $('#note').val(),
                items: []
            };

            var tableData = table.getData();

            tableData.forEach(function(row) {
                invoiceData.items.push(row);
            });

            $.ajax({
                url: 'php/create-invoice.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(invoiceData),
                success: function(response) {
                    alert('Invoice created successfully!');
                    window.location.href = 'invoicelist.php';
                },
                error: function(xhr, status, error) {
                    console.error('Error creating invoice:', error);
                }
            });
        }
    </script>

</div>

<?php
include("components/footer.php");
?>