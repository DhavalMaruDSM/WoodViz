var currentCustomerId = null;
var table; 

function removeExistingToasts() {
    const existingToasts = document.querySelectorAll('.toast');
    existingToasts.forEach(toast => toast.remove());
}

function showData() {
    fetch('php/get-customer.php')
        .then(response => response.json())
        .then(data => {
            table = new Tabulator("#customer-table", {
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
                            const container = document.createElement('div');
                            
                            const editButton = document.createElement('button');
                            editButton.className = 'btn btn-sm btn-primary edit-button';
                            editButton.textContent = 'Edit';
                            editButton.addEventListener('click', function () {
                                var data = cell.getRow().getData();
                                currentCustomerId = data.id;
                                editCustomer(currentCustomerId);
                            });

                            const deleteButton = document.createElement('button');
                            deleteButton.className = 'btn btn-sm btn-danger delete-button';
                            deleteButton.textContent = 'Delete';
                            deleteButton.addEventListener('click', function () {
                                var data = cell.getRow().getData();
                                currentCustomerId = data.id;
                                deleteCustomer(currentCustomerId, data.name);
                            });

                            container.appendChild(editButton);
                            container.appendChild(deleteButton);
                            return container;
                        },
                        width: 150,
                        hozAlign: "center"
                    }
                ]
            });

            // Add event listener for search button
            document.getElementById('search-button').addEventListener('click', function () {
                const query = document.getElementById('search-input').value;
                const field = document.getElementById('search-field').value;
                table.setFilter([
                    { field: field, type: "like", value: query },
                ]);
            });

                document.getElementById('saveEditCustomer').addEventListener('click', function() {
                hideEditModal();
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}


function editCustomer(id) {
    $.post("php/edit-customer.php", { id: id }, function(data, status) {
        var customer = JSON.parse(data);
        populateEditModal(customer);
        showEditModal();
    });
}

//  delete customer
function deleteCustomer(id, name) {
    document.getElementById('deleteCustomerText').innerText = `Are you sure you want to delete customer ${name}?`;
    showDeleteModal();

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
                    removeExistingToasts(); 
                    callToast('success', 'Customer deleted successfully!');
                    hideDeleteModal();
                    currentCustomerId = null;
                } else {
                    removeExistingToasts(); 
                    callToast('danger', 'Failed to delete customer: ' + result.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
        document.getElementById('confirmDeleteCustomer').removeEventListener('click', confirmDeleteHandler);
    });
}

// populate edit modal with customer data
function populateEditModal(customer) {
    $('#editAccountName').val(customer.name);
    $('#editMobile').val(customer.phone);
    $('#editAddressLine1').val(customer.address_line_1);
    $('#editAddressLine2').val(customer.address_line_2);
    $('#editIfsc').val(customer.ifsc);
    $('#editCity').val(customer.city);
    $('#editState').val(customer.state);
    $('#editbalance').val(customer.balance);
    $('#editGst').val(customer.gst);
    $('#editEmail').val(customer.email);
    $('#editPan').val(customer.pan);
    $('#editPincode').val(customer.pincode);
    $('#editBankAccount').val(customer.bank_account);
}


function showEditModal() {
    var myModal = new bootstrap.Modal(document.getElementById('editCustomerModal'));
    myModal.show();
}


function hideEditModal() {
    var myModal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
    myModal.hide();
}


function showDeleteModal() {
    var myModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'));
    myModal.show();
}


function hideDeleteModal() {
    var myModal = bootstrap.Modal.getInstance(document.getElementById('deleteCustomerModal'));
    myModal.hide();
}


function hideAddAccountModal() {
    var myModal = bootstrap.Modal.getInstance(document.getElementById('addAccountModal'));
    myModal.hide();
}



// Function edit account
function editAccount() {
    var id = currentCustomerId; 
    var name = $('#editAccountName').val();
    var addressLine1 = $('#editAddressLine1').val();
    var addressLine2 = $('#editAddressLine2').val();
    var city = $('#editCity').val();
    var state = $('#editState').val();
    var pincode = $('#editPincode').val();
    var mobile = $('#editMobile').val();
    var ifsc = $('#editIfsc').val();
    var email = $('#editEmail').val();
    var gst = $('#editGst').val();
    var pan = $('#editPan').val();
    var bankAccount = $('#editBankAccount').val();
    var balance = $('#editbalance').val(); 

    $.ajax({
        url: "php/edit-customer.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            addressLine1: addressLine1,
            addressLine2: addressLine2,
            city: city,
            state: state,
            pincode: pincode,
            mobile: mobile,
            ifsc: ifsc,
            email: email,
            gst: gst,
            pan: pan,
            bankAccount: bankAccount,
            balance: balance
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.success) {
                removeExistingToasts(); 
                callToast('success', 'Customer updated successfully!');
                hideEditModal();
                showData();
            } else {
                removeExistingToasts(); 
                callToast('danger', 'Failed to update customer: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            callToast('danger', 'Failed to update customer due to a server error.');
        }
    });
}

// Function to add account
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
            balance: balance,
            bank_account: bank_account,
            ifsc: ifsc
        },
        success: function(response) {
            if (response.includes("Account created successfully")) {
                hideAddAccountModal();
                showData();
                removeExistingToasts(); 
                callToast('success', 'Account created successfully!');
                $('#createCustomerForm')[0].reset();
                
            } else {
                removeExistingToasts(); 
                callToast('danger', 'Failed to create account: ' + response);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            removeExistingToasts(); 
            callToast('danger', 'Failed to create account due to a server error.');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    showData();
});