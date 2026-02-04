<?php
require_once 'Database.php';

class Product
{
    private $db;
    private $table = 'ee_commerce_products';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllFeatured($limit = 6)
    {
        $sql = "SELECT * FROM {$this->table} LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory($category_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT p.*, c.category_name 
                FROM {$this->table} p 
                LEFT JOIN ee_commerce_categories c ON p.category_id = c.category_id 
                WHERE p.product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function search($query)
    {
        $sql = "SELECT * FROM {$this->table} WHERE product_name LIKE ? OR description LIKE ?";
        $stmt = $this->db->prepare($sql);
        $searchQuery = "%$query%";
        $stmt->execute([$searchQuery, $searchQuery]);
        return $stmt->fetchAll();
    }
}
?>