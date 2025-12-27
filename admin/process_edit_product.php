<?php


require_once '../Classes/Database.php';
require_once 'AdminProduct.php';

$productId = filter_var($_POST['product_id'] ?? 0, FILTER_VALIDATE_INT);

$productName = trim($_POST['product_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = filter_var($_POST['price'] ?? 0, FILTER_VALIDATE_FLOAT);
$stock = filter_var($_POST['stock'] ?? 0, FILTER_VALIDATE_INT);
$categoryId = filter_var($_POST['category_id'] ?? 0, FILTER_VALIDATE_INT);
$imageFile = $_FILES['image'] ?? null;

$errors = [];

if ($productId <= 0) {
    $errors[] = "Invalid product ID.";
}

if (empty($productName) || empty($description) || $price === false || $stock === false || $categoryId === false) {
    $errors[] = "All fields (Name, Description, Price, Stock, Category) are required and must be valid.";
}

if ($price < 0) {
    $errors[] = "Price must be a positive number.";
}

if ($stock < 0) {
    $errors[] = "Stock quantity cannot be negative.";
}

$imagePath = null;
$keepCurrentImage = true; 

if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $maxSize = 5 * 1024 * 1024; 

    if (!in_array($imageFile['type'], $allowedTypes)) {
        $errors[] = "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
    }

    if ($imageFile['size'] > $maxSize) {
        $errors[] = "File size exceeds 5MB limit.";
    }

    if (empty($errors)) {
        $uploadDir = '../assets/images/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); 
        }

        $fileName = basename($imageFile['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetPath = $uploadDir . $newFileName;

        if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/' . $newFileName; 
            $keepCurrentImage = false; 
        } else {
            $errors[] = "Failed to upload new image.";
        }
    }
}

if (empty($errors)) {
    try {
        $adminProduct = new AdminProduct();

        $currentProduct = $adminProduct->getProductById($productId);
        if (!$currentProduct) {
            $errors[] = "Product not found.";
        } else {
            $existingImagePath = $currentProduct['image'];

            if ($keepCurrentImage) {
                $finalImagePath = $existingImagePath; 
            } else {
                
                if ($existingImagePath && file_exists('../assets/images/' . $existingImagePath)) {
                    unlink('../assets/images/' . $existingImagePath); 
                }
                $finalImagePath = $imagePath; 
            }

            $success = $adminProduct->updateProduct($productId, $productName, $description, $price, $stock, $finalImagePath, $categoryId);

            if ($success) {
                $_SESSION['success_message'] = "Product '$productName' updated successfully!";
                header('Location: products.php');
                exit;
            } else {
                $errors[] = "Failed to update product in the database.";
            }
        }

    } catch (Exception $e) {
        $errors[] = "An error occurred while updating the product: " . $e->getMessage();
        error_log("Product update error: " . $e->getMessage()); 
    }
}

if (!empty($errors)) {
    $_SESSION['error_message'] = implode('<br>', $errors);

    $_SESSION['form_data'] = [
        'product_name' => $productName,
        'description' => $description,
        'price' => $price,
        'stock' => $stock,
        'category_id' => $categoryId
    ];
    header('Location: edit_product.php?id=' . $productId);
    exit;
}
?>