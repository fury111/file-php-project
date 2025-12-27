<?php


require_once '../Classes/Database.php';
require_once 'AdminCategory.php';

$categoryId = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

$errors = [];

if ($categoryId <= 0) {
    $errors[] = "Invalid category ID.";
}

if (empty($errors)) {
    try {
        $adminCategory = new AdminCategory();

        $success = $adminCategory->deleteCategory($categoryId);

        if ($success) {
            $_SESSION['success_message'] = "Category deleted successfully!";
            header('Location: categories.php');
            exit;
        } else {
            $errors[] = "Failed to delete category. It might not exist.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while deleting the category: " . $e->getMessage();
        error_log("Category deletion error: " . $e->getMessage()); 
    }
}


if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);
    header('Location: categories.php');
    exit;
}
?>