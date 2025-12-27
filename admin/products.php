<?php


include 'admin_header.php';
require_once 'AdminProduct.php'; 
require_once 'AdminCategory.php'; 


$adminProduct = new AdminProduct();
$adminCategory = new AdminCategory(); 

$products = $adminProduct->getAllProducts(); 
$categories = $adminCategory->getAllCategories(); 

?>

<div class="container-fluid mt-4">
    <div class="row">

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Products</h1>
                <a href="add_product.php" class="btn btn-primary">Add New Product</a> 
            </div>

       
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search products...">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['product_id']) ?></td>
                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                    <td><?= htmlspecialchars($product['category_name'] ?? 'N/A') ?></td> 
                                    <td><?= htmlspecialchars($product['price']) ?></td>
                                    <td><?= htmlspecialchars($product['stock']) ?></td>
                                    <td>
                                        <?php if (!empty($product['image'])): ?>
                                            <img src="../assets/images/<?= htmlspecialchars($product['image']) ?>" alt="Product Image" width="50" height="50">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_product.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="delete_product.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


            <nav aria-label="Product pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

        </main>
    </div>
</div>

<?php include 'admin_footer.php'; ?>