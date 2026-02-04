<?php

class Cart
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function add($productId, $quantity = 1)
    {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function remove($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function update($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($productId);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function getItems()
    {
        return $_SESSION['cart'];
    }

    public function clear()
    {
        $_SESSION['cart'] = [];
    }

    public function getCount()
    {
        return count($_SESSION['cart']);
    }

    public function getTotalQuantity()
    {
        return array_sum($_SESSION['cart']);
    }
}
?>