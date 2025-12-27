<?php

require_once '../Classes/Database.php'; 

class AdminOrder {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }


    public function getAllOrders() {
  
        $sql = "SELECT o.order_id, o.total_price, o.status, o.created_at, CONCAT(u.first_name, ' ', u.last_name) AS user_name FROM orders o LEFT JOIN users u ON o.user_id = u.user_id ORDER BY o.created_at DESC"; // Order by date as preferred
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

 
    public function getOrderById($orderId) {
      
        $sql = "SELECT order_id, user_id, total_price, status, created_at FROM orders WHERE order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateOrderStatus($orderId, $newStatus) {
        // Changed table name from 'ee_commerce_orders' to 'orders'
        $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$newStatus, $orderId]);
        return $stmt->rowCount() > 0; // Returns true if update was successful

}
}
?>