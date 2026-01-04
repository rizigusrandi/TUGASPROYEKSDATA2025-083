<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Get all transactions
$transactions = [];
$trans_file = '../data/transactions.txt';
if(file_exists($trans_file)) {
    $lines = file($trans_file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line) {
        if(trim($line)) {
            $parts = explode('|', $line);
            if(count($parts) >= 7) {
                $transactions[] = [
                    'id' => $parts[0],
                    'nik' => $parts[1],
                    'nama' => $parts[2],
                    'total' => $parts[3],
                    'payment' => $parts[4],
                    'items' => $parts[5],
                    'date' => $parts[6]
                ];
            }
        }
    }
}

// Get all customers with passwords
$customers = [];
$cust_file = '../data/customers.txt';
if(file_exists($cust_file)) {
    $lines = file($cust_file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line) {
        if(trim($line)) {
            $parts = explode('|', $line);
            if(count($parts) >= 4) {
                $customers[] = [
                    'nik' => $parts[0],
                    'nama' => $parts[1],
                    'tanggal_lahir' => $parts[2],
                    'password' => $parts[3],
                    'registered' => isset($parts[4]) ? $parts[4] : date('Y-m-d H:i:s')
                ];
            }
        }
    }
}

// Get product stock
$products_file = '../data/products.txt';
$products = [];
if(file_exists($products_file)) {
    $lines = file($products_file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line) {
        if(trim($line)) {
            $parts = explode('|', $line);
            if(count($parts) >= 3) {
                $products[] = [
                    'name' => $parts[0],
                    'price' => $parts[1],
                    'stock' => $parts[2]
                ];
            }
        }
    }
}

