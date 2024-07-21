var table=new Tabulator("#category-table",{
    height: 600,
    layout: "fitColumns",
    columns: [{
        title: "#",
        field: "category_id",
        sorter: "number",
    },
    {
        title: "Category",
        field: "description",
        sorter: "string",
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
            deleteButton.onclick = function () 
            {
                let rowData = cell.getRow().getData();
                showDeleteConfirmation(rowData.category_id);
            };
            div.appendChild(deleteButton);
            return div;
        }
    }
    ]
});





$(document).ready(function () {
    $('#categoryFormModal').on('shown.bs.modal', function () {
        $.ajax({
            url: 'php/get-category.php',
            method: 'GET',
            data: {
                type: 'categories'
            },
            success: function (data) {
                var categories = JSON.parse(data);
                console.log(categories);
            }
        });
    });
    

    $('#categoryform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/create-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    });
});


function fetchCategories() {
    $.ajax({
        url: 'php/get-category.php',
        method: 'GET',
        data : {
            "type" : "categories"
        },
        success: function(data) {
            var categories = JSON.parse(data);
            table.setData(categories);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching categories:', error);
        }
    });
}

fetchCategories();

function fillForm(rowData) {
    var modal = new bootstrap.Modal(document.getElementById('editcategoryFormModal'));
    
    $('#editcategoryname').val(rowData.description);
    $('#editcategoryform').data('category_id', rowData.category_id);
    modal.show();
}



$('#editcategoryform').on('submit', function(event) {
    event.preventDefault();

    let category_id = $(this).data('category_id');
    let formData = {
        category_id: category_id,
        editcategoryname: $('#editcategoryname').val()
    };

    $.ajax({
        url: 'php/update-category.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            var result = JSON.parse(response);
            if (result.status === 'success') {
                $('#editcategoryFormModal').modal('hide');
                fetchCategories(); // Refresh the categories table
            } else {
                console.error('Error updating category:', result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating category:', error);
        }
    });
});



function showDeleteConfirmation(categoryId) {
    let modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    document.getElementById('confirmDeleteButton').onclick = function () {
        $.ajax({
            url: 'php/delete-category.php',
            method: 'POST',
            data: {
                id: categoryId
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    table.deleteRow(categoryId);
                    modal.hide();
                    fetchCategories(); // Refresh the categories table
                } else {
                    alert('Error deleting category: ' + result.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting category: ' + error);
            }
        });
    };
}



    $('#searchbtncategory').on('click', function() {
        let searchTerm = $('#searchInput').val();
        if (searchTerm) {
            searchCategories(searchTerm);
        }
    });

function searchCategories(searchTerm) {
    $.ajax({
        url: 'php/search-category.php',
        method: 'GET',
        data: {
            search: searchTerm
        },
        success: function(data) {
            var searchResults = JSON.parse(data);
            if (searchResults.length > 0) {
                table.setData(searchResults);
            } else {
                alert('No categories found for the search term: ' + searchTerm);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error searching categories:', error);
        }
    });
}


$(document).ready(function() {
    $('#categoryFormModal').on('shown.bs.modal', function() {
        $('#categoryform')[0].reset();
    });

    $('#categoryform').submit(function(event) {
        event.preventDefault(); 
        
        var formData = {
            category: $('#categoryname').val()
        };
        
        $.ajax({
            url: 'php/create-category.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Category submitted successfully!');

                $('#categoryform')[0].reset();
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Failed to submit category: ' + textStatus);
            }
        });
    });
});

document.getElementById('searchbtncategory').addEventListener('click', function() {
    let field = document.getElementById('categoryselect').value;
    let value = document.getElementById('searchInput').value;
    let comparison = "like";  // Default comparison operator
    
    if (field && value) {
        table.setFilter(field, comparison, value);
    } else {
        table.clearFilter();
    }
});

$(document).ready(function () {
    $('#updateCategoryForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/update-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Category updated successfully');
                    // Reload or update the table to reflect changes
                } else {
                    alert('Error: ' + result.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating category:', error);
            }
        });
    });
});
