<?php
require_once '../Classes/product.php';
require_once '../Classes/Cart.php';
include '../includes/header.php';

if (!isLoggedIn()) {
    header('Location: login.php?redirect=checkout.php');
    exit;
}

$productObj = new Product();
$currentUser = getCurrentUser();

$cartItems = [];
$cartTotal = 0;
$itemsInCart = $cart->getItems();

if (empty($itemsInCart)) {
    header('Location: Cart.php');
    exit;
}

foreach ($itemsInCart as $productId => $quantity) {
    $product = $productObj->getById($productId);
    if ($product) {
        $subtotal = $product['price'] * $quantity;
        $cartTotal += $subtotal;
        $cartItems[] = [
            'id' => $productId,
            'name' => $product['product_name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'image' => $product['image']
        ];
    }
}

$shippingCost = 5.00;
$totalAmount = $cartTotal + $shippingCost;
?>

<div class="container mt-4">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <!-- Order Summary (Left Column) -->
        <div class="col-lg-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td style="width: 15%;">
                                        <img src="../Assets/images/<?= htmlspecialchars($item['image'] ?? 'placeholder.jpg') ?>"
                                            class="img-thumbnail" alt="<?= htmlspecialchars($item['name']) ?>"
                                            style="width: 60px; height: 60px; object-fit: cover;"
                                            onerror="this.src='https://via.placeholder.com/60px60?text=Product'">
                                    </td>
                                    <td>
                                        <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                        <small class="text-muted">Qty: <?= $item['quantity'] ?> @
                                            $<?= number_format($item['price'], 2) ?></small>
                                    </td>
                                    <td class="text-end">
                                        $<?= number_format($item['subtotal'], 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>$<?= number_format($cartTotal, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping Cost:</span>
                            <span>$<?= number_format($shippingCost, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                            <h5 class="fw-bold">Total:</h5>
                            <h5 class="text-success fw-bold">$<?= number_format($totalAmount, 2) ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <a href="Cart.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Cart</a>
        </div>

        <!-- Payment & Shipping Info (Right Column) -->
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Shipping & Payment</h4>
                </div>
                <div class="card-body">
                    <form action="process_order.php" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="full_name"
                                value="<?= htmlspecialchars($currentUser['first_name'] . ' ' . $currentUser['last_name']) ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= htmlspecialchars($currentUser['email']) ?>" required readonly>
                        </div>

                        <h5 class="mt-4 mb-3 border-bottom pb-2">Shipping Address</h5>
                        <div class="mb-3">
                            <label for="address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?= htmlspecialchars($currentUser['location']) ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zip" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" id="zip" name="zip_code" required>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3 border-bottom pb-2">Payment Method</h5>
                        <div class="mb-3">
                            <select class="form-select" id="paymentMethod" name="payment_method" required>
                                <option value="">Choose payment method...</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="cod">Cash on Delivery</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100 btn-lg mt-3">
                            Place Order ($<?= number_format($totalAmount, 2) ?>)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>