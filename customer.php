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
                <input type="text" id="search-input" class="form-control w-50" placeholder="Search...">
                <button class="btn btn-outline-warning" type="button" id="search-button">Search</button>
            </div></div>    
            <button type="button" class="btn btn-warning col ms-3 me-3" data-bs-toggle="modal" data-bs-target="#addAccountModal">+ Add Account</button>
        </div>
        
                    <!-- Modal -->  
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="accountName" class="form-label">Account Name:</label>
                                        <input type="text" class="form-control" id="accountName" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine1" class="form-label">Address line 1:</label>
                                        <input type="text" class="form-control" id="addressLine1" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="text" class="form-control" id="mobile" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine2" class="form-label">Address line 2:</label>
                                        <input type="text" class="form-control" id="addressLine2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="city" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="state" class="form-label">State:</label>
                                        <input type="text" class="form-control" id="state" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="pincode" class="form-label">Pincode:</label>
                                        <input type="text" class="form-control" id="pincode" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="gst" class="form-label">GST:</label>
                                        <input type="text" class="form-control" id="gst" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="pan" class="form-label">PAN:</label>
                                        <input type="text" class="form-control" id="pan" required>
                                    </div>
                                
                                    <div class="mb-3 col-3">
                                        <label for="bankAccount" class="form-label">Bank Account:</label>
                                        <input type="text" class="form-control" id="bankAccount" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="ifsc" class="form-label">IFSC:</label>
                                        <input type="text" class="form-control" id="ifsc" required>
                                    </div>
                                </div>
                        
                            </form>
                
                            <!-- form ends here -->
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning">Create Account</button>
            
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
                            <input type="text" class="form-control" id="editAccountName" required>
                        </div>
                        <div class="mb-3 col-8">
                            <label for="editAddressLine1" class="form-label">Address line 1:</label>
                            <input type="text" class="form-control" id="editAddressLine1" required>
                        </div>
                    </div>
                    <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="text" class="form-control" id="editMobile" required>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine2" class="form-label">Address line 2:</label>
                                        <input type="text" class="form-control" id="editAddressLine2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="editEmail" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="editCity" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="state" class="form-label">State:</label>
                                        <input type="text" class="form-control" id="editState" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="pincode" class="form-label">Pincode:</label>
                                        <input type="text" class="form-control" id="editPincode" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="gst" class="form-label">GST:</label>
                                        <input type="text" class="form-control" id="editGst" required>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="pan" class="form-label">PAN:</label>
                                        <input type="text" class="form-control" id="editPan" required>
                                    </div>
                                
                                    <div class="mb-3 col-3">
                                        <label for="bankAccount" class="form-label">Bank Account:</label>
                                        <input type="text" class="form-control" id="editBankAccount" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="ifsc" class="form-label">IFSC:</label>
                                        <input type="text" class="form-control" id="editIfsc" required>
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
    <script src="https://unpkg.com/tabulator-tables@5.3.2/dist/js/tabulator.min.js"></script>
    <script>
        const tableData = [
            { id: 1, name: "A", email: "a@mail.com", mobile: "9876543210", balance: 100 },
            { id: 2, name: "B", email: "b@mail.com", mobile: "7968543210", balance: -50 },
            { id: 3, name: "C", email: "c@mail.com", mobile: "7954832610", balance: 200 },
            { id: 4, name: "D", email: "d@mail.com", mobile: "9128076354", balance: -150 },
            { id: 5, name: "E", email: "e@mail.com", mobile: "9238476510", balance: 300 },
        ];

        const table = new Tabulator("#customer-table", {
            data: tableData,
            layout: "fitColumns",
            columns: [
                { title: "#", field: "id", width: 50 },
                { title: "Full Name", field: "name"},
                { title: "Email", field: "email"},
                { title: "Mobile", field: "mobile"},
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
                        } else if (e.target.classList.contains('delete-button')) {
                            var data = cell.getRow().getData();
        var customerId = data.id;

        if (confirm('Are you sure you want to delete this customer?')) {
            table.deleteRow(customerId);
        }
                        }
                    }
                }
            ]
        });

        

        document.getElementById('search-button').addEventListener('click', function () {
            const query = document.getElementById('search-input').value;
            table.setFilter([[
                { field: "name", type: "like", value: query },
                { field: "email", type: "like", value: query },
                { field: "mobile", type: "like", value: query },
                { field: "balance", type: "like", value: query },
            ]]);
        });


        

document.getElementById('saveEditCustomer').addEventListener('click', function() {
    var updatedData = {
        id: currentCustomerId, 
        name: document.getElementById('editAccountName').value,
        addressLine1: document.getElementById('editAddressLine1').value,
    };


    var myModal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
    myModal.hide();

});

        </script>
</div>
                
<?php
include("components/footer.php");
?>