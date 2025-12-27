<?php


require_once '../Classes/Database.php';
require_once 'AdminProduct.php';

$productId = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

$errors = [];

if ($productId <= 0) {
    $errors[] = "Invalid product ID.";
}

if (empty($errors)) {
    try {
        $adminProduct = new AdminProduct();

        $success = $adminProduct->deleteProduct($productId);

        if ($success) {
         
            $_SESSION['success_message'] = "Product deleted successfully!";
            header('Location: products.php');
            exit;
        } else {
            $errors[] = "Failed to delete product. It might not exist.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while deleting the product: " . $e->getMessage();
        error_log("Product deletion error: " . $e->getMessage()); 
    }
}


if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);
    header('Location: products.php');
    exit;
}
?>