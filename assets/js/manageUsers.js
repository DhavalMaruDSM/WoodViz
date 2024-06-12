// Add User
document.getElementById('addUserBtn').addEventListener('click', function () {
    document.getElementById('userForm').classList.toggle('d-none');
    this.classList.add('d-none');
});


// Submit
document.getElementById("form").addEventListener("submit", function (event) {
    if (this.checkValidity() === false) {
        event.preventDefault();
    }
    this.classList.add("was-validated");

    // Password
    var password = document.getElementById('password').value;
    if (password.length < 8 || password.length > 15) {
        document.getElementById('password').classList.add("is-invalid");
        document.getElementById('password').nextElementSibling.textContent = "Password must be between 8 and 15 characters long!";
        event.preventDefault();
    }

    // Confirm Password
    var confirmPassword = document.getElementById('confirmPassword').value;
    if (password !== confirmPassword) {
        document.getElementById('confirmPassword').classList.add("is-invalid");
        document.getElementById('confirmPassword').nextElementSibling.textContent = "Passwords do not match!";
        event.preventDefault();
    }

    // Role
    var role = document.getElementById('role').value;
    if (!role) {
        document.getElementById('role').classList.add("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "Please select a Role!";
        event.preventDefault();
    } else {
        document.getElementById('role').classList.remove("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "";
    }
});

// Permissions
document.getElementById('role').addEventListener('change', function () {
    var role = this.value;
    var admin = document.getElementById('admin');
    var product = document.getElementById('product');
    var purchase = document.getElementById('purchase');
    var production = document.getElementById('production');
    var billing = document.getElementById('billing');
    var customer = document.getElementById('customer');
    var report = document.getElementById('report');

    if (role === "admin") {
        admin.checked = true;
        product.checked = true;
        purchase.checked = true;
        production.checked = true;
        billing.checked = true;
        customer.checked = true;
        report.checked = true;
    } else if (role === "limited") {
        admin.checked = false;
        product.checked = false;
        purchase.checked = false;
        production.checked = false;
        billing.checked = false;
        customer.checked = false;
        report.checked = false;
    }
});

//Form Validation
document.querySelectorAll(".form-control").forEach(function (input) {
    input.addEventListener("input", function () {
        if (this.checkValidity()) {
            this.classList.remove("is-invalid");
            this.nextElementSibling.textContent = "";
        } else {
            this.classList.add("is-invalid");
            this.nextElementSibling.textContent = this.validationMessage;
        }
    });
});
