var table=new Tabulator("#product-table",{
    height: 600,
    layout: "fitColumns",
    columns: [
        {
        title: "#",
            formatter: function (cell) {
                return cell.getRow().getPosition(true);
            },
            sorter:"number",
        },
        {
        title: "#",
        field: "product_id",
        sorter: "number",
        visible :false,
    },
    {
        title: "Name",
        field: "name",
        sorter: "string",
    },
    {
        title: "Category",
        field: "description",
        sorter: "string",
    },
    {
        title: "Sub-Category",
        field: "s_description",
        sorter: "string",
    },
    {
        title: "Inventory",
        field: "inventory",
        sorter: "number",
    },
    {
        title :"price",
        field :"price",
        sorter: "number",
        visible: false
    },
    {   title :"igst",
        field:"igst",
        sorter:"number",
        visible:false
    },
    {
        title:"cgst",
        field:"igst",
        sorter:"number",
        visible:false
    },
    {
        title:"sgst",
        field:"sgst",
        sorter:"number",
        visible:false
    },
    {
        title:"category_id",
        field:"category_id",
        sorter:"number",
        visible:false
    },
    {
        title:"sub_category_id",
        field:"sub_category_id",
        sorter:"number",
        visible:false
    },
    {
        field: "actions",
        title: "Actions",
        formatter: function (cell, formatterParams) 
        {
            let div = document.createElement("div");

            let editButton = document.createElement("button");
            editButton.className = "btn btn-sm btn-primary me-2";
            editButton.innerHTML = "Edit";
            editButton.onclick = function () 
            {
                let rowData = cell.getRow().getData();
                fillForm(rowData);
            };
            div.appendChild(editButton);

            let deleteButton = document.createElement("button");
            deleteButton.className = "btn btn-sm btn-danger";
            deleteButton.innerHTML = "Delete";
            deleteButton.onclick = function () {
                let rowData = cell.getRow().getData();
                showDeleteConfirmation(rowData.product_id);
            };
            div.appendChild(deleteButton);
            return div;
        }
    }
    ]
});

function fetchProducts() {
    $.ajax({
        url: 'php/get-product.php',
        method: 'GET',
        success: function(data) {
            var products = JSON.parse(data);
            table.setData(products);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
}

fetchProducts();
function fillForm(rowData) {
    var modal = new bootstrap.Modal(document.getElementById('editproductFormModal'));

    $('#editproductname').val(rowData.name);
    $('#editinventory').val(rowData.inventory);
    $('#editcgst').val(rowData.cgst);
    $('#editsgst').val(rowData.sgst);
    $('#editigst').val(rowData.igst);
    $('#editprice').val(rowData.price);
    $('#editproductform').data('product_id', rowData.product_id);
    
    $.ajax({
        url: 'php/get-category.php',
        method: 'GET',
        data: { type: 'categories' },
        success: function(data) {
            var categories = JSON.parse(data);
            var categorySelect = $('#editcategoryselect');
            categorySelect.empty().append('<option disabled>Select a Category</option>');
            categories.forEach(function(category) {
                if (category.category_id === rowData.category_id) {
                    categorySelect.append('<option value="' + category.category_id + '" selected>' + category.description + '</option>');
                } else {
                    categorySelect.append('<option value="' + category.category_id + '">' + category.description + '</option>');
                }
            });

            // Fetch sub-categories after categories have been loaded
            fetchSubCategories(rowData.sub_category_id);
        }
    });

    modal.show();
}

function fetchSubCategories(selectedSubCategoryId) {
    $.ajax({
        url: 'php/get-sub-category.php',
        method: 'GET',
        data: { type: 'subcategories' },
        success: function(data) {
            var subcategories = JSON.parse(data);
            var subcategorySelect = $('#editsubcategoryselect');
            subcategorySelect.empty().append('<option disabled>Select a Sub-Category</option>');
            subcategories.forEach(function(subcategory) {
                if (subcategory.sub_category_id === selectedSubCategoryId) {
                    subcategorySelect.append('<option value="' + subcategory.sub_category_id + '" selected>' + subcategory.description + '</option>');
                } else {
                    subcategorySelect.append('<option value="' + subcategory.sub_category_id + '">' + subcategory.description + '</option>');
                }
            });
        }
    });
}

$('#editproductform').submit(function(event) {
    event.preventDefault();

    var formData = {
        product_id: $('#editproductform').data('product_id'),
        name: $('#editproductname').val(),
        category_id: $('#editcategoryselect').val(),
        sub_category_id: $('#editsubcategoryselect').val(),
        inventory: $('#editinventory').val(),
        cgst: $('#editcgst').val(),
        sgst: $('#editsgst').val(),
        igst: $('#editigst').val(),
        price: $('#editprice').val()
    };

    $.ajax({
        url: 'php/update-product.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            var result = JSON.parse(response);
            if (result.status === 'success') {
                callToast("sucess","Edited successfully");
                fetchProducts();  
                $('#editproductFormModal').modal('hide');
            } else {
                alert('Error updating product: ' + result.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error updating product: ' + error);
        }
    });
});


function showDeleteConfirmation(productId) {
    let modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    document.getElementById('confirmDeleteButton').onclick = function () {
        $.ajax({
            url: 'php/delete-product.php',
            method: 'POST',
            data: {
                id: productId
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    callToast("sucess","Deleted successfully");
                    table.deleteRow(productId);
                    modal.hide();
                    fetchProducts();
                } else {
                    alert('Error deleting product: ' + result.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting product: ' + error);
            }
        });
    };
}

$(document).ready(function() {
    $('#productFormModal').on('shown.bs.modal', function() {
        $.ajax({
            url: 'php/get-category.php',
            method: 'GET',
            data: {
                type: 'categories'
            },
            success: function(data) {
                var categories = JSON.parse(data);
                var categorySelect = $('#categoryselect');
                categorySelect.empty().append('<option disabled selected>Select a Category</option>');
                categories.forEach(function(category) {
                    categorySelect.append('<option value="' + category.category_id + '">' + category.description + '</option>');
                });
            }
        });
    });

    $('#categoryselect').change(function() {
        var categoryId = $(this).val();
        $.ajax({
            url: 'php/get-sub-category.php',
            method: 'GET',
            data: {
                type: 'subcategories'
            },
            success: function(data) {
                var subcategories = JSON.parse(data);
                var subcategorySelect = $('#subcategoryselect');
                subcategorySelect.empty().append('<option disabled selected>Select a Sub-Category</option>');
                subcategories.forEach(function(subcategory) {
                    subcategorySelect.append('<option value="' + subcategory.sub_category_id + '">' + subcategory.description + '</option>');
                });
            }
        });
    });
    $('#productform').submit(function(event) {
        event.preventDefault(); 
        
        var formData = {
            productname: $('#productname').val(),
            category: $('#categoryselect').val(),
            subcategory: $('#subcategoryselect').val(),
            inventory: $('#inventory').val(),
            cgst: $('#cgst').val(),
            sgst: $('#sgst').val(),
            igst: $('#igst').val(),
            price: $('#price').val()
        };
        
        $.ajax({
            url: 'php/create-product.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Product submitted successfully!');
                callToast("sucess","Inserted successfully");
                $('#productform')[0].reset();
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Failed to submit product: ' + textStatus);
            }
        });
    });
});


document.getElementById('searchbtnproduct').addEventListener('click', function() {
    let field = document.getElementById('productselect').value;
    let value = document.getElementById('searchInput').value;
    let comparison = "like";  
    
    if (field && value) {
        table.setFilter(field, comparison, value);
    } else {
        table.clearFilter();
    }
});