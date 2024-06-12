<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/manageUsers.css">
</head>

<body>

    <div class="main-content">
        <div class="container d-flex align-items-center justify-content-center flex-column">
            <button class="btn btn-warning mb-3 mt-5" id="addUserBtn">Add User</button>
            <div class="user-card col-md-8 col-lg-6 mt-3 d-none" id="userForm">
                <form id="form" class="needs-validation" novalidate>

                    <!--1st Row-->
                    <div class="row">
                        <!--Username-->
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter the Username" required>
                            <div class="invalid-feedback">Please enter a Username!</div>
                        </div>
                        <!--Fullname-->
                        <div class="mb-3 col-md-6">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Enter the Fullname" required>
                            <div class="invalid-feedback">Please enter your Fullname!</div>
                        </div>
                    </div>

                    <!--2nd Row-->
                    <div class="row">
                        <!--Email-->
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter the Email" required>
                            <div class="invalid-feedback">Please enter a valid Email address!</div>
                        </div>
                        <!--Mobile-->
                        <div class="mb-3 col-md-6">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="tel" pattern="[0-9]{10}" class="form-control" id="mobile" placeholder="Enter the Mobile" required>
                            <div class="invalid-feedback">Please enter a 10-digit Mobile number!</div>
                        </div>
                    </div>

                    <!--3rd Row-->
                    <div class="row">
                        <!--Password-->
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter the Password" pattern=".{8,15}" required>
                            <div class="invalid-feedback">Password must be between 8 and 15 characters long!</div>
                        </div>
                        <!--Confirm Password-->
                        <div class="mb-3 col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                            <div class="invalid-feedback">Please Confirm your password!</div>
                        </div>
                    </div>

                    <!--4th Row-->
                    <div class="row">
                        <!--Role-->
                        <div class="mb-3 col-md-6">
                            <label for="role" class="form-label">Role</label>
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
                        <div class="mb-3 col-md-6">
                            <label for="permissions" class="form-label">Permissions</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="admin">
                                <label class="form-check-label" for="admin">Admin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="limited">
                                <label class="form-check-label" for="limited">Limited</label>
                            </div>
                        </div>
                    </div>


                    <!--Submit-->
                    <button type="submit" class="btn btn-primary mt-3 w-100" id="createAccountBtn">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/manageUsers.js"></script>
</body>

</html>