<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle AJAX cart add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data && isset($data['name']) && isset($data['price'])) {
        $_SESSION['cart'][] = $data;
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'cart_count' => count($_SESSION['cart'])]);
        exit;
    }
}

// Handle cart operations
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'remove') {
        $index = $_POST['index'];
        if (isset($_SESSION['cart'][$index])) {
            array_splice($_SESSION['cart'], $index, 1);
            echo json_encode(['success' => true]);
        }
    } elseif ($_POST['action'] === 'clear') {
        $_SESSION['cart'] = [];
        echo json_encode(['success' => true]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart - Clothing Brand</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">CLOTHING BRAND</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="allproduct.php">All Products</a>
        <a href="men.php">Men</a>
        <a href="women.php">Women</a>
        <a href="cart.php">Cart (<?= count($_SESSION['cart']); ?>)</a>
        <?php if(isset($_SESSION['nik'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout (<?= explode(' ', $_SESSION['nama'])[0]; ?>)</a>
        <?php elseif(isset($_SESSION['admin'])): ?>
            <a href="admin_dashboard.php">Admin</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<div class="cart-container">
    <div class="cart-header">
        <h1>🛒 Shopping Cart</h1>
    </div>
    
    <?php if(empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
            <div style="font-size: 5rem; margin-bottom: 1rem;">🛍️</div>
            <h2>Keranjang Anda Kosong</h2>
            <p style="color: #999; margin-bottom: 2rem;">Belum ada produk di keranjang belanja</p>
            <a href="allproduct.php" class="btn-shop">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <div class="cart-items">
            <?php 
            $total = 0;
            foreach ($_SESSION['cart'] as $index => $item): 
                $total += $item['price'];
            ?>
                <div class="cart-item" id="item-<?= $index; ?>">
                    <div class="item-details">
                        <div class="item-name">
                            <strong><?= htmlspecialchars($item['name']); ?></strong>
                        </div>
                    </div>
                    <div class="item-price">Rp <?= number_format($item['price'], 0, ',', '.'); ?></div>
                    <button class="btn-remove" onclick="removeItem(<?= $index; ?>)">
                        🗑️ Hapus
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="cart-summary">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 1.1rem;">Subtotal (<?= count($_SESSION['cart']); ?> item)</span>
                <span style="font-size: 1.1rem; font-weight: bold;">Rp <?= number_format($total, 0, ',', '.'); ?></span>
            </div>
            
            <div class="cart-total">
                Total: <span>Rp <?= number_format($total, 0, ',', '.'); ?></span>
            </div>
            
            <?php if(isset($_SESSION['nik'])): ?>
                <button class="btn-checkout" onclick="window.location.href='checkout.php'">
                    💳 Proceed to Checkout
                </button>
            <?php else: ?>
                <p style="color: #999; margin-bottom: 1rem; text-align: center;">
                    ⚠️ Silakan login untuk melanjutkan checkout
                </p>
                <button class="btn-checkout" onclick="window.location.href='login.php'">
                    🔐 Login untuk Checkout
                </button>
            <?php endif; ?>
            
            <button class="btn-shop" onclick="window.location.href='allproduct.php'" 
                    style="width: 100%; margin-top: 1rem; background: #fff; color: #667eea; border: 2px solid #667eea;">
                ← Lanjut Belanja
            </button>
        </div>
    <?php endif; ?>
</div>

<script>
function removeItem(index) {
    if(confirm('Hapus item ini dari keranjang?')) {
        const item = document.getElementById('item-' + index);
        item.style.opacity = '0.5';
        
        fetch('cart.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=remove&index=' + index
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menghapus item');
            item.style.opacity = '1';
        });
    }
}
</script>

</body>
</html>