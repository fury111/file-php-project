<?php

require_once '../Classes/Database.php';

class AdminProduct
{
    private $pdo;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }


    public function getProductById($productId)
    {
        $sql = "SELECT product_id, product_name, description, price, stock, image, created_at, updated_at, category_id FROM ee_commerce_products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllProducts()
    {

        $sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.stock, p.image, p.created_at, p.updated_at, c.category_name FROM ee_commerce_products p LEFT JOIN ee_commerce_categories c ON p.category_id = c.category_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createProduct($name, $description, $price, $stock, $imagePath, $categoryId)
    {

        $sql = "INSERT INTO ee_commerce_products (product_name, description, price, stock, image, category_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $description, $price, $stock, $imagePath, $categoryId]);
        return $this->pdo->lastInsertId();
    }


    public function updateProduct($productId, $name, $description, $price, $stock, $imagePath, $categoryId)
    {

        if ($imagePath) {

            $sql = "UPDATE ee_commerce_products SET product_name = ?, description = ?, price = ?, stock = ?, image = ?, category_id = ?, updated_at = NOW() WHERE product_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $description, $price, $stock, $imagePath, $categoryId, $productId]);
        } else {

            $sql = "UPDATE ee_commerce_products SET product_name = ?, description = ?, price = ?, stock = ?, category_id = ?, updated_at = NOW() WHERE product_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $description, $price, $stock, $categoryId, $productId]);
        }
        return $stmt->rowCount() > 0;
    }


    public function deleteProduct($productId)
    {

        $sql = "DELETE FROM ee_commerce_products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->rowCount() > 0;
    }
}
?>