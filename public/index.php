<?php include '../includes/header.php'; ?>

<!-- Hero Section -->
<section class="bg-primary text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="display-4 fw-bold">Shop the Latest Trends</h1>
        <p class="lead">Discover amazing products at unbeatable prices. Free shipping on orders over $50!</p>
        <a href="index.php" class="btn btn-light btn-lg">Shop Now</a>
      </div>
      <div class="col-lg-6 text-center">
        <img src="assets/images/hero_banner.png" alt="Hero Banner" class="img-fluid rounded shadow">
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
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row">
      <!-- Product 1 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="assets/images/product1.jpg" class="card-img-top" alt="Product 1" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Wireless Headphones</h5>
            <p class="text-muted">Noise-cancelling, 30h battery</p>
            <div class="mt-auto">
              <p class="card-text text-success fs-5 fw-bold">$79.99</p>
              <a href="product_details.php?id=1" class="btn btn-primary w-100">View Details</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Product 2 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="assets/images/product2.jpg" class="card-img-top" alt="Product 2" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Smart Watch</h5>
            <p class="text-muted">Fitness tracker, heart rate monitor</p>
            <div class="mt-auto">
              <p class="card-text text-success fs-5 fw-bold">$129.99</p>
              <a href="product_details.php?id=2" class="btn btn-primary w-100">View Details</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="assets/images/product3.jpg" class="card-img-top" alt="Product 3" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Bluetooth Speaker</h5>
            <p class="text-muted">360° sound, waterproof</p>
            <div class="mt-auto">
              <p class="card-text text-success fs-5 fw-bold">$59.99</p>
              <a href="product_details.php?id=3" class="btn btn-primary w-100">View Details</a>
            </div>
          </div>
        </div>
      </div>
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
      <div class="col-md-3 mb-3">
        <a href="#" class="text-decoration-none">
          <div class="card border-0">
            <img src="assets/images/cat_electronics.jpg" class="card-img-top" alt="Electronics" style="height: 150px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Electronics</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-3">
        <a href="#" class="text-decoration-none">
          <div class="card border-0">
            <img src="assets/images/cat_fashion.jpg" class="card-img-top" alt="Fashion" style="height: 150px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Fashion</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-3">
        <a href="#" class="text-decoration-none">
          <div class="card border-0">
            <img src="assets/images/cat_home.jpg" class="card-img-top" alt="Home & Garden" style="height: 150px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Home & Garden</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-3">
        <a href="#" class="text-decoration-none">
          <div class="card border-0">
            <img src="assets/images/cat_books.jpg" class="card-img-top" alt="Books" style="height: 150px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Books</h5>
            </div>
          </div>
        </a>
      </div>
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