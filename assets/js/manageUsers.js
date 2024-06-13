// Add User
document.getElementById('addUserBtn').addEventListener('click', function () {
    document.getElementById('userForm').classList.toggle('d-none');
    this.classList.add('d-none');
});

//CloseBtn
document.getElementById('userFormModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('form').reset();

    form.classList.remove('was-validated');
    const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
    inputs.forEach(input => {
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');
    });
});

// Submit
document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    const form = event.target;
    let isValid = form.checkValidity();
    form.classList.add("was-validated");

    // Confirm password
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        document.getElementById('confirmPassword').setCustomValidity("Passwords do not match!");
        isValid = false;
    } else {
        document.getElementById('confirmPassword').setCustomValidity("");
    }

    if (!isValid) {
        return;
    }

    //Add data to the Table
    let username = document.getElementById('username').value;
    let fullname = document.getElementById('fullname').value;
    let email = document.getElementById('email').value;
    let mobile = document.getElementById('mobile').value;
    let role = document.getElementById('role').value;
    let permissions = Array.from(document.querySelectorAll('.form-check-input:checked')).map(checkbox => checkbox.id);

    let newRow = {
        srNo: table.getDataCount() + 1,
        username,
        fullname,
        email,
        mobile,
        role,
        permissions
    };

    table.addData([newRow]);
    bootstrap.Modal.getInstance(document.getElementById('userFormModal')).hide();
    form.reset();
    form.classList.remove('was-validated');

    // Role
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
    var checkboxes = document.querySelectorAll('.form-check-input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = (role === "admin");
    });
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

//Table
document.addEventListener("DOMContentLoaded", function () {
    table = new Tabulator("#user-table", {
        layout: "fitDataFill",
        maxHeight: "200px",
        maxWidth:"100%",
        responsiveLayout: "collapse",
        columns: [
            { title: "#", field: "srNo", sorter: "number", width: 70 },
            { title: "Username", field: "username", sorter: "string" },
            { title: "Fullname", field: "fullname", sorter: "string" },
            { title: "Email", field: "email", sorter: "string" },
            { title: "Mobile", field: "mobile", sorter: "string" },
            {
                title: "Actions",
                field: "actions",
                formatter: function (cell, formatterParams) {
                    let div = document.createElement("div");

                    // Edit Button
                    let editButton = document.createElement("button");
                    editButton.className = "btn btn-sm btn-primary me-2";
                    editButton.innerHTML = "Edit";
                    editButton.onclick = function () {
                        let rowData = cell.getRow().getData();
                        fillForm(rowData);
                    };
                    div.appendChild(editButton);

                    // Delete Button
                    let deleteButton = document.createElement("button");
                    deleteButton.className = "btn btn-sm btn-danger";
                    deleteButton.innerHTML = "Delete";
                    deleteButton.onclick = function () {
                        let rowData = cell.getRow().getData();
                        showDeleteConfirmation(rowData.id); // Pass row id to delete confirmation
                    };
                    div.appendChild(deleteButton);

                    return div;
                }
            }
        ]
    });
});

//Delete
function showDeleteConfirmation(rowId) {
    let modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    // Handle click on "Yes" button in modal
    document.getElementById('confirmDeleteButton').onclick = function () {
        // Perform deletion action here (for example, removing row from Tabulator)
        table.deleteRow(rowId); // Delete row using the row identifier

        // Close the modal
        modal.hide();
    };
}

//Edit
function fillForm(data) {
    // Update a variable to keep track of the row being edited
    editingRowId = data.srNo; // Assuming 'srNo' is a unique identifier for rows

    // Fill the form with data to edit
    document.getElementById('username').value = data.username;
    document.getElementById('fullname').value = data.fullname;
    document.getElementById('email').value = data.email;
    document.getElementById('mobile').value = data.mobile;
    document.getElementById('role').value = data.role;

    // Set permissions if needed
    let checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach(checkbox => checkbox.checked = data.permissions.includes(checkbox.id));

    // Show modal
    new bootstrap.Modal(document.getElementById('userFormModal')).show();
}