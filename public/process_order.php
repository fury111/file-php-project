<?php
require_once '../Classes/order.php';
require_once '../Classes/Cart.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = new Cart();
    $orderObj = new Order();

    $userId = $_SESSION['user_id'];
    $itemsInCart = $cart->getItems();

    if (empty($itemsInCart)) {
        header('Location: Cart.php');
        exit;
    }

    // Calculate total
    require_once '../Classes/product.php';
    $productObj = new Product();
    $total = 0;
    foreach ($itemsInCart as $productId => $quantity) {
        $product = $productObj->getById($productId);
        if ($product) {
            $total += $product['price'] * $quantity;
        }
    }
    $total += 5.00; // Shipping

    $orderId = $orderObj->create($userId, $total, $itemsInCart);

    if ($orderId) {
        $cart->clear();
        header("Location: profile.php?order_success=$orderId");
        exit();
    } else {
        $error = "Failed to place order. Please try again.";
        header("Location: checkout.php?error=" . urlencode($error));
        exit();
    }
} else {
    header('Location: index.php');
    exit;
}
?>