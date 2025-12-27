<?php

require_once '../Classes/Database.php'; 

class AdminDashboard {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }

    /**
     * Get dashboard summary statistics (only for completed orders)
     */
    public function getDashboardStats() {
        $stats = [
            'total_income' => 0.0,
            'total_orders' => 0,
            'total_customers' => 0, // This still counts unique customers who have *any* order
            'total_categories' => 0
        ];

        // Total Income (from completed orders only)
        $sqlIncome = "SELECT SUM(total_price) as total FROM orders WHERE status = 'delivered'";
        $stmtIncome = $this->pdo->prepare($sqlIncome);
        $stmtIncome->execute();
        $incomeResult = $stmtIncome->fetch(PDO::FETCH_ASSOC);
        $stats['total_income'] = $incomeResult['total'] ?? 0.0;

        // Total Completed Orders
        $sqlOrders = "SELECT COUNT(*) as count FROM orders WHERE status = 'delivered'";
        $stmtOrders = $this->pdo->prepare($sqlOrders);
        $stmtOrders->execute();
        $ordersResult = $stmtOrders->fetch(PDO::FETCH_ASSOC);
        $stats['total_orders'] = $ordersResult['count'] ?? 0;

        // Total Customers (Users who have *any* order) - This remains unchanged
        // If you want only customers with *completed* orders, change the WHERE clause
        $sqlCustomers = "SELECT COUNT(DISTINCT user_id) as count FROM orders WHERE status = 'delivered'"; // Changed to count customers with delivered orders
        $stmtCustomers = $this->pdo->prepare($sqlCustomers);
        $stmtCustomers->execute();
        $customersResult = $stmtCustomers->fetch(PDO::FETCH_ASSOC);
        $stats['total_customers'] = $customersResult['count'] ?? 0;

        // Total Categories (Unchanged)
        $sqlCategories = "SELECT COUNT(*) as count FROM categories";
        $stmtCategories = $this->pdo->prepare($sqlCategories);
        $stmtCategories->execute();
        $categoriesResult = $stmtCategories->fetch(PDO::FETCH_ASSOC);
        $stats['total_categories'] = $categoriesResult['count'] ?? 0;

        return $stats;
    }

    /**
     * Get daily revenue data (only from completed orders)
     */
    public function getDailyRevenue() {
        // Changed to only include orders with status 'delivered'
        $sql = "SELECT DATE(created_at) as date, SUM(total_price) as revenue, COUNT(*) as orders FROM orders WHERE status = 'delivered' GROUP BY DATE(created_at) ORDER BY date DESC LIMIT 7"; // Last 7 days
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>