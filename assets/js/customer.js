var currentCustomerId = null;
var table;

function removeExistingToasts() {
  const existingToasts = document.querySelectorAll(".toast");
  existingToasts.forEach((toast) => toast.remove());
}

            function showData() {
                fetch('php/get-customer.php')
                    .then(response => response.json())
                    .then(data => {

                        const table = new Tabulator("#customer-table", {
                            data: data,
                            layout: "fitColumns",
                            columns: [{
                                    title: "#",
                                    field: "id",
                                    width: 50
                                },
                                {
                                    title: "Full Name",
                                    field: "name"
                                },
                                {
                                    title: "Email",
                                    field: "email"
                                },
                                {
                                    title: "Mobile",
                                    field: "mobile"
                                },
                                {
                                    title: "Balance",
                                    field: "balance",
                                    formatter: function(cell, formatterParams, onRendered) {
                                        const value = cell.getValue();
                                        const className = value < 0 ? 'balance-negative' : 'balance-positive';
                                        return `<span class="${className}">${value}</span>`;
                                    }
                                },
                                {
                                    title: "Action",
                                    formatter: function(cell, formatterParams, onRendered) {
                                        return `
                                    <button class="btn btn-sm btn-primary edit-button">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-button">Delete</button>
                                `;
                                    },
                                    width: 150,
                                    hozAlign: "center",
                                    cellClick: function(e, cell) {
                                        if (e.target.classList.contains('edit-button')) {
                                            var data = cell.getRow().getData();
                                            currentCustomerId = data.id;

                                            $.post("php/edit-customer.php", {
                                                id: currentCustomerId
                                            }, function(data, status) {
                                                var customer = JSON.parse(data);
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

                                            });
                                            var myModal = new bootstrap.Modal(document.getElementById('editCustomerModal'));
                                            myModal.show();
                                        } else if (e.target.classList.contains('delete-button')) {

                                            var data = cell.getRow().getData();
                                            currentCustomerId = data.id;
                                            document.getElementById('deleteCustomerText').innerText = `Are you sure you want to delete customer ${data.name}?`;
                                            var myModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'));
                                            myModal.show();

                                            document.getElementById('confirmDeleteCustomer').addEventListener('click', function confirmDeleteHandler() {
                                                if (currentCustomerId !== null) {
                                                    fetch('php/delete-customer.php', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json'
                                                            },
                                                            body: JSON.stringify({
                                                                id: currentCustomerId
                                                            })
                                                        })
                                                        .then(response => response.json())
                                                        .then(result => {
                                                            if (result.success) {
                                                                table.deleteRow(currentCustomerId);
                                                                callToast('success', 'Customer Deleted successfully!');
                                                                var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteCustomerModal'));
                                                                deleteModal.hide();
                                                                currentCustomerId = null;
                                                            } else {
                                                                callToast('danger', 'Failed to update customer: ' + response.message);
                                                            }
                                                        })
                                                        .catch(error => console.error('Error:', error));
                                                }
                                                document.getElementById('confirmDeleteCustomer').removeEventListener('click', confirmDeleteHandler); // Remove the handler to avoid multiple bindings
                                            });
                                        }
                                    }
                                }
                            ]
                        });
                        // Add event listener for search button
                        document.getElementById('search-button').addEventListener('click', function() {
                            const query = document.getElementById('search-input').value;
                            const field = document.getElementById('search-field').value;
                            table.setFilter([{
                                field: field,
                                type: "like",
                                value: query
                            }, ]);
                        });

                        // Add event listener for save edit customer button
                        document.getElementById('saveEditCustomer').addEventListener('click', function() {
                            var myModal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
                            myModal.hide();
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }


            document.addEventListener('DOMContentLoaded', function() {
                showData();
            });


            //edit account
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
                            callToast('success', 'Customer updated successfully!');
                            $('#editCustomerModal').modal('hide');
                            showData();
                        } else {
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
  var account_name = $("#accountName").val();
  var address_line1 = $("#addressLine1").val();
  var address_line2 = $("#addressLine2").val();
  var mobile = $("#mobile").val();
  var email = $("#email").val();
  var city = $("#city").val();
  var state = $("#state").val();
  var balance = $("#balance").val();
  var pincode = $("#pincode").val();
  var gst = $("#gst").val();
  var pan = $("#pan").val();
  var bank_account = $("#bankAccount").val();
  var ifsc = $("#ifsc").val();

  // Validation checks
  var isValid = true;
  if (!account_name) {
    $("#accountNameError").text("Account Name is required.");
    isValid = false;
  } else {
    $("#accountNameError").text("");
  }
  if (!address_line1) {
    $("#addressLine1Error").text("Address line 1 is required.");
    isValid = false;
  } else {
    $("#addressLine1Error").text("");
  }
  if (!address_line2) {
    $("#addressLine2Error").text("Address line 2 is required.");
    isValid = false;
  } else {
    $("#addressLine2Error").text("");
  }
  if (!mobile) {
    $("#mobileError").text("Mobile number is required.");
    isValid = false;
  } else if (mobile.length > 0 && mobile.length !== 10) {
    $("#mobileError").text("Mobile number must be 10 characters long.");
    isValid = false;
  } else if (mobile.length == 10) {
    $("#mobileError").text("");
  }

  if (!email) {
    $("#emailError").text("Email is required.");
    isValid = false;
  } else {
    $("#emailError").text("");
  }

  if (!city) {
    $("#cityError").text("City is required.");
    isValid = false;
  } else {
    $("#cityError").text("");
  }

  if (!state) {
    $("#stateError").text("State is required.");
    isValid = false;
  } else {
    $("#stateError").text("");
  }

  if (!pincode) {
    $("#pincodeError").text("Pincode is required.");
    isValid = false;
  } else {
    $("#pincodeError").text("");
  }

  if (gst.length > 0 && gst.length !== 15) {
    $("#gstError").text("GST number must be 15 characters long.");
    isValid = false;
  } else if (gst.length == 15) {
    $("#gstError").text("");
  }

  if (pan && pan.length !== 10) {
    $("#panError").text("PAN number must be 10 characters long.");
    isValid = false;
  } else if (pan.length == 10) {
    $("#panError").text("");
  }

  // If any validation fails, stop the function
  if (!isValid) {
    return;
  }

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
      ifsc: ifsc,
    },
    success: function (response) {
      if (response.includes("Account created successfully")) {
        hideModal("addAccountModal");
        showData();
        removeExistingToasts();
        callToast("success", "Account created successfully!");
        $("#createCustomerForm")[0].reset();
      } else {
        hideModal("addAccountModal");
        removeExistingToasts();
        callToast("danger", "Failed to create account: " + response);
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX error:", status, error);
      removeExistingToasts();
      callToast("danger", "Failed to create account due to a server error.");
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  showData();
});
