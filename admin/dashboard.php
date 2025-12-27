<?php


include 'admin_header.php';

require_once '../Classes/Database.php';
require_once 'AdminDashboard.php'; 

$adminDashboard = new AdminDashboard();

$stats = $adminDashboard->getDashboardStats(); 


$dailyRevenue = $adminDashboard->getDailyRevenue(); 

?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL INCOME</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($stats['total_income'], 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ORDERS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['total_orders'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">CUSTOMERS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['total_customers'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">CATEGORIES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['total_categories'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4>Daily Revenue</h4>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Revenue</th>
                    <th>Orders</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dailyRevenue)): ?>
                    <tr>
                        <td colspan="3" class="text-center">No revenue data available.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dailyRevenue as $revenue): ?>
                        <tr>
                            <td><?= htmlspecialchars($revenue['date']) ?></td>
                            <td>$<?= number_format(htmlspecialchars($revenue['revenue']), 2) ?></td>
                            <td><?= htmlspecialchars($revenue['orders']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'admin_footer.php'; ?>