$total_revenue = array_sum(array_column($transactions, 'total'));
$total_orders = count($transactions);
$total_customers = count($customers);
$avg_order = $total_orders > 0 ? $total_revenue / $total_orders : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Clothing Brand</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e0e0e0;
        }
        .tab {
            padding: 1rem 2rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab:hover {
            color: #667eea;
        }
        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .password-cell {
            font-family: monospace;
            font-size: 0.9rem;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .password-toggle-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
            margin-left: 0.5rem;
        }
        .password-toggle-btn:hover {
            background: #5568d3;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
            margin-left: 0.5rem;
        }
        .delete-btn:hover {
            background: #c82333;
        }
        .stock-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .stock-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .stock-btn:hover {
            background: #5568d3;
        }
        .stock-input {
            width: 80px;
            padding: 0.3rem;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            text-align: center;
        }
        .add-product-form {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo">ADMIN PANEL</div>
    <nav>
        <a href="../index.php">View Store</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </nav>
</header>

<div class="dashboard">
    <div class="dashboard-header">
        <h1>📊 Admin Dashboard</h1>
        <p>Selamat datang, Admin</p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Revenue</h3>
            <div class="stat-value" style="font-size: 2rem;">Rp <?= number_format($total_revenue, 0, ',', '.'); ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="stat-value"><?= $total_orders; ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Total Customers</h3>
            <div class="stat-value"><?= $total_customers; ?></div>
        </div>
        
        <div class="stat-card">
            <h3>Avg Order Value</h3>
            <div class="stat-value" style="font-size: 1.8rem;">Rp <?= number_format($avg_order, 0, ',', '.'); ?></div>
        </div>
    </div>
    
    <!-- Tabs -->
    <div class="tabs">
        <button class="tab active" onclick="showTab('transactions')">📦 Transactions</button>
        <button class="tab" onclick="showTab('customers')">👥 Customers</button>
        <button class="tab" onclick="showTab('products')">📦 Product Stock</button>
    </div>
    
    <!-- Transactions Tab -->
    <div id="transactions" class="tab-content active">
        <h2>📦 Recent Transactions</h2>
        
        <?php if(empty($transactions)): ?>
            <div style="text-align: center; padding: 3rem; color: #999;">
                <p>Belum ada transaksi</p>
            </div>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>NIK</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Payment</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(array_reverse($transactions) as $trans): ?>
                    <tr>
                        <td><?= htmlspecialchars($trans['id']); ?></td>
                        <td><?= htmlspecialchars($trans['nama']); ?></td>
                        <td><?= htmlspecialchars($trans['nik']); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($trans['date'])); ?></td>
                        <td><?= htmlspecialchars($trans['items']); ?> item</td>
                        <td><?= htmlspecialchars($trans['payment']); ?></td>
                        <td style="color: #667eea; font-weight: bold;">Rp <?= number_format($trans['total'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="margin-top: 2rem; text-align: center;">
                <a href="export_data.php?type=transactions" class="btn-submit" style="display: inline-block; text-decoration: none;">
                    📥 Export Transactions
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Customers Tab -->
    <div id="customers" class="tab-content">
        <h2>👥 Registered Customers</h2>
        
        <?php if(empty($customers)): ?>
            <div style="text-align: center; padding: 3rem; color: #999;">
                <p>Belum ada customer terdaftar</p>
            </div>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Password (Hashed)</th>
                        <th>Registered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(array_reverse($customers) as $index => $cust): ?>
                    <tr id="customer-row-<?= $index; ?>">
                        <td><?= htmlspecialchars($cust['nik']); ?></td>
                        <td><?= htmlspecialchars($cust['nama']); ?></td>
                        <td><?= date('d/m/Y', strtotime($cust['tanggal_lahir'])); ?></td>
                        <td>
                            <span id="pass-<?= $index; ?>" class="password-cell">
                                <?= str_repeat('•', 20); ?>
                            </span>
                            <button class="password-toggle-btn" onclick="togglePassword(<?= $index; ?>, '<?= htmlspecialchars($cust['password'], ENT_QUOTES); ?>')">
                                👁️ Show
                            </button>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($cust['registered'])); ?></td>
                        <td>
                            <button class="delete-btn" onclick="deleteCustomer('<?= htmlspecialchars($cust['nik']); ?>', '<?= htmlspecialchars($cust['nama']); ?>', <?= $index; ?>)">
                                🗑️ Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="margin-top: 2rem; text-align: center;">
                <a href="export_data.php?type=customers" class="btn-submit" style="display: inline-block; text-decoration: none;">
                    📥 Export Customers
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Products Tab -->
    <div id="products" class="tab-content">
        <h2>📦 Product Stock Management</h2>
        
        <!-- Add Product Form -->
        <div class="add-product-form">
            <h3>➕ Add New Product</h3>
            <form action="manage_product.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-row">
                    <div>
                        <label>Product Name</label>
                        <input type="text" name="product_name" required style="width: 100%; padding: 0.5rem; border: 2px solid #e0e0e0; border-radius: 5px;">
                    </div>
                    <div>
                        <label>Price (Rp)</label>
                        <input type="number" name="product_price" required min="0" style="width: 100%; padding: 0.5rem; border: 2px solid #e0e0e0; border-radius: 5px;">
                    </div>
                    <div>
                        <label>Initial Stock</label>
                        <input type="number" name="product_stock" required min="0" style="width: 100%; padding: 0.5rem; border: 2px solid #e0e0e0; border-radius: 5px;">
                    </div>
                </div>
                <button type="submit" class="btn-submit">➕ Add Product</button>
            </form>
        </div>
        
        <?php if(empty($products)): ?>
            <div style="text-align: center; padding: 3rem; color: #999;">
                <p>Belum ada produk. Silakan tambahkan produk baru.</p>
            </div>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $index => $product): ?>
                    <tr id="product-<?= $index; ?>">
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td>Rp <?= number_format($product['price'], 0, ',', '.'); ?></td>
                        <td>
                            <span id="stock-<?= $index; ?>" style="font-weight: bold; color: <?= $product['stock'] < 10 ? '#dc3545' : '#28a745'; ?>">
                                <?= htmlspecialchars($product['stock']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="stock-control">
                                <button class="stock-btn" onclick="updateStock('<?= htmlspecialchars($product['name']); ?>', -1, <?= $index; ?>)">➖</button>
                                <input type="number" id="qty-<?= $index; ?>" value="1" min="1" class="stock-input">
                                <button class="stock-btn" onclick="updateStock('<?= htmlspecialchars($product['name']); ?>', 1, <?= $index; ?>)">➕</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelectorAll('.tab').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');
}

const passwordStates = {};

function togglePassword(index, hashedPassword) {
    const span = document.getElementById('pass-' + index);
    const btn = event.target;
    
    if (!passwordStates[index]) {
        span.textContent = hashedPassword;
        btn.textContent = '🙈 Hide';
        passwordStates[index] = true;
    } else {
        span.textContent = '••••••••••••••••••••';
        btn.textContent = '👁️ Show';
        passwordStates[index] = false;
    }
}

function deleteCustomer(nik, nama, index) {
    if (confirm(`⚠️ Apakah Anda yakin ingin menghapus customer:\n\nNama: ${nama}\nNIK: ${nik}\n\nData customer dan riwayat transaksi akan dihapus!`)) {
        const formData = new FormData();
        formData.append('action', 'delete_customer');
        formData.append('nik', nik);
        
        fetch('manage_customer.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove row with animation
                const row = document.getElementById('customer-row-' + index);
                row.style.opacity = '0';
                row.style.transition = 'opacity 0.3s';
                setTimeout(() => {
                    row.remove();
                    alert('✅ Customer berhasil dihapus!');
                    // Reload to update stats
                    location.reload();
                }, 300);
            } else {
                alert('❌ Error: ' + (data.message || 'Failed to delete customer'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Failed to delete customer');
        });
    }
}

function updateStock(productName, direction, index) {
    const qtyInput = document.getElementById('qty-' + index);
    const quantity = parseInt(qtyInput.value);
    
    if (quantity <= 0) {
        alert('Quantity must be greater than 0');
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'update');
    formData.append('product_name', productName);
    formData.append('quantity', quantity * direction);
    
    fetch('manage_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const stockSpan = document.getElementById('stock-' + index);
            stockSpan.textContent = data.new_stock;
            stockSpan.style.color = data.new_stock < 10 ? '#dc3545' : '#28a745';
            
            if (data.new_stock <= 0) {
                alert('⚠️ Warning: Product out of stock!');
            }
        } else {
            alert('Error: ' + (data.message || 'Failed to update stock'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update stock');
    });
}
</script>

</body>
</html>