<?php
include("components/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="main" style="background-color: #F5F5F5;">
        <div class="container mb-3 mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group" style="padding: 1px;">
                        <i class="bi bi-search p-2" style="color: orange; -webkit-text-stroke: 1px;"></i>
                        <select class="form-select" id="subcategoryselect" required>
                            <option disabled selected>Category</option>
                            <option></option>
                        </select>
                        <input type="search" class="form-control" placeholder="Search here..">
                        <button class="btn btn-outline-warning" id="searchbtnsubcategory">Search</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-warning" id="addsubcategoryBtn" data-bs-toggle="modal" data-bs-target="#subcategoryFormModal">+ Add Sub-Category</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="sub-category-table"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="subcategoryFormModal" tabindex="-1" aria-labelledby="subcategoryFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryFormModalLabel">Add Sub-Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="subcategoryform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="subcategoryname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="subcategoryname" name="subcategoryname" placeholder="Enter Sub-Category Name" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="addsubcategoryBotton">Add Sub-Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Sub-category Modal -->
    <div class="modal fade" id="editsubcategoryFormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editsubcategoryform">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Sub-category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editsubcategoryname" class="form-label">Sub-category Name</label>
                            <input type="text" class="form-control" id="editsubcategoryname" name="editsubcategoryname" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this sub-category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="assets/js/js/tabulator.min.js"></script>
    <script src="assets/js/sub-category.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>
