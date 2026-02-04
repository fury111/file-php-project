<?php
require_once '../Classes/Cart.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $cart = new Cart();
    $cart->remove($productId);
}

header('Location: cart.php');
exit();
?>