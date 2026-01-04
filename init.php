<!DOCTYPE html>
<html>
<head>
    <title>Setup - Clothing Brand</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #dc3545;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #17a2b8;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 10px 0 0;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #5568d3;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
        ul {
            line-height: 1.8;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🚀 Clothing Brand - Setup Installer</h1>
    
    <?php
    $errors = [];
    $success = [];
    
    // Create necessary directories
    $directories = ['data', 'receipts', 'admin'];
    
    foreach($directories as $dir) {
        if(!file_exists($dir)) {
            if(mkdir($dir, 0777, true)) {
                $success[] = "✓ Created directory: <strong>$dir</strong>";
            } else {
                $errors[] = "✗ Failed to create directory: <strong>$dir</strong>";
            }
        } else {
            $success[] = "✓ Directory already exists: <strong>$dir</strong>";
        }
    }
    
    // Create necessary files
    $files = [
        'data/transactions.txt' => '',
        'data/transaction_details.txt' => '',
        'data/customers.txt' => '',
        'data/KTP.txt' => ''
    ];
    
    foreach($files as $file => $content) {
        if(!file_exists($file)) {
            if(file_put_contents($file, $content) !== false) {
                $success[] = "✓ Created file: <strong>$file</strong>";
            } else {
                $errors[] = "✗ Failed to create file: <strong>$file</strong>";
            }
        } else {
            $success[] = "✓ File already exists: <strong>$file</strong>";
        }
    }
    
    // Create products.txt with initial data
    if(!file_exists('data/products.txt')) {
        $initial_products = "Kaos Polos Hitam|75000|50
Kemeja Formal Putih|80000|45
Polo Shirt Navy|85000|40
T-Shirt Grafis|90000|35
Kemeja Batik Slim|95000|30
Kaos V-Neck Abu|100000|25
Flannel Kotak|105000|20
Sweater Rajut|110000|18
Hoodie Zipper|115000|15
Kaos Oversize|120000|12
Kemeja Denim|125000|10
Blouse Satin|85000|40
Tunik Casual|90000|35
Jeans Slim Fit|150000|30
Chino Beige|160000|28
Bomber Jacket|250000|15
Denim Jacket|295000|12
MA-1 Bomber|400000|5
Puffer Jacket|520000|4
Sneakers Canvas|350000|20
Loafers Kulit|370000|18
High Heels|380000|15
Flat Shoes|400000|14
Loafers|680000|5
Chelsea Boots|700000|4
";
        if(file_put_contents('data/products.txt', $initial_products) !== false) {
            $success[] = "✓ Created file: <strong>data/products.txt</strong> with sample products";
        } else {
            $errors[] = "✗ Failed to create file: <strong>data/products.txt</strong>";
        }
    } else {
        $success[] = "✓ File already exists: <strong>data/products.txt</strong>";
    }
    
    // Display results
    if(!empty($success)) {
        echo "<div class='info'><strong>Setup Progress:</strong></div>";
        foreach($success as $msg) {
            echo "<div class='success'>$msg</div>";
        }
    }
    
    if(!empty($errors)) {
        echo "<div class='info'><strong>Errors:</strong></div>";
        foreach($errors as $msg) {
            echo "<div class='error'>$msg</div>";
        }
    }
    ?>
    
    <div class="info">
        <h3>📋 Struktur Folder Anda:</h3>
        <ul>
            <li>✓ FINALSDATA/ (ROOT)</li>
            <li>├── 📁 data/ - Database TXT files</li>
            <li>│   ├── KTP.txt - Customer KTP data</li>
            <li>│   ├── customers.txt - Customer accounts</li>
            <li>│   ├── products.txt - Product stock</li>
            <li>│   ├── transactions.txt - Transaction records</li>
            <li>│   └── transaction_details.txt - Detail items</li>
            <li>├── 📁 receipts/ - Struk transaksi</li>
            <li>├── 📁 admin/ - Admin files</li>
            <li>└── 📁 assets/ - CSS, JS, Images</li>
        </ul>
    </div>
    
    <div class="info">
        <h3>🔐 Login Credentials:</h3>
        <p><strong>Admin:</strong></p>
        <ul>
            <li>URL: <code>admin/login_admin.php</code></li>
            <li>Username: <code>admin</code></li>
            <li>Password: <code>admin123</code></li>
        </ul>
        
        <p><strong>Customer:</strong></p>
        <ul>
            <li>Daftar dulu di: <code>register.php</code></li>
            <li>Buat password sendiri (min 8 karakter, ada huruf & angka)</li>
        </ul>
    </div>
    
    <div class="info" style="background: #fff3cd; border-color: #ffc107; color: #856404;">
        <h3>⚡ Fitur Admin Baru:</h3>
        <ul>
            <li>✅ Lihat password customer (hashed)</li>
            <li>✅ Kelola stok produk (tambah/kurang)</li>
            <li>✅ Tambah produk baru</li>
            <li>✅ Export data transactions & customers</li>
        </ul>
    </div>
    
    <?php if(empty($errors)): ?>
        <div class="info" style="background: #d4edda; border-color: #28a745; color: #155724;">
            <h3>✅ Setup Berhasil!</h3>
            <p>Sistem siap digunakan dengan fitur lengkap!</p>
        </div>
        
        <a href="index.php" class="btn btn-success">🏠 Go to Homepage</a>
        <a href="register.php" class="btn">📝 Register Customer</a>
        <a href="admin/login_admin.php" class="btn">👨‍💼 Login Admin</a>
    <?php else: ?>
        <div class="error">
            <h3>⚠️ Setup Gagal!</h3>
            <p>Ada error. Pastikan:</p>
            <ul>
                <li>Folder FINALSDATA memiliki permission yang benar (chmod 777)</li>
                <li>PHP memiliki akses untuk membuat folder dan file</li>
            </ul>
        </div>
        <a href="init.php" class="btn">🔄 Coba Lagi</a>
    <?php endif; ?>
    
</div>

</body>
</html>