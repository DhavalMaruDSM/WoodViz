<?php
include "components/header.php";
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </link>
    <link rel="stylesheet" href="assets/css/tabulator_bootstrap5.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <div class="main-content">
        <div class="container">
            <div class="row mb-3 align-items-center">
                <div id="user-searchbar" class="col-md-12 d-flex align-items-center p-3">
                    <div class="input-group search-input flex-grow-1">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search"></i>
                        </span>
                        <select class="form-select" id="searchDropdown" required>
                            <option value="username">Username</option>
                            <option value="fullname">Fullname</option>
                            <option value="email">Email</option>
                            <option value="mobile">Mobile</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="usersearchBtn">
                    </div>
                    <button class="btn btn-success search-button" type="submit" id="usersearchBtn">Search</button>
                    <button class="btn ms-2" id="addUserBtn" data-bs-toggle="modal" data-bs-target="#userFormModal">
                        <i class="bi bi-plus-circle-fill"></i> ADD USER
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="user-table-container" class="p-3">
                        <div id="user-table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--User Form Modal-->
    <div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userFormModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="form" class="needs-validation" novalidate>
                        <!--1st Row-->
                        <div class="row">
                            <!--Username-->
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter the Username" required>
                                <div class="invalid-feedback">Please enter a Username!</div>
                            </div>
                            <!--Fullname-->
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">Fullname:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter the Fullname" required>
                                <div class="invalid-feedback">Please enter your Fullname!</div>
                            </div>
                        </div>

                        <!--2nd Row-->
                        <div class="row">
                            <!--Email-->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter the Email" required>
                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                            </div>
                            <!--Mobile-->
                            <div class="mb-3 col-md-6">
                                <label for="mobile" class="form-label">Mobile:</label>
                                <input type="tel" pattern="[0-9]{10}" class="form-control" id="mobile" name="mobile" placeholder="Enter the Mobile" required>
                                <div class="invalid-feedback">Please enter a 10-digit Mobile number!</div>
                            </div>
                        </div>

                        <!--3rd Row-->
                        <div class="row">
                            <!--Password-->
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter the Password" pattern=".{8,15}" required>
                                <div class="invalid-feedback">Password must be between 8 and 15 characters long!</div>
                            </div>
                            <!--Confirm Password-->
                            <div class="mb-3 col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                                <div class="invalid-feedback">Please Confirm your password!</div>
                            </div>
                        </div>

                        <!--4th Row-->
                        <div class="row">
                            <!--Role-->
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Role:</label>
                                <select class="form-select" id="role" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="admin">Admin</option>
                                    <option value="limited">Limited</option>
                                </select>
                                <div class="invalid-feedback">Please select a Role!</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Permission -->
                            <div class="mb-3 col-md-12">
                                <label for="permissions" class="form-label">Permissions:</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="admin">
                                        <label class="form-check-label" for="admin">Admin</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="product">
                                        <label class="form-check-label" for="product">Product</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="purchase">
                                        <label class="form-check-label" for="purchase">Purchase</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="production">
                                        <label class="form-check-label" for="production">Production</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="billing">
                                        <label class="form-check-label" for="billing">Billing</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="customer">
                                        <label class="form-check-label" for="customer">Customer</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="report">
                                        <label class="form-check-label" for="report">Report</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <!--Submit-->
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="createAccountBtn">Create Account</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Edit Modal-->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="editForm">
                        <!--1st Row-->
                        <div class="row">
                            <!--Username-->
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="editUsername" name="username" placeholder="Enter the Username" required>
                                <div class="invalid-feedback">Please enter a Username!</div>
                            </div>
                            <!--Fullname-->
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">Fullname:</label>
                                <input type="text" class="form-control" id="editFullname" name="fullname" placeholder="Enter the Fullname" required>
                                <div class="invalid-feedback">Please enter your Fullname!</div>
                            </div>
                        </div>

                        <!--2nd Row-->
                        <div class="row">
                            <!--Email-->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="editEmail" name="email" placeholder="Enter the Email" required>
                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                            </div>
                            <!--Mobile-->
                            <div class="mb-3 col-md-6">
                                <label for="mobile" class="form-label">Mobile:</label>
                                <input type="tel" pattern="[0-9]{10}" class="form-control" id="editMobile" name="mobile" placeholder="Enter the Mobile" required autocomplete="new-mobile">
                                <div class="invalid-feedback">Please enter a 10-digit Mobile number!</div>
                            </div>
                        </div>

                        <!--3rd Row-->
                        <div class="row">
                            <!--Password-->
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="editPassword" name="password" placeholder="Enter the Password" pattern=".{8,15}" required autocomplete="new-password">
                                <div class="invalid-feedback">Password must be between 8 and 15 characters long!</div>
                            </div>
                            <!--Confirm Password-->
                            <div class="mb-3 col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="editConfirmPassword" name="confirmPassword" placeholder="Confirm Password" required required autocomplete="new-confirmPassword">
                                <div class="invalid-feedback">Please Confirm your password!</div>
                            </div>
                        </div>

                        <!--4th Row-->
                        <div class="row">
                            <!--Role-->
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Role:</label>
                                <select class="form-select" id="editRole" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="admin">Admin</option>
                                    <option value="limited">Limited</option>
                                </select>
                                <div class="invalid-feedback">Please select a Role!</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Permission -->
                            <div class="mb-3 col-md-12">
                                <label for="editPermissions" class="form-label">Permissions:</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editAdmin">
                                        <label class="form-check-label" for="admin">Admin</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editProduct">
                                        <label class="form-check-label" for="product">Product</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editPurchase">
                                        <label class="form-check-label" for="purchase">Purchase</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editProduction">
                                        <label class="form-check-label" for="production">Production</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editBilling">
                                        <label class="form-check-label" for="billing">Billing</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editCustomer">
                                        <label class="form-check-label" for="customer">Customer</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" value="" id="editReport">
                                        <label class="form-check-label" for="report">Report</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="editAccountBtn">Edit Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/tabulator.min.js"></script>
    <script src="assets/js/manageUsers.js"></script>

    <?php
    include("components/footer.php");
    ?>
</body>