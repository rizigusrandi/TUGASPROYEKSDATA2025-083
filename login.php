<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Clothing Brand</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            font-size: 1.2rem;
            padding: 0;
            color: #667eea;
            transition: color 0.3s;
        }
        .password-toggle:hover {
            color: #5568d3;
        }
        .form-group input[type="password"],
        .form-group input[type="text"] {
            padding-right: 45px;
        }
    </style>
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
    </nav>
</header>

<div class="auth-container">
    <div class="auth-box">
        <h2>🔐 Customer Login</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; border-left: 4px solid #e74c3c;">
                ❌ NIK atau Password salah! Silakan coba lagi.
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div style="background: #28a745; color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; border-left: 4px solid #20c997;">
                ✅ Registrasi berhasil! Silakan login dengan NIK dan Password Anda.
            </div>
        <?php endif; ?>
        
        <form action="process_login.php" method="POST">
            <div class="form-group">
                <label>📋 NIK (16 Digit)</label>
                <input type="text" name="nik" required placeholder="Masukkan NIK 16 digit" maxlength="16" pattern="\d{16}">
            </div>
            
            <div class="form-group">
                <label>🔑 Password</label>
                <div class="password-container">
                    <input type="password" id="customerPassword" name="password" required placeholder="Masukkan password Anda">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <span id="eyeIcon">👁️</span>
                    </button>
                </div>
                <small style="color: #999; font-size: 0.85rem; display: block; margin-top: 0.5rem;">
                    💡 Gunakan password yang Anda buat saat registrasi.<br>
                    Untuk akun lama: Password = Tanggal Lahir (Format: DDMMYYYY)
                </small>
            </div>
            
            <button type="submit" class="btn-submit">🚀 Login</button>
        </form>
        
        <div style="text-align: center; margin: 1.5rem 0; color: #999;">
            <span style="background: white; padding: 0 1rem; position: relative; z-index: 1;">atau</span>
            <div style="height: 1px; background: #e0e0e0; margin-top: -12px;"></div>
        </div>
        
        <div class="auth-link" style="text-align: center;">
            <p style="margin-bottom: 1rem; color: #666;">
                📝 Belum punya akun?
            </p>
            <a href="register.php" style="display: inline-block; padding: 0.8rem 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 10px; font-weight: 500;">
                Daftar dengan KTP
            </a>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e0e0e0;">
            <div class="auth-link" style="text-align: center;">
                <p style="margin-bottom: 1rem; color: #666;">
                    👨‍💼 Login sebagai Admin?
                </p>
                <a href="admin/login_admin.php" style="display: inline-block; padding: 0.8rem 2rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; text-decoration: none; border-radius: 10px; font-weight: 500;">
                    Admin Login
                </a>
            </div>
        </div>
    </div>
</div>

<footer style="background: #333; color: white; padding: 2rem; text-align: center; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <p style="color: #999;">© 2025 Clothing Brand. All rights reserved.</p>
    </div>
</footer>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('customerPassword');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        eyeIcon.textContent = '👁️';
    }
}
</script>

</body>
</html>