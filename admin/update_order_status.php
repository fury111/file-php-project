<?php


// Include the Database and AdminOrder classes
require_once '../Classes/Database.php';
require_once 'AdminOrder.php';

// Get the order ID and new status from the URL parameters
$orderId = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);
$newStatus = $_GET['status'] ?? '';

// Define valid statuses
$validStatuses = ['pending', 'delivered', 'cancelled'];

// Validation
$errors = [];

if ($orderId <= 0) {
    $errors[] = "Invalid order ID.";
} 

if (!in_array($newStatus, $validStatuses)) {
    $errors[] = "Invalid status.";
}

if (empty($errors)) {
    try {
        // Create an instance of AdminOrder
        $adminOrder = new AdminOrder();

        // Use the AdminOrder class to update the order status
        $success = $adminOrder->updateOrderStatus($orderId, $newStatus);

        if ($success) {
            // Success: Redirect back to orders page with success message
            $_SESSION['success_message'] = "Order #{$orderId} status updated to '{$newStatus}' successfully!";
            header('Location: orders.php');
            exit;
        } else {
            $errors[] = "Failed to update order status. It might not exist.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while updating the order status: " . $e->getMessage();
        error_log("Order status update error: " . $e->getMessage()); // Log for debugging
    }
}

// If there were errors, go back to orders page with error message
if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);
    header('Location: orders.php');
    exit;
}
?>