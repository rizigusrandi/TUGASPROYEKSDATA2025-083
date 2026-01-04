<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Women's Collection - Clothing Brand</title>
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

<section class="hero" style="background-image: url('assets/img/womanbg.jpeg');">
    <div class="hero-content">
        <h1>WOMEN'S COLLECTION</h1>
        <p>Elegant Style for Modern Women</p>
    </div>
</section>

<!-- SEARCH BAR -->
<div class="search-container">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="🔍 Cari produk wanita... (blouse, kulot, heels, dll)">
        <button id="searchBtn">Search</button>
    </div>
    <div style="text-align: center; margin-top: 1rem; color: #999;">

    </div>
</div>

<section class="products">
    <h2>Women's Clothing Catalog</h2>
    <div class="grid">
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
  <img src="assets/img/atasanbrokat.webp" alt="Atasan Brokat">
  <h3>Atasan Brokat</h3>
  <p>Rp 95.000</p>
  <button onclick="addToCart('Atasan Brokat', 95000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kaoscroptop.webp" alt="Kaos Crop Top">
  <h3>Kaos Crop Top</h3>
  <p>Rp 100.000</p>
  <button onclick="addToCart('Kaos Crop Top', 100000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejafloral.webp" alt="Kemeja Floral">
  <h3>Kemeja Floral</h3>
  <p>Rp 105.000</p>
  <button onclick="addToCart('Kemeja Floral', 105000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/topsabrina.webp" alt="Top Sabrina">
  <h3>Top Sabrina</h3>
  <p>Rp 110.000</p>
  <button onclick="addToCart('Top Sabrina', 110000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/blazerwanita.webp" alt="Blazer Wanita">
  <h3>Blazer Wanita</h3>
  <p>Rp 115.000</p>
  <button onclick="addToCart('Blazer Wanita', 115000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cardiganpanjang.png" alt="Cardigan Panjang">
  <h3>Cardigan Panjang</h3>
  <p>Rp 120.000</p>
  <button onclick="addToCart('Cardigan Panjang', 120000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tanktopspandex.webp" alt="Tank Top Spandex">
  <h3>Tank Top Spandex</h3>
  <p>Rp 125.000</p>
  <button onclick="addToCart('Tank Top Spandex', 125000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/swaterturtleneck.jpg" alt="Sweater Turtleneck">
  <h3>Sweater Turtleneck</h3>
  <p>Rp 130.000</p>
  <button onclick="addToCart('Sweater Turtleneck', 130000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/blouserenda.webp" alt="Blouse Renda">
  <h3>Blouse Renda</h3>
  <p>Rp 135.000</p>
  <button onclick="addToCart('Blouse Renda', 135000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/tunikbatik.webp" alt="Tunik Batik">
  <h3>Tunik Batik</h3>
  <p>Rp 140.000</p>
  <button onclick="addToCart('Tunik Batik', 140000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kaosloosefit.webp" alt="Kaos Loose Fit">
  <h3>Kaos Loose Fit</h3>
  <p>Rp 145.000</p>
  <button onclick="addToCart('Kaos Loose Fit', 145000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kemejakotak.webp" alt="Kemeja Kotak">
  <h3>Kemeja Kotak</h3>
  <p>Rp 150.000</p>
  <button onclick="addToCart('Kemeja Kotak', 150000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/topkutung.webp" alt="Top Kutung">
  <h3>Top Kutung</h3>
  <p>Rp 155.000</p>
  <button onclick="addToCart('Top Kutung', 155000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/atasantiedye.png" alt="Atasan Tie Dye">
  <h3>Atasan Tie Dye</h3>
  <p>Rp 160.000</p>
  <button onclick="addToCart('Atasan Tie Dye', 160000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/blousechiffon.webp" alt="Blouse Chiffon">
  <h3>Blouse Chiffon</h3>
  <p>Rp 165.000</p>
  <button onclick="addToCart('Blouse Chiffon', 165000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/vestouter.webp" alt="Vest Outer">
  <h3>Vest Outer</h3>
  <p>Rp 170.000</p>
  <button onclick="addToCart('Vest Outer', 170000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/crophoodie.webp" alt="Crop Hoodie">
  <h3>Crop Hoodie</h3>
  <p>Rp 175.000</p>
  <button onclick="addToCart('Crop Hoodie', 175000)">Add to Cart</button>
