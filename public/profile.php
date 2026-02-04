<?php
require_once '../Classes/order.php';
include '../includes/header.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$orderObj = new Order();
$orders = $orderObj->getByUserId($currentUser['user_id']);

$successOrder = $_GET['order_success'] ?? null;
?>

<div class="container mt-4">
    <?php if ($successOrder): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Order placed successfully!</strong> Your order ID is #<?= htmlspecialchars($successOrder) ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white text-center py-4">
                    <i class="fas fa-user-circle fa-4x mb-3"></i>
                    <h4><?= htmlspecialchars($currentUser['first_name'] . ' ' . $currentUser['last_name']) ?></h4>
                    <p class="mb-0"><?= htmlspecialchars($currentUser['email']) ?></p>
                </div>
                <div class="card-body">
                    <p><strong>Location:</strong> <?= htmlspecialchars($currentUser['location'] ?: 'Not set') ?></p>
                    <p><strong>Role:</strong> <?= ucfirst(htmlspecialchars($currentUser['role'])) ?></p>
                    <hr>
                    <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h3>Your Order History</h3>
            <?php if (empty($orders)): ?>
                <div class="alert alert-light border">
                    <p class="mb-0">You haven't placed any orders yet.</p>
                </div>
                <a href="index.php" class="btn btn-primary">Start Shopping</a>
            <?php else: ?>
                <div class="accordion shadow-sm" id="orderAccordion">
                    <?php foreach ($orders as $index => $order): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $order['order_id'] ?>">
                                <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse<?= $order['order_id'] ?>"
                                    aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                                    aria-controls="collapse<?= $order['order_id'] ?>">
                                    <div class="d-flex justify-content-between w-100 me-3">
                                        <span>Order #<?= $order['order_id'] ?> -
                                            <?= date('M d, Y', strtotime($order['created_at'])) ?></span>
                                        <span class="badge bg-<?php
                                        echo match ($order['status']) {
                                            'pending' => 'warning',
                                            'approved', 'shipped' => 'primary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger',
                                            default => 'secondary'
                                        };
                                        ?>"><?= ucfirst($order['status']) ?></span>
                                        <span class="ms-auto fw-bold">$<?= number_format($order['total_price'], 2) ?></span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $order['order_id'] ?>"
                                class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                                aria-labelledby="heading<?= $order['order_id'] ?>" data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    <?php
                                    $orderDetails = $orderObj->getDetails($order['order_id']);
                                    ?>
                                    <table class="table table-sm table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderDetails as $item): ?>
                                                <tr>
                                                    <td>
                                                        <img src="../Assets/images/<?= htmlspecialchars($item['image'] ?? 'placeholder.jpg') ?>"
                                                            style="width: 30px; height: 30px; object-fit: cover;" class="me-2"
                                                            onerror="this.src='https://via.placeholder.com/30px30?text=P'">
                                                        <?= htmlspecialchars($item['product_name']) ?>
                                                    </td>
                                                    <td class="text-center"><?= $item['quantity'] ?></td>
                                                    <td class="text-end">$<?= number_format($item['price'], 2) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot class="border-top">
                                            <tr>
                                                <th colspan="2" class="text-end">Shipping (Flat Rate):</th>
                                                <td class="text-end">$5.00</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-end">Total:</th>
                                                <th class="text-end">$<?= number_format($order['total_price'], 2) ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>