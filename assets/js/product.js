var table=new Tabulator("#product-table",{
    height: 600,
    layout: "fitColumns",
    columns: [{
        title: "#",
        field: "product_id",
        sorter: "number",
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
                showDeleteConfirmation(rowData.id);
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
    document.getElementById('productname').value = rowData.name;
    document.getElementById('categoryselect').value = rowData.category;
    document.getElementById('subcategoryselect').value = rowData.subcategory;
    document.getElementById('inventory').value = rowData.inventory;
    var modal = new bootstrap.Modal(document.getElementById('productFormModal'));
    modal.show();
}

function showDeleteConfirmation(rowId) {
    let modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    document.getElementById('confirmDeleteButton').onclick = function () {
        table.deleteRow(rowId);
        modal.hide();
    };
}