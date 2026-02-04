<?php
require_once '../Classes/product.php';
include '../includes/header.php';

$productId = $_GET['id'] ?? null;
if (!$productId) {
  header('Location: index.php');
  exit;
}

$productObj = new Product();
$product = $productObj->getById($productId);

if (!$product) {
  echo "<div class='container mt-5'><div class='alert alert-danger'>Product not found.</div><a href='index.php' class='btn btn-primary'>Back to Home</a></div>";
  include '../includes/footer.php';
  exit;
}
?>

<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a
          href="index.php?category=<?= $product['category_id'] ?>"><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?></a>
      </li>
      <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['product_name']) ?></li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-6">
      <img src="../Assets/images/<?= htmlspecialchars($product['image'] ?? 'placeholder.jpg') ?>"
        class="img-fluid rounded shadow" alt="<?= htmlspecialchars($product['product_name']) ?>"
        onerror="this.src='https://via.placeholder.com/600x600?text=<?= urlencode($product['product_name']) ?>'">
    </div>
    <div class="col-md-6">
      <h1 class="display-5 fw-bold"><?= htmlspecialchars($product['product_name']) ?></h1>
      <p class="text-success fs-3 fw-bold">$<?= number_format($product['price'], 2) ?></p>
      <hr>
      <p class="lead"><?= nl2br(htmlspecialchars($product['description'])) ?></p>

      <div class="mb-3">
        <strong>Availability:</strong>
        <?php if ($product['stock'] > 0): ?>
          <span class="text-success">In Stock (<?= $product['stock'] ?> available)</span>
        <?php else: ?>
          <span class="text-danger">Out of Stock</span>
        <?php endif; ?>
      </div>

      <?php if ($product['stock'] > 0): ?>
        <form action="add_to_cart.php" method="POST" class="row g-3 align-items-center">
          <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
          <div class="col-auto">
            <label for="quantity" class="col-form-label">Quantity:</label>
          </div>
          <div class="col-auto">
            <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1"
              max="<?= $product['stock'] ?>" style="width: 80px;">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-success btn-lg">
              <i class="fas fa-cart-plus me-2"></i> Add to Cart
            </button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>