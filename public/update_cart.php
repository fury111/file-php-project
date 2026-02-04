<?php
require_once '../Classes/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    $cart = new Cart();
    $cart->update($productId, $quantity);
}

header('Location: Cart.php');
exit();
?>