</div>
    </div>
</section>

<section class="products">
    <h2>Women's Pants Catalog</h2>
    <div class="grid">
    <div class="card">
  <img src="assets/img/jeansskinny.webp" alt="Jeans Skinny">
  <h3>Jeans Skinny</h3>
  <p>Rp 160.000</p>
  <button onclick="addToCart('Jeans Skinny', 160000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kulothitam.webp" alt="Kulot Hitam">
  <h3>Kulot Hitam</h3>
  <p>Rp 170.000</p>
  <button onclick="addToCart('Kulot Hitam', 170000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/leggingspandex.webp" alt="Legging Spandex">
  <h3>Legging Spandex</h3>
  <p>Rp 180.000</p>
  <button onclick="addToCart('Legging Spandex', 180000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/palazzopants.webp" alt="Palazzo Pants">
  <h3>Palazzo Pants</h3>
  <p>Rp 190.000</p>
  <button onclick="addToCart('Palazzo Pants', 190000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeanshighwaist.webp" alt="Jeans High Waist">
  <h3>Jeans High Waist</h3>
  <p>Rp 200.000</p>
  <button onclick="addToCart('Jeans High Waist', 200000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanakulot.webp" alt="Celana Kulot">
  <h3>Celana Kulot</h3>
  <p>Rp 210.000</p>
  <button onclick="addToCart('Celana Kulot', 210000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/joggerwanita.webp" alt="Jogger Wanita">
  <h3>Jogger Wanita</h3>
  <p>Rp 220.000</p>
  <button onclick="addToCart('Jogger Wanita', 220000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/shortjeanswoman.webp" alt="Short Jeans">
  <h3>Short Jeans Woman</h3>
  <p>Rp 230.000</p>
  <button onclick="addToCart('Short Jeans Woman', 230000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/celanaplisket.webp" alt="Celana Plisket">
  <h3>Celana Plisket</h3>
  <p>Rp 240.000</p>
  <button onclick="addToCart('Celana Plisket', 240000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/widelegpants.webp" alt="Wide Leg Pants">
  <h3>Wide Leg Pants</h3>
  <p>Rp 250.000</p>
  <button onclick="addToCart('Wide Leg Pants', 250000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/jeansboyfriend.webp" alt="Jeans Boyfriend">
  <h3>Jeans Boyfriend</h3>
  <p>Rp 260.000</p>
  <button onclick="addToCart('Jeans Boyfriend', 260000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kulotmotif.webp" alt="Kulot Motif">
  <h3>Kulot Motif</h3>
  <p>Rp 270.000</p>
  <button onclick="addToCart('Kulot Motif', 270000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/legginggym.webp" alt="Legging Gym">
  <h3>Legging Gym</h3>
  <p>Rp 280.000</p>
  <button onclick="addToCart('Legging Gym', 280000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/hotpants.webp" alt="Hot Pants">
  <h3>Hot Pants</h3>
  <p>Rp 290.000</p>
  <button onclick="addToCart('Hot Pants', 290000)">Add to Cart</button>
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
  <img src="assets/img/kulotlipit.webp" alt="Kulot Lipit">
  <h3>Kulot Lipit</h3>
  <p>Rp 330.000</p>
  <button onclick="addToCart('Kulot Lipit', 330000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/trainingpantswoman.webp" alt="Training Pants Woman">
  <h3>Training Pants Woman</h3>
  <p>Rp 340.000</p>
  <button onclick="addToCart('Training Pants Woman', 340000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/shortkulot.webp" alt="Short Kulot">
  <h3>Short Kulot</h3>
  <p>Rp 350.000</p>
  <button onclick="addToCart('Short Kulot', 350000)">Add to Cart</button>
