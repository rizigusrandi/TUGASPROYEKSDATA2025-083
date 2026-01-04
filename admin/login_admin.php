<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Clothing Brand</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <a href="../index.php">Home</a>
        <a href="../allproduct.php">All Products</a>
        <a href="../login.php">Customer Login</a>
    </nav>
</header>

<div class="auth-container">
    <div class="auth-box">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="display: inline-block; padding: 1rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; margin-bottom: 1rem;">
                <span style="font-size: 2rem;">👨‍💼</span>
            </div>
            <h2 style="margin: 0;">Admin Login</h2>
            <p style="color: #999; margin-top: 0.5rem;">Akses Panel Administrator</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; border-left: 4px solid #e74c3c;">
                ❌ Username atau Password salah! Silakan coba lagi.
            </div>
        <?php endif; ?>
        
        <!-- Info Box untuk Admin Credentials -->
        <div style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); border: 2px solid #667eea; padding: 1.5rem; border-radius: 10px; margin-bottom: 1.5rem;">
            <h4 style="margin-top: 0; color: #667eea; display: flex; align-items: center;">
                <span style="margin-right: 0.5rem;">💡</span>
                Default Admin Credentials
            </h4>
            <div style="background: white; padding: 1rem; border-radius: 8px; margin-top: 1rem;">
                <p style="margin: 0.5rem 0; font-family: 'Courier New', monospace;">
                    <strong>Username:</strong> <code style="background: #f8f9fa; padding: 0.3rem 0.6rem; border-radius: 4px; color: #667eea;">admin</code>
                </p>
                <p style="margin: 0.5rem 0; font-family: 'Courier New', monospace;">
                    <strong>Password:</strong> <code style="background: #f8f9fa; padding: 0.3rem 0.6rem; border-radius: 4px; color: #667eea;">admin123</code>
                </p>
            </div>
            <p style="margin-top: 1rem; margin-bottom: 0; color: #666; font-size: 0.85rem;">
                ⚠️ <strong>Penting:</strong> Ganti password default setelah login pertama untuk keamanan sistem.
            </p>
        </div>
        
        <form action="process_login_admin.php" method="POST">
            <div class="form-group">
                <label>👤 Username</label>
                <input type="text" name="username" required placeholder="Masukkan username admin" autocomplete="username">
            </div>
            
            <div class="form-group">
                <label>🔒 Password</label>
                <div class="password-container">
                    <input type="password" id="adminPassword" name="password" required placeholder="Masukkan password admin" autocomplete="current-password">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <span id="eyeIcon">👁️</span>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-submit" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                🚀 Login as Admin
            </button>
        </form>
        
        <div style="text-align: center; margin: 1.5rem 0; color: #999;">
            <span style="background: white; padding: 0 1rem; position: relative; z-index: 1;">atau</span>
            <div style="height: 1px; background: #e0e0e0; margin-top: -12px;"></div>
        </div>
        
        <div class="auth-link" style="text-align: center;">
            <p style="margin-bottom: 1rem; color: #666;">
                👤 Bukan admin?
            </p>
            <a href="../login.php" style="display: inline-block; padding: 0.8rem 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 10px; font-weight: 500;">
                Customer Login
            </a>
        </div>
        
        <!-- Security Notice -->
        <div style="margin-top: 2rem; padding: 1rem; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 8px;">
            <p style="margin: 0; color: #856404; font-size: 0.9rem;">
                🔒 <strong>Keamanan:</strong> Halaman ini hanya untuk administrator resmi. Akses tidak sah akan dicatat dan dilaporkan.
            </p>
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
    const passwordInput = document.getElementById('adminPassword');
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