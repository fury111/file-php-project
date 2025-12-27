<?php


require_once '../Classes/Database.php';
require_once 'AdminCategory.php';

$categoryId = filter_var($_POST['category_id'] ?? 0, FILTER_VALIDATE_INT);

$categoryName = trim($_POST['category_name'] ?? '');
$description = trim($_POST['description'] ?? '');

$errors = [];

if ($categoryId <= 0) {
    $errors[] = "Invalid category ID.";
}

if (empty($categoryName)) {
    $errors[] = "Category name is required.";
}

if (empty($errors)) {
    try {
        $adminCategory = new AdminCategory();

        $success = $adminCategory->updateCategory($categoryId, $categoryName, $description);

        if ($success) {
            $_SESSION['success_message'] = "Category '$categoryName' updated successfully!";
            header('Location: categories.php');
            exit;
        } else {
            $errors[] = "Failed to update category in the database.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while updating the category: " . $e->getMessage();
        error_log("Category update error: " . $e->getMessage());
    }
}


if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);

    $_SESSION['form_data'] = [
        'category_name' => $categoryName,
        'description' => $description
    ];
    header('Location: edit_category.php?id=' . $categoryId);
    exit;
}
?>