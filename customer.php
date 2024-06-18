<?php
include("components/header.php");
?>
<div class="main" style="background-color: 	#F5F5F5;">

<!-- ---------------------------------- -->
<div class="container mt-4">
<link href="https://unpkg.com/tabulator-tables@5.3.2/dist/css/tabulator.min.css" rel="stylesheet">
    <style>
        .tabulator .tabulator-cell .balance-positive {
            color: green;
        }

        .tabulator .tabulator-cell .balance-negative {
            color: red;
        }
        
    </style>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer</li>
            </ol>
        </nav>
        <div class="container">
        <h3 class="mt-4">Customer</h3>
        <div class="row ">
            <div class="col-10 ">
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search "></i></span>
            <select class="form-select" id="search-field">
                    <option value="name" selected>Name</option>
                    <option value="email">Email</option>
                    <option value="mobile">Mobile</option>
                    <option value="balance">Balance</option>
                </select>
                <input type="text" id="search-input" name="search-input" class="form-control w-50" placeholder="Search...">
                <button class="btn btn-outline-warning" type="button" id="search-button">Search</button>
            </div></div>    
            <button type="button" class="btn btn-warning col ms-3 me-3" data-bs-toggle="modal" data-bs-target="#addAccountModal">+ Add Account</button>
        </div>
        
                <!-- Add Account Modal -->  
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="createCustomerForm" action="php/create-customer.php" method="post">
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="accountName" class="form-label">Account Name:</label>
                                        <input type="text" class="form-control" id="accountName" name="accountName" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine1" class="form-label">Address line 1:</label>
                                        <input type="text" class="form-control" id="addressLine1" name="addressLine1" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="ifsc" class="form-label">IFSC:</label>
                                        <input type="text" class="form-control" id="ifsc" name="ifsc" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine2" class="form-label">Address line 2:</label>
                                        <input type="text" class="form-control" id="addressLine2" name="addressLine2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="state" class="form-label">State:</label>
                                        <input type="text" class="form-control" id="state" name="state" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="pincode" class="form-label">Pincode:</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="gst" class="form-label">GST:</label>
                                        <input type="text" class="form-control" id="gst" name="gst" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="pan" class="form-label">PAN:</label>
                                        <input type="text" class="form-control" id="pan" name="pan" required>
                                    </div>
                                
                                    <div class="mb-3 col-3">
                                        <label for="bankAccount" class="form-label">Bank Account:</label>
                                        <input type="text" class="form-control" id="bankAccount" name="bankAccount" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Balance:</label>
                                        <input type="text" class="form-control" id="balance" name="balance" required>
                                    </div>
                                    
                                </div>
                        
                            </form>
                
                            <!-- form ends here -->
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="addAccount()">Create Account</button>
            
                    </div>
                </div>
            </div>
        </div>
    <div id="customer-table" class="mt-3 me-1"></div>
    </div>
    <!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <div class="row">
                        <div class="mb-3 col-4">
                            <label for="editAccountName" class="form-label">Account Name:</label>
                            <input type="text" class="form-control" id="editAccountName" name="editAccountName" required>
                        </div>
                        <div class="mb-3 col-8">
                            <label for="editAddressLine1" class="form-label">Address line 1:</label>
                            <input type="text" class="form-control" id="editAddressLine1" name="editAddressLine1" required>
                        </div>
                    </div>
                    <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="text" class="form-control" id="editMobile" name="editMobile" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="ifsc" class="form-label">IFSC:</label>
                                        <input type="text" class="form-control" id="ifsc" name="ifsc" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine2" class="form-label">Address line 2:</label>
                                        <input type="text" class="form-control" id="editAddressLine2" name="editAddressLine2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="editCity" name="editCity" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="state" class="form-label">State:</label>
                                        <input type="text" class="form-control" id="editState" name="editState" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="pincode" class="form-label">Pincode:</label>
                                        <input type="text" class="form-control" id="editPincode" name="editPincode" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="gst" class="form-label">GST:</label>
                                        <input type="text" class="form-control" id="editGst" name="editGst" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="pan" class="form-label">PAN:</label>
                                        <input type="text" class="form-control" id="editPan" name="editPan" required>
                                    </div>
                                
                                    <div class="mb-3 col-3">
                                        <label for="bankAccount" class="form-label">Bank Account:</label>
                                        <input type="text" class="form-control" id="editBankAccount" name="editBankAccount" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Balance:</label>
                                        <input type="text" class="form-control" id="editbalance" name="editbalance" required>
                                    </div>
                                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="saveEditCustomer">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCustomerModalLabel">Delete Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="deleteCustomerText">Are you sure you want to delete this customer?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteCustomer" >Yes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/tabulator-tables@5.3.2/dist/js/tabulator.min.js"></script>
