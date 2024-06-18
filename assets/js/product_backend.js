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

                $('#productform')[0].reset();
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Failed to submit product: ' + textStatus);
            }
        });
    });
});