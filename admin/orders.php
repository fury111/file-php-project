<?php


include 'admin_header.php';

require_once 'AdminOrder.php'; 


$adminOrder = new AdminOrder();

$orders = $adminOrder->getAllOrders(); 

?>

<div class="container-fluid mt-4">
    <div class="row">
 
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Orders</h1>
            </div>

       
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search orders...">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Statuses</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Shipped</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Users</option>
              
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>
            </div>

      
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No orders found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($order['order_id']) ?></td>
                                    <td><?= htmlspecialchars($order['user_name'] ?? 'N/A') ?></td> 
                                    <td>$<?= number_format(htmlspecialchars($order['total_price']), 2) ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php 
                                            switch ($order['status']) {
                                                case 'pending':
                                                    echo 'bg-warning text-dark';
                                                    break;
                                                case 'approved':
                                                    echo 'bg-info';
                                                    break;
                                                case 'shipped':
                                                    echo 'bg-primary';
                                                    break;
                                                case 'delivered':
                                                    echo 'bg-success';
                                                    break;
                                                case 'cancelled':
                                                    echo 'bg-danger';
                                                    break;
                                                default:
                                                    echo 'bg-secondary';
                                            }
                                            ?>">
                                            <?= htmlspecialchars(ucfirst($order['status'])) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                                    <td>
                                        <a href="view_order.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                                      
                                        <!-- <a href="update_order_status.php?id=<?= $order['order_id'] ?>&status=approved" class="btn btn-sm btn-outline-success">Approve</a> -->
                                        <!-- <a href="update_order_status.php?id=<?= $order['order_id'] ?>&status=shipped" class="btn btn-sm btn-outline-primary">Ship</a> -->
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