<?php
require_once '../Classes/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

    $cart = new Cart();
    $cart->add($productId, $quantity);
}

// Redirect back to the page the user came from, or index.php
$referrer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $referrer");
exit();
?>