<?php

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = ($isLoggedIn && $_SESSION['role'] === 'admin');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css  " rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css  " />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column h-100">
    <!-- Top Navigation Bar (Amazon Style) -->
    <nav class="navbar navbar-expand-lg bg-dark text-light py-4">
        <div class="container-fluid">

            <!-- Logo and "Deliver to" Section (Left Side) -->
            <div class="d-flex align-items-center me-3">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="../public/index.php">
                    <i class="fas fa-store me-2"></i> ShopNow
                </a>
                <!-- You can add "Deliver to" functionality here if needed later -->
                <!-- <span class="ms-3 text-white small">Deliver to</span> -->
            </div>

            <!-- Search Bar (Center) -->
            <div class="d-none d-lg-block flex-grow-1 mx-3">
                <form class="d-flex">
                    <div class="input-group">
                        <select class="form-select" id="categorySelect" style="max-width: 70px;">
                            <option value="all">All</option>
                            <!-- Add more categories as needed -->
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Search ShopNow" aria-label="Search">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <!-- Right Side Links (Account, Orders, Cart) -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">

                <!-- Account & Lists / Hello, Sign in -->
                <li class="nav-item dropdown me-3">
                    <?php if ($isLoggedIn): ?>
                        <a class="nav-link dropdown-toggle text-white" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, <?= htmlspecialchars($_SESSION['first_name']) ?><br><small>Account & Lists</small>
                        </a>
                    <?php else: ?>
                        <a class="nav-link text-white" href="../public/login.php">
                            Hello, <br><small>Sign in</small>
                        </a>
                    <?php endif; ?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <?php if ($isLoggedIn): ?>
                            <li><a class="dropdown-item" href="../public/profile.php">Your Profile</a></li>
                            <li><a class="dropdown-item" href="../public/cart.php">Your Cart</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="../public/logout.php">Logout</a></li>
                            <?php if ($isAdmin): ?>
                                <li><a class="dropdown-item" href="../admin/dashboard.php">Admin Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="../public/login.php">Sign In</a></li>
                            <li><a class="dropdown-item" href="../public/register.php">Create Account</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Cart (Updated Link Structure) -->
                <li class="nav-item">
                    <!-- Wrap entire cart content in the anchor tag -->
                    <a class="nav-link text-white d-flex flex-column align-items-center" href="../public/cart.php">
                        <div class="position-relative">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <!-- Calculate cart item count dynamically -->
                            <?php
                            $cartItemCount = 0;
                            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                                // Example: Count distinct product IDs (or sum quantities if your cart stores them)
                                $cartItemCount = count($_SESSION['cart']);
                            }
                            ?>
                            <?php if ($cartItemCount > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark"><?= $cartItemCount ?></span>
                            <?php endif; ?>
                        </div>
                        <small>Cart</small>
                    </a>
                </li>

            </ul>

        </div>
    </nav>



    <!-- Main content wrapper -->
    <main class="flex-shrink-0 flex-grow-1">
        <!-- Content will be inserted here by other pages -->