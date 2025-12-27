<?php

include 'admin_header.php';

$error_message = $_SESSION['error_message'] ?? '';
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['error_message'], $_SESSION['form_data']);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Category</h1>
    <a href="categories.php" class="btn btn-secondary">Back to Categories</a>
</div>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <form action="process_add_category.php" method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= htmlspecialchars($form_data['category_name'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($form_data['description'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</div>

<?php include 'admin_footer.php'; ?>