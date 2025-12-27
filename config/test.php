<?php
require_once 'database.php';

// If the require_once line executes without an error, the connection was established.
// The $pdo variable is now available from database.php

try {
    // Execute a simple query to test the connection
    $stmt = $pdo->query("SELECT 1"); // This is a simple query that always returns 1
    $result = $stmt->fetch();

    if ($result) {
        echo "<h2>✅ Database Connection Successful!</h2>";
        echo "<p>Connected to database: <strong>" . DB_NAME . "</strong></p>";
        echo "<p>Connected as user: <strong>" . DB_USER . "</strong></p>";
        echo "<p>Host: <strong>" . DB_HOST . "</strong></p>";
    } else {
        echo "<h2>❌ Database Connection Failed!</h2>";
        echo "<p>The query executed but returned no results.</p>";
    }
} catch (PDOException $e) {
    // If any error occurs during the connection or query, catch it here
    echo "<h2>❌ Database Connection Failed!</h2>";
    echo "<p>Error Message: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration in <code>config/database.php</code>.</p>";

    
}

echo password_hash('your_admin_password_here', PASSWORD_DEFAULT);
?>