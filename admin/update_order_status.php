<?php


require_once '../Classes/Database.php';
require_once 'AdminOrder.php';

$orderId = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);
$newStatus = $_GET['status'] ?? '';

$validStatuses = ['pending', 'delivered', 'cancelled'];

$errors = [];

if ($orderId <= 0) {
    $errors[] = "Invalid order ID.";
} 

if (!in_array($newStatus, $validStatuses)) {
    $errors[] = "Invalid status.";
}

if (empty($errors)) {
    try {
        $adminOrder = new AdminOrder();

        $success = $adminOrder->updateOrderStatus($orderId, $newStatus);

        if ($success) {
            $_SESSION['success_message'] = "Order #{$orderId} status updated to '{$newStatus}' successfully!";
            header('Location: orders.php');
            exit;
        } else {
            $errors[] = "Failed to update order status. It might not exist.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while updating the order status: " . $e->getMessage();
        error_log("Order status update error: " . $e->getMessage()); 
    }
}

if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);
    header('Location: orders.php');
    exit;
}
?>