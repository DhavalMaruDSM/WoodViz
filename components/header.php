<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodViz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link href="https://unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css" rel="stylesheet">

    <link
            rel="canonical"
            href="https://getbootstrap.com/docs/5.3/examples/sidebars/"
        />

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"
        />

        <link rel="stylesheet" href="assets/css/sidebars.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/sidebars.js"></script>


    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js"></script>

</head>

<body class="bodycolor">
    <?php
    session_start();

    //      
    ?>
    <div>
        <div class="bgcolor py-2">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand mx-4">
                        <span class="woodViz-style">WoodViz</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <span class="head-style" style="margin-left: 55px;">DASHBOARD</span>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <div class="search-style">
                                    <div class="input-group" style="padding: 1px;">
                                        <i class="bi bi-search p-2"
                                            style="color: orange; -webkit-text-stroke: 1px;"></i>
                                        <input type="search" class="form-control border-0" placeholder="Search here..">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item text-center m-2">
                                <i class="bi bi-bell p-3" style="color: orange; -webkit-text-stroke: 1px;"></i>
                            </li>
                            <li class="nav-item">
                                <div class="input-group">
                                    <img style="width: 40px;"
                                        src="https://cdn.pixabay.com/photo/2024/06/03/13/36/ai-generated-8806433_1280.jpg"
                                        class="rounded-circle">
                                    <div class="row">
                                        <div class="col-12">
                                            <span style="font-weight: bold;" class="mx-2">User name</span>
                                        </div>
                                        <div class="col-12 mr-3">
                                            <span style="font-weight:lighter;" class="mx-2"><small>Role</small></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="wrapper">
            <aside id="sidebar">
                <div class="div-height">
                <ul class="list-unstyled ps-0">
                    <li class="sidebar-item mb-1">
                        <a href="index.php"
                            class="btn width1 d-inline-flex align-items-center rounded border-0">
                            <i class="bi bi-columns-gap p-3"></i>
                            <span class="sidebar-span-style">Dashboard</span>
                        </a>    
                    </li>
                    <li class="sidebar-item mb-1">
                        <button
                            class="btn width1 d-inline-flex align-items-center rounded border-0 collapsed active"
                            data-bs-toggle="collapse"
                            data-bs-target="#product-collapse"
                            aria-expanded="false">
                            <i class="bi bi-box-seam p-3"></i>
                            <span class="sidebar-span-style">Product</span>
                        </button>
                        <div class="collapse" id="product-collapse">
                            <ul
                                class="sidebar-sub-item btn-toggle-nav list-unstyled fw-normal pb-1 small"
                            >
                                <li>
                                    <a
                                        href="category.php"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Category</span></a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="sub-category.php"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Sub Category</span></a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="product.php"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Products</span></a
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-item mb-1">
                        <button
                            class="btn width1 d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#customer-collapse"
                            aria-expanded="false"
                        ><i class="bi bi-people-fill p-3"></i>
                        <span class="sidebar-span-style">Customer</span>
                        </button>
                        <div class="collapse" id="customer-collapse">
                            <ul
                                class="sidebar-sub-item btn-toggle-nav list-unstyled fw-normal pb-1 small"
                            >
                                <li>
                                    <a
                                        href="customer.php"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Customer List</span></a
                                    >
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-item mb-1">
                        <button
                            class="btn width1 d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#billing-collapse"
                            aria-expanded="false"
                        ><i class="bi bi-receipt p-3"></i>
                        <span class="sidebar-span-style">Billing</span>
                        </button>
                        <div class="collapse" id="billing-collapse">
                            <ul
                                class="sidebar-sub-item btn-toggle-nav list-unstyled fw-normal pb-1 small"
                            >
                                <li>
                                    <a
                                        href="#"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Create Invoice</span></a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">Invoice List</span></a
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-item mb-1">
                        <button
                            class="btn width1 d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#report-collapse"
                            aria-expanded="false"
                        ><i class="bi bi-database-fill p-3"></i>
                        <span class="sidebar-span-style">Reports</span>
                        </button>
                    </li>
                    <li class="sidebar-item mb-1">
                        <button
                            class="btn width1 d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#admin-collapse"
                            aria-expanded="false"
                        ><i class="bi bi-person-circle p-3 icon-b"></i>
                        <span class="sidebar-span-style">Admin</span>
                        </button>
                        <div class="collapse" id="admin-collapse">
                            <ul
                                class="sidebar-sub-item btn-toggle-nav list-unstyled fw-normal pb-1 small"
                            >
                                <li>
                                    <a
                                        href="manageUsers.php"
                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                        ><i class="bi bi-dash icon-b1"></i><span class="sidebar-sub-span-style">User List</span></a
                                    >
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                </ul>
                </div>
                <div class="text-center">
                    <img class="img1" src="logo.png">
                </div>
            </aside>
            