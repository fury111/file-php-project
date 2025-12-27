<?php


include 'admin_header.php';

// --- Include Class ---
require_once 'AdminCategory.php'; // Adjust path to match your structure

// --- Create Instance ---
$adminCategory = new AdminCategory();

// --- Fetch Data ---
$categories = $adminCategory->getAllCategories(); // Fetch categories using AdminCategory class

?>

<div class="container-fluid mt-4">
    <div class="row">

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Categories</h1>
                <a href="add_category.php" class="btn btn-primary">Add New Category</a> <!-- Link to add page -->
            </div>

            <!-- Categories Table -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th> <!-- Optional: Show creation date -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)): ?>
                            <tr>
                                <td colspan="5" class="text-center">No categories found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= htmlspecialchars($category['category_id']) ?></td>
                                    <td><?= htmlspecialchars($category['category_name']) ?></td>
                                    <td><?= htmlspecialchars($category['description']) ?></td>
                                    <td><?= htmlspecialchars($category['created_at']) ?></td> <!-- Optional -->
                                    <td>
                                        <a href="edit_category.php?id=<?= $category['category_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="delete_category.php?id=<?= $category['category_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php include 'admin_footer.php'; ?>