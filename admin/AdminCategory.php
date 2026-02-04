<?php

require_once '../Classes/Database.php';

class AdminCategory
{
    private $pdo;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }


    public function getCategoryById($categoryId)
    {
        $sql = "SELECT category_id, category_name, description, created_at FROM ee_commerce_categories WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllCategories()
    {

        $sql = "SELECT category_id, category_name, description, created_at FROM ee_commerce_categories ORDER BY category_name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createCategory($name, $description)
    {

        $sql = "INSERT INTO ee_commerce_categories (category_name, description, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $description]);
        return $this->pdo->lastInsertId();
    }


    public function updateCategory($categoryId, $name, $description)
    {

        $sql = "UPDATE ee_commerce_categories SET category_name = ?, description = ? WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $description, $categoryId]);
        return $stmt->rowCount() > 0;
    }


    public function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM ee_commerce_categories WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->rowCount() > 0;
    }

}
?>