</div>

    </div>
</section>

<section class="products">
    <h2>Women's Jacket Catalog</h2>
    <div class="grid">
    <div class="card">
  <img src="assets/img/cardigantebal.webp" alt="Cardigan Tebal">
  <h3>Cardigan Tebal</h3>
  <p>Rp 270.000</p>
  <button onclick="addToCart('Cardigan Tebal', 270000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/blazerformal.webp" alt="Blazer Formal">
  <h3>Blazer Formal</h3>
  <p>Rp 285.000</p>
  <button onclick="addToCart('Blazer Formal', 285000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/parkawanita.webp" alt="Parka Wanita">
  <h3>Parka Wanita</h3>
  <p>Rp 300.000</p>
  <button onclick="addToCart('Parka Wanita', 300000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/denimjacketwoman.webp" alt="Denim Jacket Woman">
  <h3>Denim Jacket Woman</h3>
  <p>Rp 315.000</p>
  <button onclick="addToCart('Denim Jacket Woman', 315000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/bombersatin.webp" alt="Bomber Satin">
  <h3>Bomber Satin</h3>
  <p>Rp 330.000</p>
  <button onclick="addToCart('Bomber Satin', 330000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/hoodiezip.webp" alt="Hoodie Zip">
  <h3>Hoodie Zip</h3>
  <p>Rp 345.000</p>
  <button onclick="addToCart('Hoodie Zip', 345000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/cropjacket.webp" alt="Crop Jacket">
  <h3>Crop Jacket</h3>
  <p>Rp 360.000</p>
  <button onclick="addToCart('Crop Jacket', 360000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/leatherjacketwoman.webp" alt="Leather Jacket Woman">
  <h3>Leather Jacket Woman</h3>
  <p>Rp 375.000</p>
  <button onclick="addToCart('Leather Jacket Woman', 375000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/kimonoouter.webp" alt="Kimono Outer">
  <h3>Kimono Outer</h3>
  <p>Rp 390.000</p>
  <button onclick="addToCart('Kimono Outer', 390000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/longcardigan.png" alt="Long Cardigan">
  <h3>Long Cardigan</h3>
  <p>Rp 405.000</p>
  <button onclick="addToCart('Long Cardigan', 405000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/teddyjacket.jpg" alt="Teddy Jacket">
  <h3>Teddy Jacket</h3>
  <p>Rp 420.000</p>
  <button onclick="addToCart('Teddy Jacket', 420000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/varsitywanita.webp" alt="Varsity Wanita">
  <h3>Varsity Wanita</h3>
  <p>Rp 435.000</p>
  <button onclick="addToCart('Varsity Wanita', 435000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/trenchcoat.webp" alt="Trench Coat">
  <h3>Trench Coat</h3>
  <p>Rp 450.000</p>
  <button onclick="addToCart('Trench Coat', 450000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/windbreakerwoman.webp" alt="Windbreaker Woman">
  <h3>Windbreaker Woman</h3>
  <p>Rp 465.000</p>
  <button onclick="addToCart('Windbreaker Woman', 465000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/knitjacket.webp" alt="Knit Jacket">
  <h3>Knit Jacket</h3>
  <p>Rp 480.000</p>
  <button onclick="addToCart('Knit Jacket', 480000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/pufferjacketwoman.webp" alt="Puffer Jacket Woman">
  <h3>Puffer Jacket Woman</h3>
  <p>Rp 495.000</p>
  <button onclick="addToCart('Puffer Jacket Woman', 495000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/dustercoat.webp" alt="Duster Coat">
  <h3>Duster Coat</h3>
  <p>Rp 510.000</p>
  <button onclick="addToCart('Duster Coat', 510000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/raincoat.webp" alt="Rain Coat">
  <h3>Rain Coat</h3>
  <p>Rp 525.000</p>
  <button onclick="addToCart('Rain Coat', 525000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sweaterjacketwoman.webp" alt="Sweater Jacket Woman">
  <h3>Sweater Jacket Woman</h3>
  <p>Rp 540.000</p>
  <button onclick="addToCart('Sweater Jacket Woman', 540000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/bikerjacket.webp" alt="Biker Jacket">
  <h3>Biker Jacket</h3>
  <p>Rp 555.000</p>
  <button onclick="addToCart('Biker Jacket', 555000)">Add to Cart</button>
