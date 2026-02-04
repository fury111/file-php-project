<?php
require_once '../Classes/product.php';
require_once '../Classes/category.php';
include '../includes/header.php';

$productObj = new Product();
$categoryObj = new Category();

$search = $_GET['search'] ?? '';
$categoryFilter = $_GET['category'] ?? 'all';

if ($categoryFilter !== 'all') {
  $products = $productObj->getByCategory($categoryFilter);
} elseif (!empty($search)) {
  $products = $productObj->search($search);
} else {
  $products = $productObj->getAllFeatured(9);
}

$allCategories = $categoryObj->getAll();
?>

<!-- Hero Section -->
<section class="bg-primary text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="display-4 fw-bold">Shop the Latest Trends</h1>
        <p class="lead">Discover amazing products at unbeatable prices. Free shipping on orders over $50!</p>
        <a href="#featured" class="btn btn-light btn-lg">Shop Now</a>
      </div>
      <div class="col-lg-6 text-center">
        <img src="../Assets/images/hero_banner.png" alt="Hero Banner" class="img-fluid rounded shadow"
          onerror="this.src='https://via.placeholder.com/600x400?text=Shop+Now'">
      </div>
    </div>
  </div>
</section>

<!-- Promo Banner -->
<section class="py-4 bg-warning">
  <div class="container text-center">
    <h4 class="mb-0"><i class="fas fa-gift"></i> Limited Time Offer: 20% Off All Electronics!</h4>
  </div>
</section>

<!-- Featured Products -->
<section id="featured" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">
      <?php if (!empty($search)): ?>
        Search Results for "<?= htmlspecialchars($search) ?>"
      <?php elseif ($categoryFilter !== 'all'): ?>
        Products in Category
      <?php else: ?>
        Featured Products
      <?php endif; ?>
    </h2>
    <div class="row">
      <?php if (empty($products)): ?>
        <div class="col-12 text-center">
          <p class="lead">No products found.</p>
          <a href="index.php" class="btn btn-primary">View All Products</a>
        </div>
      <?php else: ?>
        <?php foreach ($products as $product): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <img src="../Assets/images/<?= htmlspecialchars($product['image'] ?? 'placeholder.jpg') ?>"
                class="card-img-top" alt="<?= htmlspecialchars($product['product_name']) ?>"
                style="height: 250px; object-fit: cover;"
                onerror="this.src='https://via.placeholder.com/400x300?text=<?= urlencode($product['product_name']) ?>'">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                <p class="text-muted text-truncate"><?= htmlspecialchars($product['description']) ?></p>
                <div class="mt-auto">
                  <p class="card-text text-success fs-5 fw-bold">$<?= number_format($product['price'], 2) ?></p>
                  <div class="d-flex gap-2">
                    <a href="product_details.php?id=<?= $product['product_id'] ?>"
                      class="btn btn-outline-primary flex-grow-1">Details</a>
                    <form action="add_to_cart.php" method="POST" class="flex-grow-1">
                      <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                      <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Discount Section -->
<section class="py-5">
  <div class="container">
    <div class="bg-danger text-white p-5 rounded text-center">
      <h2 class="display-5 fw-bold">Flash Sale!</h2>
      <p class="lead">Up to 50% off on selected items. Limited time only.</p>
      <a href="index.php" class="btn btn-light btn-lg">Shop Deals</a>
    </div>
  </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Shop by Category</h2>
    <div class="row text-center">
      <?php foreach ($allCategories as $cat): ?>
        <div class="col-md-3 mb-3">
          <a href="index.php?category=<?= $cat['category_id'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <i class="fas fa-tag fa-3x mb-3 text-primary"></i>
                <h5 class="card-title text-dark"><?= htmlspecialchars($cat['category_name']) ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">What Our Customers Say</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Fast shipping and great quality. Will shop here again!"</p>
            <small class="text-muted">— John D.</small>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Amazing deals and excellent customer service."</p>
            <small class="text-muted">— Sarah M.</small>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Easy to navigate and secure checkout process."</p>
            <small class="text-muted">— Mike L.</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>