<?php
include("components/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="main" style="background-color: 	#F5F5F5;">
        <div class="container mb-3 mt-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group" style="padding: 1px;">
                        <i class="bi bi-search p-2" style="color: orange; -webkit-text-stroke: 1px;"></i>
                        <select class="form-select" id="categoryselect" required>
                            <option disabled selected>Category</option>
                            <option></option>
                        </select>
                        <input type="search" class="form-control" placeholder="Search here..">
                        <button class="btn btn-outline-warning" id="searchbtncategory">Search</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-warning" id="addcategoryBtn" data-bs-toggle="modal" data-bs-target="#categoryFormModal">+ Add Category</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="category-table"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryFormModal" tabindex="-1" aria-labelledby="categoryFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryFormModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="categoryform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="categoryname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" placeholder="Enter Category Name" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="addcategoryButton">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editcategoryFormModal" tabindex="-1" aria-labelledby="editcategoryFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editcategoryFormModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="editcategoryform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="editcategoryname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="editcategoryname" name="editcategoryname" placeholder="Enter Category Name" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="editaddcategoryBtn">Edit Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="assets/js/js/tabulator.min.js"></script>
    <script src="assets/js/category.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>