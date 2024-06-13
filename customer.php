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

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-master-tab" data-bs-toggle="tab" data-bs-target="#user-master" type="button" role="tab" aria-controls="user-master" aria-selected="true">User Master</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="account-master-tab" data-bs-toggle="tab" data-bs-target="#account-master" type="button" role="tab" aria-controls="account-master" aria-selected="false">Account Master</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="user-master" role="tabpanel" aria-labelledby="user-master-tab">
                <h3 class="mt-4">User Master</h3>
                <p>Content of user master ....</p>
            </div>
            <div class="tab-pane fade" id="account-master" role="tabpanel" aria-labelledby="account-master-tab">
                <h3 class="mt-4">Account Master</h3>
                <button type="button" class="btn btn-warning float-end mb-3" data-bs-toggle="modal" data-bs-target="#addAccountModal">+ Add Account</button>
                <!-- Modal -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form begins here -->
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
</div>
                
<?php
include("components/footer.php");
?>