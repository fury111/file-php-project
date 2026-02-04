-- Database setup for E-commerce Project
CREATE DATABASE IF NOT EXISTS ee_commerce;
USE ee_commerce;

-- Users Table
CREATE TABLE IF NOT EXISTS ee_commerce_users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE IF NOT EXISTS ee_commerce_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS ee_commerce_products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES ee_commerce_categories(category_id) ON DELETE SET NULL
);

-- Shopping Cart Table
CREATE TABLE IF NOT EXISTS ee_commerce_cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES ee_commerce_users(user_id) ON DELETE CASCADE
);

-- Cart Items Table
CREATE TABLE IF NOT EXISTS ee_commerce_cart_items (
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL,
    product_id INT NOT NULL,
    cart_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES ee_commerce_products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (cart_id) REFERENCES ee_commerce_cart(cart_id) ON DELETE CASCADE
);

-- Orders Table
CREATE TABLE IF NOT EXISTS ee_commerce_orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'approved', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES ee_commerce_users(user_id) ON DELETE CASCADE
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS ee_commerce_order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES ee_commerce_orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES ee_commerce_products(product_id) ON DELETE SET NULL
);

-- Payments Table
CREATE TABLE IF NOT EXISTS ee_commerce_payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES ee_commerce_orders(order_id) ON DELETE CASCADE
);

-- Reviews Table
CREATE TABLE IF NOT EXISTS ee_commerce_reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES ee_commerce_products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES ee_commerce_users(user_id) ON DELETE CASCADE
);
