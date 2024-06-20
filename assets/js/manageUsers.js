document.addEventListener("DOMContentLoaded", function () {
    // Sample data for demonstration (replace this with your actual data)
    const tableData = [
       
    ];

    // Initialize Tabulator table
    const table = new Tabulator("#user-table", {
        data: tableData,
        layout: "fitDataFill",
        pagination: "local",
        paginationSize: 10,
        maxWidth: "100%",
        responsiveLayout: true,
        columns: [
            { title: "#", field: "srNo", sorter: "number", headerHozAlign: "center", width: 50 },
            { title: "Username", field: "username", sorter: "string", headerHozAlign: "center", width: 200 },
            { title: "Fullname", field: "fullname", sorter: "string", headerHozAlign: "center", width: 250 },
            { title: "Email", field: "email", sorter: "string", headerHozAlign: "center", width: 330 },
            { title: "Mobile", field: "mobile", sorter: "string", headerHozAlign: "center", width: 180 },
            {
                title: "Action",
                field: "action",
                width: 200,
                headerHozAlign: "center",
                formatter: function (cell, formatterParams) {
                    return `
                        <button class="btn btn-sm btn-primary edit-button"><i class='bi bi-pencil-fill'></i> Edit</button>
                        <button class="btn btn-sm btn-danger delete-button"><i class='bi bi-trash-fill'></i> Delete</button>
                    `;
                },
                cellClick: function (e, cell) {
                    var data = cell.getRow().getData();
                    if (e.target.closest('.edit-button')) {
                        document.getElementById('editUsername').value = data.username;
                        document.getElementById('editFullname').value = data.fullname;
                        document.getElementById('editEmail').value = data.email;
                        document.getElementById('editMobile').value = data.mobile;
                        document.getElementById('editRole').value = data.role;

                        let permissions = data.permissions || [];
                        let checkboxes = document.querySelectorAll('.form-check-input');
                        checkboxes.forEach(checkbox => checkbox.checked = permissions.includes(checkbox.id));

                        var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                        editModal.show();
                    } else if (e.target.closest('.delete-button')) {
                        document.getElementById('confirmDeleteButton').dataset.rowId = data.srNo;

                        var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                        deleteModal.show();
                    }
                }
            }
        ]
    });

    // Add User Button Click
    document.getElementById('addUserBtn').addEventListener('click', function () {
        document.getElementById('userForm').classList.toggle('d-none');
        this.classList.add('d-none');
    });

    // Close Modal Event
    document.getElementById('userFormModal').addEventListener('hidden.bs.modal', function () {
        const form = document.getElementById('form');
        form.reset();
        form.classList.remove('was-validated');

        const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
        inputs.forEach(input => {
            input.classList.remove('is-valid');
            input.classList.remove('is-invalid');
        });
    });

    // Form Submit Event
    document.getElementById("form").addEventListener("submit", function (event) {
        event.preventDefault();
        const form = event.target;
        let isValid = form.checkValidity();
        form.classList.add("was-validated");

        // Validate password confirmation
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

        // Add data to the Table
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

        // Role validation
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

    // Form Validation
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

    // Search functionality
    document.getElementById('usersearchBtn').addEventListener('click', function () {
        const searchField = document.getElementById('searchDropdown').value;
        const searchValue = document.getElementById('searchInput').value.toLowerCase();

        table.setFilter(function(data) {
            return data[searchField].toLowerCase().includes(searchValue);
        });
    });

    // Confirm Delete Button Event
    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        var rowId = this.dataset.rowId;
        var row = table.getRow(rowId);
        row.delete();

        var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal'));
        deleteModal.hide();
    });

    // Edit Button Event
    document.getElementById('user-table').addEventListener('click', function (e) {
        if (e.target.closest('.edit-button')) {
            var cell = table.getCellFromEvent(e);
            var data = cell.getRow().getData();

            document.getElementById('editUsername').value = data.username;
            document.getElementById('editFullname').value = data.fullname;
            document.getElementById('editEmail').value = data.email;
            document.getElementById('editMobile').value = data.mobile;
            document.getElementById('editRole').value = data.role;

            let permissions = data.permissions || [];
            let checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => checkbox.checked = permissions.includes(checkbox.id));

            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
        }
    });
});
