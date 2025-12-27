<?php


include 'admin_header.php';

// Include the AdminReview class
require_once 'AdminReview.php'; // Adjust path if necessary

// Create an instance of the AdminReview class
$adminReview = new AdminReview();

// Fetch all reviews from the database
$reviews = $adminReview->getAllReviews(); // This method needs to be implemented in AdminReview.php

?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Reviews</h1>
            </div>

            <!-- Reviews Table -->
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
                            <!-- Removed Status column -->
                            <th>Actions</th>
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
                                            // Generate star rating display
                                            $rating = (int)$review['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '★'; // Filled star
                                                } else {
                                                    echo '☆'; // Empty star
                                                }
                                            }
                                            ?>
                                        </span> (<?= $rating ?>)
                                    </td>
                                    <td><?= htmlspecialchars($review['comment']) ?></td>
                                    <td><?= htmlspecialchars($review['created_at']) ?></td>
                                    <td>
                                        <a href="edit_review.php?id=<?= $review['review_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <!-- Example action links (you'd need corresponding PHP scripts) -->
                                        <a href="delete_review.php?id=<?= $review['review_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
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