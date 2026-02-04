<?php
require_once '../Classes/product.php';
include '../includes/header.php';

$productObj = new Product();
$cartItems = [];
$total = 0;

$itemsInCart = $cart->getItems(); // $cart is defined in header.php

if (!empty($itemsInCart)) {
    foreach ($itemsInCart as $productId => $quantity) {
        $product = $productObj->getById($productId);
        if ($product) {
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
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
}
?>

<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">
            <p class="mb-0">Your cart is empty.</p>
        </div>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../Assets/images/<?= htmlspecialchars($item['image'] ?? 'placeholder.jpg') ?>"
                                        class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;"
                                        onerror="this.src='https://via.placeholder.com/50x50?text=Product'">
                                    <span><?= htmlspecialchars($item['name']) ?></span>
                                </div>
                            </td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>
                                <form action="update_cart.php" method="POST" class="d-flex align-items-center">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                                        class="form-control form-control-sm" style="width: 60px;" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>$<?= number_format($item['subtotal'], 2) ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end py-3">Grand Total:</th>
                        <th class="py-3 text-success fs-5">$<?= number_format($total, 2) ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
            <?php if ($isLoggedIn): ?>
                <a href="checkout.php" class="btn btn-success btn-lg">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>
            <?php else: ?>
                <div class="text-end">
                    <p class="text-muted small mb-2">Please log in to complete your purchase.</p>
                    <a href="login.php?redirect=checkout.php" class="btn btn-primary">
                        Log In to Checkout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>