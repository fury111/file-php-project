<?php

include 'admin_header.php';

require_once 'AdminCategory.php';
$adminCategory = new AdminCategory();
$categories = $adminCategory->getAllCategories();

$error_message = $_SESSION['error_message'] ?? '';
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['error_message'], $_SESSION['form_data']);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Product</h1>
    <a href="products.php" class="btn btn-secondary">Back to Products</a>
</div>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <form action="process_add_product.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($form_data['product_name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($form_data['description'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($form_data['price'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= htmlspecialchars($form_data['stock'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select a category...</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>" <?= (isset($form_data['category_id']) && $form_data['category_id'] == $category['category_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Upload an image for the product (optional).</div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>

<?php include 'admin_footer.php'; ?>