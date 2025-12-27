<?php

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ShopNow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/admin_style.css"> 
</head>
<body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
     
            <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
                <i class="fas fa-store me-2"></i> Admin - ShopNow
            </a>

         
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="../public/logout.php">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>

        </div>
    </nav>


    <div class="flex-shrink-0 flex-grow-1 d-flex"> 

 
        <nav class="d-md-block bg-light sidebar collapse" style="width: 250px;">
            <div class="position-sticky pt-3" style="height: calc(100vh - 56px); overflow-y: auto;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">
                            <i class="fas fa-tags"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reviews.php">
                            <i class="fas fa-comments"></i> Reviews
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 flex-grow-1"> 
          