</div>

    </div>
</section>

<section class="products">
    <h2>Women's Shoe Catalog</h2>
    <div class="grid">
    <div class="card">
  <img src="assets/img/highheells.webp" alt="High Heels">
  <h3>High Heels</h3>
  <p>Rp 380.000</p>
  <button onclick="addToCart('High Heels', 380000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/flatshoes.webp" alt="Flat Shoes">
  <h3>Flat Shoes</h3>
  <p>Rp 400.000</p>
  <button onclick="addToCart('Flat Shoes', 400000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/wedges.webp" alt="Wedges">
  <h3>Wedges</h3>
  <p>Rp 420.000</p>
  <button onclick="addToCart('Wedges', 420000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sneakerswanita.webp" alt="Sneakers Wanita">
  <h3>Sneakers Wanita</h3>
  <p>Rp 440.000</p>
  <button onclick="addToCart('Sneakers Wanita', 440000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sandalheels.webp" alt="Sandal Heels">
  <h3>Sandal Heels</h3>
  <p>Rp 460.000</p>
  <button onclick="addToCart('Sandal Heels', 460000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/balletflats.webp" alt="Ballet Flats">
  <h3>Ballet Flats</h3>
  <p>Rp 480.000</p>
  <button onclick="addToCart('Ballet Flats', 480000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/platformshoes.webp" alt="Platform Shoes">
  <h3>Platform Shoes</h3>
  <p>Rp 500.000</p>
  <button onclick="addToCart('Platform Shoes', 500000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/ankleboots.webp" alt="Ankle Boots">
  <h3>Ankle Boots</h3>
  <p>Rp 520.000</p>
  <button onclick="addToCart('Ankle Boots', 520000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/maryjane.webp" alt="Mary Jane">
  <h3>Mary Jane</h3>
  <p>Rp 540.000</p>
  <button onclick="addToCart('Mary Jane', 540000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/mules.webp" alt="Mules">
  <h3>Mules</h3>
  <p>Rp 560.000</p>
  <button onclick="addToCart('Mules', 560000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/slingback.webp" alt="Slingback">
  <h3>Slingback</h3>
  <p>Rp 580.000</p>
  <button onclick="addToCart('Slingback', 580000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/pumps.webp" alt="Pumps">
  <h3>Pumps</h3>
  <p>Rp 600.000</p>
  <button onclick="addToCart('Pumps', 600000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sliponcanvas.webp" alt="Slip On Canvas">
  <h3>Slip On Canvas</h3>
  <p>Rp 620.000</p>
  <button onclick="addToCart('Slip On Canvas', 620000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/espadrillewedges.webp" alt="Espadrille Wedges">
  <h3>Espadrille Wedges</h3>
  <p>Rp 640.000</p>
  <button onclick="addToCart('Espadrille Wedges', 640000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/gladiatorsandal.webp" alt="Gladiator Sandal">
  <h3>Gladiator Sandal</h3>
  <p>Rp 660.000</p>
  <button onclick="addToCart('Gladiator Sandal', 660000)">Add to Cart</button>
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

<div class="card">
  <img src="assets/img/sportshoes.webp" alt="Sport Shoes">
  <h3>Sport Shoes</h3>
  <p>Rp 740.000</p>
  <button onclick="addToCart('Sport Shoes', 740000)">Add to Cart</button>
</div>

<div class="card">
  <img src="assets/img/sandalflat.webp" alt="Sandal Flat">
  <h3>Sandal Flat</h3>
  <p>Rp 760.000</p>
  <button onclick="addToCart('Sandal Flat', 760000)">Add to Cart</button>
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
