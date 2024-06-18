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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="main" style="background-color: 	#F5F5F5;">
        <div class="container mb-3 mt-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group" style="padding: 1px;">
                        <i class="bi bi-search p-2" style="color: orange; -webkit-text-stroke: 1px;"></i>
                        <select class="form-select" id="productselect" required>
                            <option disabled selected>Select Search</option>
                            <option value="name">Product Name</option>
                            <option value="category">Category</option>
                            <option value="subcategory">Sub-Category</option>
                        </select>
                        <input type="search" class="form-control" placeholder="Search here..">
                        <button class="btn btn-outline-warning" id="searchbtnproduct">Search</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-warning" id="addproductBtn" data-bs-toggle="modal" data-bs-target="#productFormModal">+ Add Product</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="product-table"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="productFormModal" tabindex="-1" aria-labelledby="productFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFormModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="productform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="productname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="productname" name="productname" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="categoryselect" class="form-label">Category:</label>
                                <select class="form-select" id="categoryselect" required>
                                    <option disabled selected>Select a Category</option>
                                    <option></option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="subcategoryselect" class="form-label">Sub Category:</label>
                                <select class="form-select" id="subcategoryselect" required>
                                    <option disabled selected>Select a Sub-Category</option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="inventory" class="form-label">Inventory:</label>
                                <input type="number" class="form-control" value="0" id="inventory" name="inventory" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="cgst" class="form-label">CGST:</label>
                                <input type="number" class="form-control" value="0" id="cgst" name="cgst" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="sgst" class="form-label">SGST:</label>
                                <input type="number" class="form-control" value="0" id="sgst" name="sgst" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="igst" class="form-label">IGST:</label>
                                <input type="number" class="form-control" value="0" id="igst" name="igst" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" class="form-control" value="0" id="price" name="price" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="addproductButton">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editproductFormModal" tabindex="-1" aria-labelledby="editproductFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editproductFormModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="editproductform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="editproductname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="editproductname" name="editproductname" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="editcategoryselect" class="form-label">Category:</label>
                                <select class="form-select" id="editcategoryselect" required>
                                    <option disabled selected>Select a Category</option>
                                    <option></option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="editsubcategoryselect" class="form-label">Sub Category:</label>
                                <select class="form-select" id="editsubcategoryselect" required>
                                    <option disabled selected>Select a Sub-Category</option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="editinventory" class="form-label">Inventory:</label>
                                <input type="number" class="form-control" value="0" id="editinventory" name="editinventory" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="editcgst" class="form-label">CGST:</label>
                                <input type="number" class="form-control" value="0" id="editcgst" name="editcgst"  required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="editsgst" class="form-label">SGST:</label>
                                <input type="number" class="form-control" value="0" id="editsgst" name="editsgst"  required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="editigst" class="form-label">IGST:</label>
                                <input type="number" class="form-control" value="0" id="editigst" name="editigst"  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="editprice" class="form-label">Price:</label>
                                <input type="number" class="form-control" value="0" id="editprice" name="editprice" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="editaddproductButton">Edit Product</button>
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
    <script src="assets/js/product_backend.js"></script>
    <script src="assets/js/product.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>