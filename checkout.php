<?php
session_start();
if (!isset($_SESSION['nik'])) {
    header("Location:login.php");
    exit;
}

if(empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Process checkout
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    
    // Calculate total
    $total = 0;
    foreach($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
    
    // Generate transaction ID
    $trans_id = 'TRX' . date('YmdHis') . rand(100, 999);
    
    // Save transaction
    $trans_file = 'data/transactions.txt';
    $trans_data = $trans_id . '|' . 
                  $_SESSION['nik'] . '|' . 
                  $_SESSION['nama'] . '|' . 
                  $total . '|' . 
                  $payment_method . '|' . 
                  count($_SESSION['cart']) . '|' . 
                  date('Y-m-d H:i:s') . "\n";
    file_put_contents($trans_file, $trans_data, FILE_APPEND);
    
    // Save transaction details
    $detail_file = 'data/transaction_details.txt';
    foreach($_SESSION['cart'] as $item) {
        $detail_data = $trans_id . '|' . 
                      $item['name'] . '|' . 
                      $item['price'] . '|' . 
                      date('Y-m-d H:i:s') . "\n";
        file_put_contents($detail_file, $detail_data, FILE_APPEND);
    }
    
    // Generate receipt
    $receipt = "
================================================================================
                            CLOTHING BRAND
                       Premium Fashion Store
================================================================================

STRUK PEMBAYARAN

ID Transaksi   : $trans_id
Tanggal        : " . date('d/m/Y H:i:s') . "
Kasir          : SYSTEM

--------------------------------------------------------------------------------
CUSTOMER INFORMATION
--------------------------------------------------------------------------------
Nama           : " . $_SESSION['nama'] . "
NIK            : " . $_SESSION['nik'] . "

--------------------------------------------------------------------------------
DETAIL PEMBELIAN
--------------------------------------------------------------------------------
";
    
    foreach($_SESSION['cart'] as $item) {
        $receipt .= sprintf("%-50s Rp %12s\n", 
            $item['name'], 
            number_format($item['price'], 0, ',', '.'));
    }
    
    $receipt .= "
--------------------------------------------------------------------------------
TOTAL          : Rp " . number_format($total, 0, ',', '.') . "
METODE BAYAR   : $payment_method
--------------------------------------------------------------------------------

Terima kasih atas pembelian Anda!
Simpan struk ini sebagai bukti pembayaran yang sah.

================================================================================
";
    
    // Save receipt to file
    if(!is_dir('receipts')) {
        mkdir('receipts', 0777, true);
    }
    file_put_contents("receipts/receipt_$trans_id.txt", $receipt);
    
    // Clear cart
    $_SESSION['cart'] = [];
    
    // Redirect to success page
    header("Location: checkout_success.php?trans_id=$trans_id");
    exit;
}

// Calculate total
$total = 0;
foreach($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Clothing Brand</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">CLOTHING BRAND</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="allproduct.php">All Products</a>
        <a href="cart.php">Cart</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="checkout-container">
    <div class="checkout-box">
        <h2>💳 Checkout</h2>
        
        <div class="customer-info" style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem;">Customer Information</h3>
            <p><strong>Nama:</strong> <?= $_SESSION['nama']; ?></p>
            <p><strong>NIK:</strong> <?= $_SESSION['nik']; ?></p>
        </div>
        
        <div class="order-summary">
            <h3 style="margin-bottom: 1rem;">Order Summary</h3>
            <?php foreach($_SESSION['cart'] as $item): ?>
                <div class="summary-item">
                    <span><?= htmlspecialchars($item['name']); ?></span>
                    <span style="font-weight: bold; color: #667eea;">Rp <?= number_format($item['price'], 0, ',', '.'); ?></span>
                </div>
            <?php endforeach; ?>
            
            <div class="summary-total" style="border-top: 2px solid #667eea; padding-top: 1rem; margin-top: 1rem;">
                <span>Total:</span>
                <span style="color: #667eea;">Rp <?= number_format($total, 0, ',', '.'); ?></span>
            </div>
        </div>
        
        <form method="POST" style="margin-top: 2rem;">
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="payment_method" required style="width: 100%; padding: 0.8rem; border: 2px solid #e0e0e0; border-radius: 10px;">
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            
            <button type="submit" class="btn-submit">Process Payment</button>
        </form>
    </div>
</div>

</body>
</html>