<?php

require_once '../Classes/Database.php';

class AdminReview {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }

 
    public function getAllReviews() {
      
        $sql = "SELECT r.review_id, r.rating, r.comment, r.created_at, p.product_name, CONCAT(u.first_name, ' ', u.last_name) AS user_name FROM reviews r LEFT JOIN products p ON r.product_id = p.product_id LEFT JOIN users u ON r.user_id = u.user_id ORDER BY r.created_at DESC"; // Order by date as preferred
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

  
    public function getReviewById($reviewId) {
        $sql = "SELECT review_id, user_id, product_id, rating, comment, created_at FROM reviews WHERE review_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function updateReview($reviewId, $rating, $comment) {
        $sql = "UPDATE reviews SET rating = ?, comment = ? WHERE review_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rating, $comment, $reviewId]);
        return $stmt->rowCount() > 0;
    }


    public function deleteReview($reviewId) {

        $sql = "DELETE FROM reviews WHERE review_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$reviewId]);
        return $stmt->rowCount() > 0; 
    }

}

?>