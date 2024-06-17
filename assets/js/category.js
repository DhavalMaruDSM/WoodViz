var table=new Tabulator("#category-table",{
    height: 600,
    layout: "fitColumns",
    columns: [{
        title: "#",
        field: "id",
        sorter: "number",
    },
    {
        title: "Category",
        field: "category",
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
                showDeleteConfirmation(rowData.id);
            };
            div.appendChild(deleteButton);
            return div;
        }
    }
    ]
});
function fillForm(rowData) {
    document.getElementById('categoryname').value = rowData.category;
    var modal = new bootstrap.Modal(document.getElementById('categoryFormModal'));
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