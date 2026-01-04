<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

$products_file = '../data/products.txt';

// Create file if not exists
if (!file_exists($products_file)) {
    file_put_contents($products_file, '');
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    // Add new product
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];
    
    // Check if product already exists
    $products = [];
    if (file_exists($products_file)) {
        $lines = file($products_file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            if (trim($line)) {
                $parts = explode('|', $line);
                if (count($parts) >= 3 && $parts[0] === $product_name) {
                    header("Location: dashboard.php?error=product_exists");
                    exit;
                }
                $products[] = $line;
            }
        }
    }
    
    // Add new product
    $new_product = "$product_name|$product_price|$product_stock\n";
    file_put_contents($products_file, $new_product, FILE_APPEND);
    
    header("Location: dashboard.php?success=product_added");
    exit;
    
} elseif ($action === 'update') {
    // Update stock
    $product_name = $_POST['product_name'];
    $quantity = intval($_POST['quantity']);
    
    $products = [];
    $updated = false;
    $new_stock = 0;
    
    if (file_exists($products_file)) {
        $lines = file($products_file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            if (trim($line)) {
                $parts = explode('|', $line);
                if (count($parts) >= 3) {
                    if ($parts[0] === $product_name) {
                        // Update this product's stock
                        $current_stock = intval($parts[2]);
                        $new_stock = max(0, $current_stock + $quantity); // Don't allow negative stock
                        $products[] = $parts[0] . '|' . $parts[1] . '|' . $new_stock;
                        $updated = true;
                    } else {
                        $products[] = $line;
                    }
                }
            }
        }
    }
    
    if ($updated) {
        file_put_contents($products_file, implode("\n", $products) . "\n");
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'new_stock' => $new_stock
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
    exit;
    
} elseif ($action === 'delete') {
    // Delete product
    $product_name = $_POST['product_name'];
    
    $products = [];
    if (file_exists($products_file)) {
        $lines = file($products_file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            if (trim($line)) {
                $parts = explode('|', $line);
                if (count($parts) >= 3 && $parts[0] !== $product_name) {
                    $products[] = $line;
                }
            }
        }
    }
    
    file_put_contents($products_file, implode("\n", $products) . "\n");
    
    header("Location: dashboard.php?success=product_deleted");
    exit;
    
} else {
    header("Location: dashboard.php");
    exit;
}