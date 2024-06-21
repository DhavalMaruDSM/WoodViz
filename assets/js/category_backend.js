$(document).ready(function() {
    $('#categoryFormModal').on('shown.bs.modal', function() {
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
                    categorySelect.append('<option value="' + category.id + '">' + category.description + '</option>');
                });
            }
        });
    });

    $('#category-table').on('click', '.edit-btn', function() {
        var categoryId = $(this).data('id');
        $.ajax({
            url: 'php/get-category.php',
            method: 'GET',
            data: { id: categoryId },
            success: function(response) {
                var category = JSON.parse(response);
                $('#categoryId').val(category.id);
                $('#categoryname').val(category.name);
                var modal = new bootstrap.Modal(document.getElementById('categoryFormModal'));
                modal.show();
            }
        });
    });

    $('#categoryform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'php/save-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
});
