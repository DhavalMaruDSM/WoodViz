//Add User
document.getElementById('addUserBtn').addEventListener('click', function () {
    document.getElementById('userForm').classList.toggle('d-none');
    this.classList.add('d-none');
});

//Submit
document.getElementById("form").addEventListener("submit", function (event) {
    if (this.checkValidity() === false) {
        event.preventDefault();
    }
    this.classList.add("was-validated");

    //Password
    var password = document.getElementById('password').value;
    if (password.length < 8 || password.length > 15) {
        document.getElementById('password').classList.add("is-invalid");
        document.getElementById('password').nextElementSibling.textContent = "Password must be between 8 and 15 characters long!";
        event.preventDefault();
    }

    //Confrim Password
    var confirmPassword = document.getElementById('confirmPassword').value;
    if (password !== confirmPassword) {
        document.getElementById('confirmPassword').classList.add("is-invalid");
        document.getElementById('confirmPassword').nextElementSibling.textContent = "Passwords do not match!";
        event.preventDefault();
    }

    //Role
    var role = document.getElementById('role').value;
    if (!role) {
        document.getElementById('role').classList.add("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "Please select a Role!";
        event.preventDefault();
    } else {
        document.getElementById('role').classList.remove("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "";
    }

}, false);

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



