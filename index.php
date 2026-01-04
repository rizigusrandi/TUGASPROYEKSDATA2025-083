<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Clothing Brand - Premium Fashion Store</title>
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
        <a href="cart.php">Cart <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>(<?= count($_SESSION['cart']); ?>)<?php endif; ?></a>
        <?php if(isset($_SESSION['nik'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout (<?= explode(' ', $_SESSION['nama'])[0]; ?>)</a>
        <?php elseif(isset($_SESSION['admin'])): ?>
            <a href="admin/dashboard.php">Admin Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero" style="background-image: url('assets/img/bg.jpg');">
    <div class="hero-content">
        <h1>NEVER STOP EXPLORING</h1>
        <p>Premium performance apparel.</p>
        <button onclick="window.location.href='allproduct.php'">Shop Now</button>
    </div>
</section>

<section class="products">
    <h2>Best Selling Product</h2>
    <div class="grid">

<div class="card">
  <img src="assets/img/ma1bomber.webp" alt="MA-1 Bomber">
  <h3>MA-1 Bomber</h3>
  <p>Rp 400.000</p>
  <button onclick="addToCart('MA-1 Bomber', 400000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejadenim.webp">
  <h3>Kemeja Denim</h3>
  <p>Rp 125.000</p>
  <button onclick="addToCart('Kemeja Denim', 125000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/pufferjacket.webp" alt="Puffer Jacket">
  <h3>Puffer Jacket</h3>
  <p>Rp 520.000</p>
  <button onclick="addToCart('Puffer Jacket', 520000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/blousesatin.webp" alt="Blouse Satin">
  <h3>Blouse Satin</h3>
  <p>Rp 85.000</p>
  <button onclick="addToCart('Blouse Satin', 85000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tunikcasual.webp" alt="Tunik Casual">
  <h3>Tunik Casual</h3>
  <p>Rp 90.000</p>
  <button onclick="addToCart('Tunik Casual', 90000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/vestouter.webp" alt="Vest Outer">
  <h3>Vest Outer</h3>
  <p>Rp 170.000</p>
  <button onclick="addToCart('Vest Outer', 170000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeansripped.webp">
  <h3>Jeans Ripped</h3>
  <p>Rp 190.000</p>
  <button onclick="addToCart('Jeans Ripped', 190000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cargoarmy.webp">
  <h3>Cargo Army</h3>
  <p>Rp 210.000</p>
  <button onclick="addToCart('Cargo Army', 210000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/chinonavy.webp">
  <h3>Chino Navy</h3>
  <p>Rp 240.000</p>
  <button onclick="addToCart('Chino Navy', 240000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanacargo.webp" alt="Celana Cargo">
  <h3>Celana Cargo</h3>
  <p>Rp 300.000</p>
  <button onclick="addToCart('Celana Cargo', 300000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/joggerpolos.webp" alt="Jogger Polos">
  <h3>Jogger Polos</h3>
  <p>Rp 310.000</p>
  <button onclick="addToCart('Jogger Polos', 310000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeansmom.webp" alt="Jeans Mom">
  <h3>Jeans Mom</h3>
  <p>Rp 320.000</p>
  <button onclick="addToCart('Jeans Mom', 320000)">Add to Cart</button>
</div>
       
<div class="card">
  <img src="assets/img/sneakerscanvas.webp" alt="Sneakers Canvas">
  <h3>Sneakers Canvas</h3>
  <p>Rp 350.000</p>
  <button onclick="addToCart('Sneakers Canvas', 350000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/loaferskulit.webp" alt="Loafers Kulit">
  <h3>Loafers Kulit</h3>
  <p>Rp 370.000</p>
  <button onclick="addToCart('Loafers Kulit', 370000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/bootschelsea.webp" alt="Boots Chelsea">
  <h3>Boots Chelsea</h3>
  <p>Rp 390.000</p>
  <button onclick="addToCart('Boots Chelsea', 390000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/loafers.webp" alt="Loafers">
  <h3>Loafers</h3>
  <p>Rp 680.000</p>
  <button onclick="addToCart('Loafers', 680000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/chelseaboots.webp" alt="Chelsea Boots">
  <h3>Chelsea Boots</h3>
  <p>Rp 700.000</p>
  <button onclick="addToCart('Chelsea Boots', 700000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kittenheals.webp" alt="Kitten Heels">
  <h3>Kitten Heels</h3>
  <p>Rp 720.000</p>
  <button onclick="addToCart('Kitten Heels', 720000)">Add to Cart</button>
</div>
    </div>
</section>

<footer style="background: #333; color: white; padding: 3rem 2rem; text-align: center; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="margin-bottom: 1rem;">CLOTHING BRAND</h3>
        <p style="margin-bottom: 1rem;">Premium Fashion Store - Quality You Can Trust</p>
        <p style="color: #999;">© 2025 Clothing Brand. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/cart.js"></script>
</body>
</html>