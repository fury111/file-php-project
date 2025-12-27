<?php

require_once '../Classes/Database.php'; 

class AdminUser {
    private $pdo;

    public function __construct() {
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }

 
    public function getAllUsers() {
        $sql = "SELECT user_id, first_name, last_name, email, role, created_at FROM users ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function getUserById($userId) {
        $sql = "SELECT user_id, first_name, last_name, email, location, role, created_at FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

  
    public function updateUser($userId, $firstName, $lastName, $email, $location, $role) {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, location = ?, role = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email, $location, $role, $userId]);
        return $stmt->rowCount() > 0; 
    }

   
    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->rowCount() > 0; 
    }

   
}

?>