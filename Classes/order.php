<?php
require_once 'Database.php';

class Order
{
    private $db;
    private $table = 'ee_commerce_orders';
    private $itemsTable = 'ee_commerce_order_items';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($userId, $totalPrice, $cartItems)
    {
        try {
            $this->db->beginTransaction();

            // Insert into orders table
            $sql = "INSERT INTO {$this->table} (user_id, total_price, status) VALUES (?, ?, 'pending')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $totalPrice]);
            $orderId = $this->db->lastInsertId();

            // Insert into order_items table
            $sqlItems = "INSERT INTO {$this->itemsTable} (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmtItems = $this->db->prepare($sqlItems);

            foreach ($cartItems as $productId => $quantity) {
                // Fetch current price
                $stmtProduct = $this->db->prepare("SELECT price FROM ee_commerce_products WHERE product_id = ?");
                $stmtProduct->execute([$productId]);
                $price = $stmtProduct->fetchColumn();

                $stmtItems->execute([$orderId, $productId, $quantity, $price]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getDetails($orderId)
    {
        $sql = "SELECT oi.*, p.product_name, p.image 
                FROM {$this->itemsTable} oi 
                JOIN ee_commerce_products p ON oi.product_id = p.product_id 
                WHERE oi.order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }
}
?>