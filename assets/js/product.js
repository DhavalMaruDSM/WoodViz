var table=new Tabulator("#product-table",{
    height: 600,
    layout: "fitColumns",
    columns: [{
        title: "#",
        field: "id",
        sorter: "number",
    },
    {
        title: "Name",
        field: "name",
        sorter: "string",
    },
    {
        title: "Category",
        field: "category",
        sorter: "string",
    },
    {
        title: "Sub-Category",
        field: "subcategory",
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