<script>
    
    function showData() {
        fetch('php/get-customer.php')
            .then(response => response.json())
            .then(data => {
                
                const table = new Tabulator("#customer-table", {
                    data: data,
                    layout: "fitColumns",
                    columns: [
                        { title: "#", field: "id", width: 50 },
                        { title: "Full Name", field: "name" },
                        { title: "Email", field: "email" },
                        { title: "Mobile", field: "mobile" },
                        {
                            title: "Balance",
                            field: "balance",
                            formatter: function (cell, formatterParams, onRendered) {
                                const value = cell.getValue();
                                const className = value < 0 ? 'balance-negative' : 'balance-positive';
                                return `<span class="${className}">${value}</span>`;
                            }
                        },
                        {
                            title: "Action",
                            formatter: function (cell, formatterParams, onRendered) {
                                return `
                                    <button class="btn btn-sm btn-primary edit-button">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-button">Delete</button>
                                `;
                            },
                            width: 150,
                            hozAlign: "center",
                            cellClick: function (e, cell) {
                                if (e.target.classList.contains('edit-button')) {
                                    var data = cell.getRow().getData();
                                    // Populate the modal with the customer's data
                                    document.getElementById('editAccountName').value = data.name;
                                    document.getElementById('editMobile').value = data.mobile; 
                                    document.getElementById('editEmail').value = data.email; 
                                    var myModal = new bootstrap.Modal(document.getElementById('editCustomerModal'));
                                    myModal.show();
                                }  else if (e.target.classList.contains('delete-button')) {
                                var data = cell.getRow().getData();
                                var currentCustomerId = data.id;
                                document.getElementById('deleteCustomerText').innerText = `Are you sure you want to delete customer ${data.name}?`;
                                var myModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'));
                                myModal.show();

                                document.getElementById('confirmDeleteCustomer').addEventListener('click', function confirmDeleteHandler() {
                                    if (currentCustomerId !== null) {
                                        fetch('php/delete-customer.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({ id: currentCustomerId })
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            if (result.success) {
                                                table.deleteRow(currentCustomerId);
                                                var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteCustomerModal'));
                                                deleteModal.hide();
                                                currentCustomerId = null;
                                            } else {
                                                console.error('Error deleting customer:', result.message);
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    }
                                    document.getElementById('confirmDeleteCustomer').removeEventListener('click', confirmDeleteHandler); // Remove the handler to avoid multiple bindings
                                });
                            }
                        }
                    }
                ]
            });
                // Add event listener for search button
                document.getElementById('search-button').addEventListener('click', function () {
                    const query = document.getElementById('search-input').value;
                    table.setFilter([
                        { field: "name", type: "like", value: query },
                        { field: "email", type: "like", value: query },
                        { field: "mobile", type: "like", value: query },
                        { field: "balance", type: "like", value: query },
                    ]);
                });

                // Add event listener for save edit customer button
                document.getElementById('saveEditCustomer').addEventListener('click', function() {
                    var updatedData = {
                        id: currentCustomerId, 
                        name: document.getElementById('editAccountName').value,
                        addressLine1: document.getElementById('editAddressLine1').value,
                       
                    };

                   
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
                    myModal.hide();
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        showData();
    });


    //add account
    function addAccount() {
    var account_name = $('#accountName').val();
    var address_line1 = $('#addressLine1').val();
    var address_line2 = $('#addressLine2').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var balance = $('#balance').val();
    var pincode = $('#pincode').val();
    var gst = $('#gst').val();
    var pan = $('#pan').val();
    var bank_account = $('#bankAccount').val();
    var ifsc = $('#ifsc').val();

    $.ajax({
        url: "php/create-customer.php",
        type: "POST",
        data: {
            account_name: account_name,
            address_line1: address_line1,
            address_line2: address_line2,
            mobile: mobile,
            email: email,
            city: city,
            state: state,
            pincode: pincode,
            gst: gst,
            pan: pan,
            balance:balance,
            bank_account: bank_account,
            ifsc: ifsc
        },
        success: function(response) {
            
            if (response.includes("Account created successfully")) {
                
                alert("Account created successfully!");

                $('#createCustomerForm')[0].reset();
                showData();
                
                var addAccountModal = bootstrap.Modal.getInstance(document.getElementById('addAccountModal'));
                addAccountModal.hide();
            } else {
                console.error("Failed to create account:", response);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
}



</script>
</div>
                
<?php
include("components/footer.php");
?>