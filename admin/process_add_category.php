<?php


require_once '../Classes/Database.php';
require_once 'AdminCategory.php';

$adminCategory = new AdminCategory();

$categoryName = trim($_POST['category_name'] ?? '');
$description = trim($_POST['description'] ?? '');

$errors = [];

if (empty($categoryName)) {
    $errors[] = "Category name is required.";
}



if (empty($errors)) {
    try {
        
        $categoryId = $adminCategory->createCategory($categoryName, $description);

        if ($categoryId) {
          
            $_SESSION['success_message'] = "Category '$categoryName' added successfully!";
            header('Location: categories.php');
            exit;
        } else {
            $errors[] = "Failed to add category to the database.";
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while adding the category: " . $e->getMessage();
        error_log("Category creation error: " . $e->getMessage()); 
    }
}


if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);

    $_SESSION['form_data'] = [
        'category_name' => $categoryName,
        'description' => $description
    ];
    header('Location: add_category.php');
    exit;
}
?>