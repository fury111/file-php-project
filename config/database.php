<?php
// Database configuration
define('DB_HOST', 'localhost'); // Usually localhost
define('DB_NAME', 'ee_commerce'); // Your database name
define('DB_USER', 'root');        // Your MySQL username (often 'root' for XAMPP)
define('DB_PASS', '');            // Your MySQL password (often empty for XAMPP)

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>