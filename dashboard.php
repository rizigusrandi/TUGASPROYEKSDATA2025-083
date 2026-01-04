<?php
session_start();
if (!isset($_SESSION['nik'])) {
    header("Location: login.php");
    exit;
}

$nik = $_SESSION['nik'];
$nama = $_SESSION['nama'];

// Get customer transactions
$transactions = [];
$trans_file = 'data/transactions.txt';
if(file_exists($trans_file)) {
    $lines = file($trans_file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line) {
        if(trim($line)) {
            $parts = explode('|', $line);
            if(count($parts) >= 7 && $parts[1] === $nik) {
                $transactions[] = [
                    'id' => $parts[0],
                    'total' => $parts[3],
                    'payment' => $parts[4],
                    'items' => $parts[5],
                    'date' => $parts[6]
                ];
            }
        }
    }
}

$total_spent = array_sum(array_column($transactions, 'total'));
$total_orders = count($transactions);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Clothing Brand</title>
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
        <a href="cart.php">Cart</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout (<?= explode(' ', $nama)[0]; ?>)</a>
    </nav>
</header>

<div class="dashboard">
    <div class="dashboard-header">
        <h1>👤 Customer Dashboard</h1>
        <p>Selamat datang, <?= htmlspecialchars($nama); ?></p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Belanja</h3>
            <div class="stat-value" style="font-size: 1.8rem;">Rp <?= number_format($total_spent, 0, ',', '.'); ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Total Pesanan</h3>
            <div class="stat-value"><?= $total_orders; ?></div>
        </div>
        
        <div class="stat-card">
            <h3>NIK</h3>
            <div class="stat-value" style="font-size: 1.2rem;"><?= htmlspecialchars($nik); ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Status</h3>
            <div class="stat-value" style="font-size: 1.5rem; color: #28a745;">✅ Aktif</div>
        </div>
    </div>
    
    <div class="content-section active">
        <h2>📦 Riwayat Transaksi Saya</h2>
        
        <?php if(empty($transactions)): ?>
            <div style="text-align: center; padding: 3rem; color: #999;">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🛍️</div>
                <p>Belum ada transaksi</p>
                <a href="allproduct.php" class="btn-shop" style="display: inline-block; margin-top: 1rem; text-decoration: none;">
                    Mulai Belanja
                </a>
            </div>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Metode Bayar</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(array_reverse($transactions) as $trans): ?>
                    <tr>
                        <td><?= htmlspecialchars($trans['id']); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($trans['date'])); ?></td>
                        <td><?= htmlspecialchars($trans['items']); ?> item</td>
                        <td><?= htmlspecialchars($trans['payment']); ?></td>
                        <td style="color: #667eea; font-weight: bold;">Rp <?= number_format($trans['total'], 0, ',', '.'); ?></td>
                        <td>
                            <?php 
                            $receipt_file = "receipts/receipt_" . $trans['id'] . ".txt";
                            if(file_exists($receipt_file)): 
                            ?>
                                <a href="<?= $receipt_file; ?>" download class="btn-shop" style="display: inline-block; padding: 0.5rem 1rem; font-size: 0.9rem; text-decoration: none;">
                                    📄 Struk
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 2rem; text-align: center;">
        <a href="allproduct.php" class="btn-submit" style="display: inline-block; text-decoration: none; margin: 0 0.5rem;">
            🛍️ Lanjut Belanja
        </a>
        <a href="cart.php" class="btn-submit" style="display: inline-block; text-decoration: none; margin: 0 0.5rem; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            🛒 Lihat Keranjang
        </a>
    </div>
</div>

<footer style="background: #333; color: white; padding: 2rem; text-align: center; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <p style="color: #999;">© 2025 Clothing Brand. All rights reserved.</p>
    </div>
</footer>

</body>
</html>