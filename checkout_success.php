<?php
session_start();
if (!isset($_SESSION['nik'])) {
    header("Location:login.php");
    exit;
}

$trans_id = $_GET['trans_id'] ?? '';
if(empty($trans_id)) {
    header("Location: index.php");
    exit;
}

$receipt_file = "receipts/receipt_$trans_id.txt";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Success - Clothing Brand</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">CLOTHING BRAND</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="allproduct.php">All Products</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="auth/logout.php">Logout</a>
    </nav>
</header>

<div class="checkout-container">
    <div class="checkout-box" style="text-align: center;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">✅</div>
        <h2 style="color: #28a745; margin-bottom: 1rem;">Payment Successful!</h2>
        
        <p style="font-size: 1.1rem; margin-bottom: 2rem; color: #666;">
            Terima kasih atas pembelian Anda.<br>
            Transaksi Anda telah berhasil diproses.
        </p>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
            <p style="margin-bottom: 0.5rem;"><strong>Transaction ID:</strong></p>
            <p style="font-size: 1.2rem; color: #667eea; font-weight: bold;"><?= $trans_id; ?></p>
        </div>
        
        <?php if(file_exists($receipt_file)): ?>
            <a href="<?= $receipt_file; ?>" download class="btn-submit" style="display: inline-block; text-decoration: none; margin-bottom: 1rem;">
                📄 Download Receipt
            </a>
        <?php endif; ?>
        
        <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 1rem;">
            <a href="dashboard.php" class="btn-shop" style="text-decoration: none;">
                📊 View Dashboard
            </a>
            <a href="allproduct.php" class="btn-shop" style="text-decoration: none; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                🛍️ Continue Shopping
            </a>
        </div>
    </div>
</div>

</body>
</html>