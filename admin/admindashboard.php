<?php

require_once '../Classes/Database.php'; 

class AdminDashboard {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }

    public function getDashboardStats() {
        $stats = [
            'total_income' => 0.0,
            'total_orders' => 0,
            'total_customers' => 0, 
            'total_categories' => 0
        ];

        $sqlIncome = "SELECT SUM(total_price) as total FROM orders WHERE status = 'delivered'";
        $stmtIncome = $this->pdo->prepare($sqlIncome);
        $stmtIncome->execute();
        $incomeResult = $stmtIncome->fetch(PDO::FETCH_ASSOC);
        $stats['total_income'] = $incomeResult['total'] ?? 0.0;

        $sqlOrders = "SELECT COUNT(*) as count FROM orders WHERE status = 'delivered'";
        $stmtOrders = $this->pdo->prepare($sqlOrders);
        $stmtOrders->execute();
        $ordersResult = $stmtOrders->fetch(PDO::FETCH_ASSOC);
        $stats['total_orders'] = $ordersResult['count'] ?? 0;


        $sqlCustomers = "SELECT COUNT(DISTINCT user_id) as count FROM orders WHERE status = 'delivered'"; 
        $stmtCustomers->execute();
        $customersResult = $stmtCustomers->fetch(PDO::FETCH_ASSOC);
        $stats['total_customers'] = $customersResult['count'] ?? 0;

        $sqlCategories = "SELECT COUNT(*) as count FROM categories";
        $stmtCategories = $this->pdo->prepare($sqlCategories);
        $stmtCategories->execute();
        $categoriesResult = $stmtCategories->fetch(PDO::FETCH_ASSOC);
        $stats['total_categories'] = $categoriesResult['count'] ?? 0;

        return $stats;
    }


    public function getDailyRevenue() {
        $sql = "SELECT DATE(created_at) as date, SUM(total_price) as revenue, COUNT(*) as orders FROM orders WHERE status = 'delivered' GROUP BY DATE(created_at) ORDER BY date DESC LIMIT 7"; // Last 7 days
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>