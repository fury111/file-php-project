<?php


include 'admin_header.php';

require_once 'AdminReview.php'; 

$adminReview = new AdminReview();

$reviews = $adminReview->getAllReviews(); 

?>

<div class="container-fluid mt-4">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Reviews</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reviews)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No reviews found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?= htmlspecialchars($review['review_id']) ?></td>
                                    <td><?= htmlspecialchars($review['product_name']) ?></td>
                                    <td><?= htmlspecialchars($review['user_name']) ?></td>
                                    <td>
                                        <span class="text-warning">
                                            <?php
                                            $rating = (int)$review['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '★';
                                                } else {
                                                    echo '☆'; 
                                                }
                                            }
                                            ?>
                                        </span> (<?= $rating ?>)
                                    </td>
                                    <td><?= htmlspecialchars($review['comment']) ?></td>
                                    <td><?= htmlspecialchars($review['created_at']) ?></td>
                              
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