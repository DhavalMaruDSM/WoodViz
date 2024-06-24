$(document).ready(function() {
    $('#subcategoryFormModal').on('shown.bs.modal', function() {
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
                    subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.description + '</option>');
                });
            }
        });
    });

    $('#sub-category-table').on('click', '.edit-btn', function() {
        var subCategoryId = $(this).data('id');
        $.ajax({
            url: 'php/get-sub-category.php',
            method: 'GET',
            data: { id: subCategoryId },
            success: function(response) {
                var subcategory = JSON.parse(response);
                $('#subcategoryId').val(subcategory.id);
                $('#subcategoryname').val(subcategory.name);
                var modal = new bootstrap.Modal(document.getElementById('subcategoryFormModal'));
                modal.show();
            }
        });
    });

    $('#subcategoryform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'php/save-sub-category.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
});
