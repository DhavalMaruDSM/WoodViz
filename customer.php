<?php
include("components/header.php");
?>
<div class="main" style="background-color: 	#F5F5F5;">

    <!-- ---------------------------------- -->
    <div class="container mt-4">
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
                    </div>
                </div>
                <button type="button" class="btn btn-warning col ms-3 me-3" data-bs-toggle="modal" data-bs-target="#addAccountModal">+ Add Account</button>
            </div>

            <!-- Add Account Modal -->
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="removeaddValidationErrors()"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createCustomerForm" >
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="accountName" class="form-label">Account Name:</label>
                                        <input type="text" class="form-control" id="accountName" name="accountName" >
                                        <span id="accountNameError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine1" class="form-label">Address line 1:</label>
                                        <input type="text" class="form-control" id="addressLine1" name="addressLine1" >
                                        <span id="addressLine1Error" class="text-danger"></span>
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" >
                                        <span id="mobileError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="ifsc" class="form-label">IFSC:</label>
                                        <input type="text" class="form-control" id="ifsc" name="ifsc" >
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="addressLine2" class="form-label">Address line 2:</label>
                                        <input type="text" class="form-control" id="addressLine2" name="addressLine2">
                                        <span id="addressLine2Error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" >
                                        <span id="emailError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="city" name="city" >
                                        <span id="cityError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="state" class="form-label">State:</label>
                                        <input type="text" class="form-control" id="state" name="state" >
                                        <span id="stateError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="pincode" class="form-label">Pincode:</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" >
                                        <span id="pincodeError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="gst" class="form-label">GST:</label>
                                        <input type="text" class="form-control" id="gst" name="gst" >
                                        <span id="gstError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="pan" class="form-label">PAN:</label>
                                        <input type="text" class="form-control" id="pan" name="pan" >
                                        <span id="panError" class="text-danger"></span>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label for="bankAccount" class="form-label">Bank Account:</label>
                                        <input type="text" class="form-control" id="bankAccount" name="bankAccount" >
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="mobile" class="form-label">Balance:</label>
                                        <input type="number" class="form-control" id="balance" name="balance" >
                                    </div>

                                </div>

                            </form>

                            <!-- form ends here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeaddValidationErrors()">Close</button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="removeValidationErrors()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCustomerForm">
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="editAccountName" class="form-label">Account Name:</label>
                                    <input type="text" class="form-control" id="editAccountName" name="editAccountName" >
                                    <span id="editAccountNameError" class="text-danger"></span>
                                    
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="editAddressLine1" class="form-label">Address line 1:</label>
                                    <input type="text" class="form-control" id="editAddressLine1" name="editAddressLine1" >
                                    <span id="editAddressLine1Error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-2">
                                    <label for="mobile" class="form-label">Mobile:</label>
                                    <input type="text" class="form-control" id="editMobile" name="editMobile" >
                                    <span id="editMobileError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="ifsc" class="form-label">IFSC:</label>
                                    <input type="text" class="form-control" id="editIfsc" name="editIfsc" >
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="addressLine2" class="form-label">Address line 2:</label>
                                    <input type="text" class="form-control" id="editAddressLine2" name="editAddressLine2">
                                    <span id="editAddressLine2Error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="editEmail" name="editEmail" >
                                    <span id="editEmailError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 col-3">
                                    <label for="city" class="form-label">City:</label>
                                    <input type="text" class="form-control" id="editCity" name="editCity" >
                                    <span id="editCityError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 col-3">
                                    <label for="state" class="form-label">State:</label>
                                    <input type="text" class="form-control" id="editState" name="editState" >
                                    <span id="editStateError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 col">
                                    <label for="pincode" class="form-label">Pincode:</label>
                                    <input type="text" class="form-control" id="editPincode" name="editPincode" >
                                    <span id="editPincodeError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="gst" class="form-label">GST:</label>
                                    <input type="text" class="form-control" id="editGst" name="editGst" >
                                    <span id="editGstError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 col-3">
                                    <label for="pan" class="form-label">PAN:</label>
                                    <input type="text" class="form-control" id="editPan" name="editPan" >
                                    <span id="editPanError" class="text-danger"></span>
                                </div>

                                <div class="mb-3 col-3">
                                    <label for="bankAccount" class="form-label">Bank Account:</label>
                                    <input type="text" class="form-control" id="editBankAccount" name="editBankAccount" >
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="mobile" class="form-label">Balance:</label>
                                    <input type="number" class="form-control" id="editbalance" name="editbalance" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeValidationErrors()">Close</button>
                        <button type="button" class="btn btn-warning" id="saveEditCustomer" onclick="editAccount()">Save changes</button>
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
                        <button type="button" class="btn btn-danger" id="confirmDeleteCustomer">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerModalLabel">Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ms-2 me-2">
                        <form id="customerform">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div id="customerdata-table"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/customer.js"></script>
<?php
include("components/footer.php");
?>