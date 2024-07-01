// Sub-category table initialization
var subCategoryTable = new Tabulator("#sub-category-table", {
    height: 600,
    layout: "fitColumns",
    columns: [
        { 
            title: "#",
          field: "sub_category_id", 
          sorter: "number" 
        },
        { 
          title: "Sub-Category", 
          field: "description", 
          sorter: "string" 
        },
        {
            field: "actions",
            title: "Actions",
            formatter: function(cell, formatterParams) {
                let div = document.createElement("div");
                
                let editButton = document.createElement("button");
                editButton.className = "btn btn-sm btn-primary me-2";
                editButton.innerHTML = "Edit";
                editButton.onclick = function() 
                {
                    let rowData = cell.getRow().getData();
                    fillSubCategoryForm(rowData);
                };
                div.appendChild(editButton);
        
                let deleteButton = document.createElement("button");
                deleteButton.className = "btn btn-sm btn-danger";
                deleteButton.innerHTML = "Delete";
                deleteButton.onclick = function() {
                    let rowData = cell.getRow().getData();
                    showSubCategoryDeleteConfirmation(rowData.sub_category_id);
                };
                div.appendChild(deleteButton);
                return div;
            }
        }
    ]
});




$(document).ready(function () {
    $('#subcategoryFormModal').on('shown.bs.modal', function () {
        $.ajax({
            url: 'php/get-sub-category.php',
            method: 'GET',
            data: {
                type: 'subcategories'
            },
            success: function (data) {
                var subcategories = JSON.parse(data);
                console.log(subcategories);
            }
        });
    });

    $('#subcategoryform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/create-sub-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    });
});











$(document).ready(function () {
    fetchSubCategories();

    $('#subCategoryForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/create-sub-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Sub-category added successfully');
                    fetchSubCategories();
                } else {
                    alert('Error: ' + result.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error creating sub-category:', error);
            }
        });
    });
});

// Function to fetch sub-categories
function fetchSubCategories() {
    $.ajax({
        url: 'php/get-sub-category.php',
        method: 'GET',
        data: { "type": "subcategories" },
        success: function(data) {
            var subCategories = JSON.parse(data);
            subCategoryTable.setData(subCategories);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching sub-categories:', error);
        }
    });
}

// Function to fill form with sub-category data
function fillSubCategoryForm(rowData) {
    var modal = new bootstrap.Modal(document.getElementById('editsubcategoryFormModal'));
    $('#editsubcategoryname').val(rowData.description);
    $('#editsubcategoryform').data('sub_category_id', rowData.sub_category_id);
    modal.show();
}

$('#editsubcategoryform').on('submit', function(event) {
    event.preventDefault();

    let sub_category_id = $(this).data('sub_category_id');
    let formData = {
        sub_category_id: sub_category_id,
        editsubcategoryname: $('#editsubcategoryname').val()
    };

    $.ajax({
        url: 'php/update-sub-category.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            var result = JSON.parse(response);
            if (result.status === 'success') {
                $('#editsubcategoryFormModal').modal('hide');
                fetchSubCategories();
            } else {
                console.error('Error updating sub-category:', result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating sub-category:', error);
        }
    });
});

function showSubCategoryDeleteConfirmation(subCategoryId) {
    var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();
    $('#confirmDeleteButton').off('click').on('click', function() {
        $.ajax({
            url: 'php/delete-sub-category.php',
            method: 'POST',
            data: { sub_category_id: subCategoryId },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    modal.hide();
                    fetchSubCategories();
                } else {
                    console.error('Error deleting sub-category:', result.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting sub-category:', error);
            }
        });
    });
}

// Search sub-categories
$('#searchbtnsubcategory').on('click', function() {
    let searchTerm = $('input[type="search"]').val();
    if (searchTerm) {
        searchSubCategories(searchTerm);
    }
});

function searchSubCategories(searchTerm) {
    $.ajax({
        url: 'php/search-sub-category.php',
        method: 'GET',
        data: { search: searchTerm },
        success: function(data) {
            var searchResults = JSON.parse(data);
            subCategoryTable.setData(searchResults);
        },
        error: function(xhr, status, error) {
            console.error('Error searching sub-categories:', error);
        }
    });
}
