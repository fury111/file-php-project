<?php
require_once 'Database.php';

class User
{
    private $db;
    private $table = 'ee_commerce_users';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register($first_name, $last_name, $email, $password, $location = '')
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, password, location) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$first_name, $last_name, $email, $hashed_password, $location]);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getById($id)
    {
        $sql = "SELECT user_id, first_name, last_name, email, location, role, created_at FROM {$this->table} WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
?>