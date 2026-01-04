<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Men's Collection - Clothing Brand</title>
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
        <?php if(isset($_SESSION['nik'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero" style="background-image: url('assets/img/men.jpg');">
    <div class="hero-content">
        <h1>MEN'S COLLECTION</h1>
        <p>Premium Style for Modern Men</p>
    </div>
</section>

<!-- SEARCH BAR -->
<div class="search-container">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="🔍 Cari produk pria... (jacket, jeans, sneakers, dll)">
        <button id="searchBtn">Search</button>
    </div>
    <div style="text-align: center; margin-top: 1rem; color: #999;">
    </div>
</div>

<section class="products">
    <h2>Men's Clothing Catalog</h2>
    <div class="grid">
        <div class="card">
  <img src="assets/img/kaoshitam.webp">
  <h3>Kaos Polos Hitam</h3>
  <p>Rp 75.000</p>
  <button onclick="addToCart('Kaos Polos Hitam', 75000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejaputih.webp">
  <h3>Kemeja Formal Putih</h3>
  <p>Rp 80.000</p>
  <button onclick="addToCart('Kemeja Formal Putih', 80000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/polonavy.webp">
  <h3>Polo Shirt Navy</h3>
  <p>Rp 85.000</p>
  <button onclick="addToCart('Polo Shirt Navy', 85000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tshirtgrafis.webp">
  <h3>T-Shirt Grafis</h3>
  <p>Rp 90.000</p>
  <button onclick="addToCart('T-Shirt Grafis', 90000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejabatik.webp">
  <h3>Kemeja Batik Slim</h3>
  <p>Rp 95.000</p>
  <button onclick="addToCart('Kemeja Batik Slim', 95000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/vneckabu.webp">
  <h3>Kaos V-Neck Abu</h3>
  <p>Rp 100.000</p>
  <button onclick="addToCart('Kaos V-Neck Abu', 100000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/flannelkotak.webp">
  <h3>Flannel Kotak</h3>
  <p>Rp 105.000</p>
  <button onclick="addToCart('Flannel Kotak', 105000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sweaterrajut.webp">
  <h3>Sweater Rajut</h3>
  <p>Rp 110.000</p>
  <button onclick="addToCart('Sweater Rajut', 110000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/hoodiezipper.webp">
  <h3>Hoodie Zipper</h3>
  <p>Rp 115.000</p>
  <button onclick="addToCart('Hoodie Zipper', 115000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kaosoversize.webp">
  <h3>Kaos Oversize</h3>
  <p>Rp 120.000</p>
  <button onclick="addToCart('Kaos Oversize', 120000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejadenim.webp">
  <h3>Kemeja Denim</h3>
  <p>Rp 125.000</p>
  <button onclick="addToCart('Kemeja Denim', 125000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/raglanbaseball.jpg">
  <h3>Raglan Baseball</h3>
  <p>Rp 130.000</p>
  <button onclick="addToCart('Raglan Baseball', 130000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kaoshenley.webp">
  <h3>Kaos Henley</h3>
  <p>Rp 135.000</p>
  <button onclick="addToCart('Kaos Henley', 135000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejalinen.webp">
  <h3>Kemeja Linen</h3>
  <p>Rp 140.000</p>
  <button onclick="addToCart('Kemeja Linen', 140000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jerseysport.webp">
  <h3>Jersey Sport</h3>
  <p>Rp 145.000</p>
  <button onclick="addToCart('Jersey Sport', 145000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tanktopgym.webp">
  <h3>Tanktop Gym</h3>
  <p>Rp 150.000</p>
  <button onclick="addToCart('Tanktop Gym', 150000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kaosstripe.webp">
  <h3>Kaos Stripe</h3>
  <p>Rp 155.000</p>
  <button onclick="addToCart('Kaos Stripe', 155000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejaoxford.webp">
  <h3>Kemeja Oxford</h3>
  <p>Rp 160.000</p>
  <button onclick="addToCart('Kemeja Oxford', 160000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cardiganknit.webp">
  <h3>Cardigan Knit</h3>
  <p>Rp 165.000</p>
  <button onclick="addToCart('Cardigan Knit', 165000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/vestrompi.webp">
  <h3>Vest Rompi</h3>
  <p>Rp 170.000</p>
  <button onclick="addToCart('Vest Rompi', 170000)">Add to Cart</button>
</div>
    </div>
</section>

<section class="products">
    <h2>Men's Pants Catalog</h2>
    <div class="grid">
<div class="card">
  <img src="assets/img/jeansslimfit.webp">
  <h3>Jeans Slim Fit</h3>
  <p>Rp 150.000</p>
  <button onclick="addToCart('Jeans Slim Fit', 150000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/chinobeige.webp">
  <h3>Chino Beige</h3>
  <p>Rp 160.000</p>
  <button onclick="addToCart('Chino Beige', 160000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cargohitam.webp">
  <h3>Cargo Hitam</h3>
  <p>Rp 170.000</p>
  <button onclick="addToCart('Cargo Hitam', 170000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/joggerpants.webp">
  <h3>Jogger Pants</h3>
  <p>Rp 180.000</p>
  <button onclick="addToCart('Jogger Pants', 180000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeansripped.webp">
  <h3>Jeans Ripped</h3>
  <p>Rp 190.000</p>
  <button onclick="addToCart('Jeans Ripped', 190000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanaformal.webp">
  <h3>Celana Formal</h3>
  <p>Rp 200.000</p>
  <button onclick="addToCart('Celana Formal', 200000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cargoarmy.webp">
  <h3>Cargo Army</h3>
  <p>Rp 210.000</p>
  <button onclick="addToCart('Cargo Army', 210000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/trainingpants.webp">
  <h3>Training Pants</h3>
  <p>Rp 220.000</p>
  <button onclick="addToCart('Training Pants', 220000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/shortjeans.webp">
  <h3>Short Jeans</h3>
  <p>Rp 230.000</p>
  <button onclick="addToCart('Short Jeans', 230000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/chinonavy.webp">
  <h3>Chino Navy</h3>
  <p>Rp 240.000</p>
  <button onclick="addToCart('Chino Navy', 240000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanakargo.webp">
  <h3>Celana Kargo</h3>
  <p>Rp 250.000</p>
  <button onclick="addToCart('Celana Kargo', 250000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/joggerstripe.webp">
  <h3>Jogger Stripe</h3>
  <p>Rp 260.000</p>
  <button onclick="addToCart('Jogger Stripe', 260000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeansstraight.webp">
  <h3>Jeans Straight</h3>
  <p>Rp 270.000</p>
  <button onclick="addToCart('Jeans Straight', 270000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanabahan.webp">
  <h3>Celana Bahan</h3>
  <p>Rp 280.000</p>
  <button onclick="addToCart('Celana Bahan', 280000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/shortcargo.webp">
  <h3>Short Cargo</h3>
  <p>Rp 290.000</p>
  <button onclick="addToCart('Short Cargo', 290000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/trainingsport.webp">
  <h3>Training Sport</h3>
  <p>Rp 300.000</p>
  <button onclick="addToCart('Training Sport', 300000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeanswashed.webp">
  <h3>Jeans Washed</h3>
  <p>Rp 310.000</p>
  <button onclick="addToCart('Jeans Washed', 310000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/chinokhaki.webp">
  <h3>Chino Khaki</h3>
  <p>Rp 320.000</p>
  <button onclick="addToCart('Chino Khaki', 320000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/joggercotton.webp">
  <h3>Jogger Cotton</h3>
  <p>Rp 330.000</p>
  <button onclick="addToCart('Jogger Cotton', 330000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanapendek.webp">
  <h3>Celana Pendek</h3>
  <p>Rp 340.000</p>
  <button onclick="addToCart('Celana Pendek', 340000)">Add to Cart</button>
</div>
    </div>
</section>

<section class="products">
    <h2> Men's Jacket Catalog</h2>
    <div class="grid">
    <div class="card">
  <img src="assets/img/bomberjacket.webp" alt="Bomber Jacket">
  <h3>Bomber Jacket</h3>
  <p>Rp 250.000</p>
  <button onclick="addToCart('Bomber Jacket', 250000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/hoodiejacket.webp" alt="Hoodie Jacket">
  <h3>Hoodie Jacket</h3>
  <p>Rp 265.000</p>
  <button onclick="addToCart('Hoodie Jacket', 265000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/varsityjacket.jpg" alt="Varsity Jacket">
  <h3>Varsity Jacket</h3>
  <p>Rp 280.000</p>
  <button onclick="addToCart('Varsity Jacket', 280000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/denimjacket.webp" alt="Denim Jacket">
  <h3>Denim Jacket</h3>
  <p>Rp 295.000</p>
  <button onclick="addToCart('Denim Jacket', 295000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/parkatebal.webp" alt="Parka Tebal">
  <h3>Parka Tebal</h3>
  <p>Rp 310.000</p>
  <button onclick="addToCart('Parka Tebal', 310000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/windbreaker.webp" alt="Windbreaker">
  <h3>Windbreaker</h3>
  <p>Rp 325.000</p>
  <button onclick="addToCart('Windbreaker', 325000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/leatherjacket.webp" alt="Leather Jacket">
  <h3>Leather Jacket</h3>
  <p>Rp 340.000</p>
  <button onclick="addToCart('Leather Jacket', 340000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/trackjacket.webp" alt="Track Jacket">
  <h3>Track Jacket</h3>
  <p>Rp 355.000</p>
  <button onclick="addToCart('Track Jacket', 355000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/fleecejacket.webp" alt="Fleece Jacket">
  <h3>Fleece Jacket</h3>
  <p>Rp 370.000</p>
  <button onclick="addToCart('Fleece Jacket', 370000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/coachjacket.webp" alt="Coach Jacket">
  <h3>Coach Jacket</h3>
  <p>Rp 385.000</p>
  <button onclick="addToCart('Coach Jacket', 385000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/ma1bomber.webp" alt="MA-1 Bomber">
  <h3>MA-1 Bomber</h3>
  <p>Rp 400.000</p>
  <button onclick="addToCart('MA-1 Bomber', 400000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sweaterjacket.webp" alt="Sweater Jacket">
  <h3>Sweater Jacket</h3>
  <p>Rp 415.000</p>
  <button onclick="addToCart('Sweater Jacket', 415000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/softshelljacket.webp" alt="Softshell Jacket">
  <h3>Softshell Jacket</h3>
  <p>Rp 430.000</p>
  <button onclick="addToCart('Softshell Jacket', 430000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/rainjacket.webp" alt="Rain Jacket">
  <h3>Rain Jacket</h3>
  <p>Rp 445.000</p>
  <button onclick="addToCart('Rain Jacket', 445000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/harringtonjacket.webp" alt="Harrington Jacket">
  <h3>Harrington Jacket</h3>
  <p>Rp 460.000</p>
  <button onclick="addToCart('Harrington Jacket', 460000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sherpajacket.webp" alt="Sherpa Jacket">
  <h3>Sherpa Jacket</h3>
  <p>Rp 475.000</p>
  <button onclick="addToCart('Sherpa Jacket', 475000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/truckerjacket.webp" alt="Trucker Jacket">
  <h3>Trucker Jacket</h3>
  <p>Rp 490.000</p>
  <button onclick="addToCart('Trucker Jacket', 490000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/anorakjacket.webp" alt="Anorak Jacket">
  <h3>Anorak Jacket</h3>
  <p>Rp 505.000</p>
  <button onclick="addToCart('Anorak Jacket', 505000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/pufferjacket.webp" alt="Puffer Jacket">
  <h3>Puffer Jacket</h3>
  <p>Rp 520.000</p>
  <button onclick="addToCart('Puffer Jacket', 520000)">Add to Cart</button>
</div>
    </div>
</section>

<section class="products">
    <h2> Men's Shoe Catalog</h2>
    <div class="grid">
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
  <img src="assets/img/runningshoes.webp" alt="Running Shoes">
  <h3>Running Shoes</h3>
  <p>Rp 410.000</p>
  <button onclick="addToCart('Running Shoes', 410000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/oxfordformal.webp" alt="Oxford Formal">
  <h3>Oxford Formal</h3>
  <p>Rp 430.000</p>
  <button onclick="addToCart('Oxford Formal', 430000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/hightop.webp" alt="High Top">
  <h3>High Top</h3>
  <p>Rp 450.000</p>
  <button onclick="addToCart('High Top', 450000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/slipon.webp" alt="Slip On">
  <h3>Slip On</h3>
  <p>Rp 470.000</p>
  <button onclick="addToCart('Slip On', 470000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/boatshoes.webp" alt="Boat Shoes">
  <h3>Boat Shoes</h3>
  <p>Rp 490.000</p>
  <button onclick="addToCart('Boat Shoes', 490000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/derbyshoes.webp" alt="Derby Shoes">
  <h3>Derby Shoes</h3>
  <p>Rp 510.000</p>
  <button onclick="addToCart('Derby Shoes', 510000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sneakerssport.webp" alt="Sneakers Sport">
  <h3>Sneakers Sport</h3>
  <p>Rp 530.000</p>
  <button onclick="addToCart('Sneakers Sport', 530000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/monkstrap.webp" alt="Monk Strap">
  <h3>Monk Strap</h3>
  <p>Rp 550.000</p>
  <button onclick="addToCart('Monk Strap', 550000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/espadrilles.webp" alt="Espadrilles">
  <h3>Espadrilles</h3>
  <p>Rp 570.000</p>
  <button onclick="addToCart('Espadrilles', 570000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/drivingshoes.webp" alt="Driving Shoes">
  <h3>Driving Shoes</h3>
  <p>Rp 590.000</p>
  <button onclick="addToCart('Driving Shoes', 590000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/brogues.webp" alt="Brogues">
  <h3>Brogues</h3>
  <p>Rp 610.000</p>
  <button onclick="addToCart('Brogues', 610000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/basketballshoes.webp" alt="Basketball Shoes">
  <h3>Basketball Shoes</h3>
  <p>Rp 630.000</p>
  <button onclick="addToCart('Basketball Shoes', 630000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sandalkulit.webp" alt="Sandal Kulit">
  <h3>Sandal Kulit</h3>
  <p>Rp 650.000</p>
  <button onclick="addToCart('Sandal Kulit', 650000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/casualsneakers.webp" alt="Casual Sneakers">
  <h3>Casual Sneakers</h3>
  <p>Rp 670.000</p>
  <button onclick="addToCart('Casual Sneakers', 670000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/workboots.webp" alt="Work Boots">
  <h3>Work Boots</h3>
  <p>Rp 690.000</p>
  <button onclick="addToCart('Work Boots', 690000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tennisshoes.webp" alt="Tennis Shoes">
  <h3>Tennis Shoes</h3>
  <p>Rp 710.000</p>
  <button onclick="addToCart('Tennis Shoes', 710000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/moccasins.webp" alt="Moccasins">
  <h3>Moccasins</h3>
  <p>Rp 730.000</p>
  <button onclick="addToCart('Moccasins', 730000)">Add to Cart</button>
</div>
    </div>
</section>

<footer style="background: #333; color: white; padding: 2rem; text-align: center; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <p style="color: #999;">© 2025 Clothing Brand. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/cart.js"></script>
<script src="assets/js/search.js"></script>
</body>
</html>