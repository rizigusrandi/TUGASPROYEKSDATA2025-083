<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Clothing Brand</title>
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
            z-index: 10;
        }
        .password-toggle:hover {
            color: #5568d3;
        }
        .form-group input[type="password"],
        .form-group input[type="text"] {
            width: 100%;
        }
        .password-container input {
            padding-right: 45px !important;
        }
        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.85rem;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
        
        .password-requirements {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.85rem;
        }
        .requirement {
            padding: 0.3rem 0;
            color: #666;
        }
        .requirement.met {
            color: #28a745;
        }
        .requirement.met::before {
            content: "✓ ";
            font-weight: bold;
        }
        .requirement:not(.met)::before {
            content: "○ ";
            color: #999;
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
        <a href="login.php">Login</a>
    </nav>
</header>

<div class="auth-container">
    <div class="auth-box">
        <h2>📝 Create Account</h2>
        <p style="text-align: center; color: #666; margin-bottom: 1.5rem;">
            Daftar dengan data KTP Anda
        </p>
        
        <?php if(isset($_GET['error'])): ?>
            <div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                <?php 
                if($_GET['error'] == 'exists') echo '❌ NIK sudah terdaftar!';
                elseif($_GET['error'] == 'password_mismatch') echo '❌ Password dan Konfirmasi Password tidak cocok!';
                else echo '❌ Registrasi gagal!';
                ?>
            </div>
        <?php endif; ?>
        
        <form action="process_register.php" method="POST" id="registerForm">
            <div class="form-group">
                <label>📋 NIK (16 Digit)</label>
                <input type="text" name="nik" required placeholder="Masukkan NIK 16 digit" maxlength="16" pattern="\d{16}">
                <small style="color: #999;">NIK harus 16 digit angka</small>
            </div>
            
            <div class="form-group">
                <label>👤 Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama lengkap sesuai KTP">
            </div>
            
            <div class="form-group">
                <label>📍 Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required placeholder="Contoh: Jakarta">
            </div>
            
            <div class="form-group">
                <label>📅 Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required>
            </div>
            
            <div class="form-group">
                <label>⚧ Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="LAKI-LAKI">Laki-laki</option>
                    <option value="PEREMPUAN">Perempuan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>🏠 Alamat</label>
                <input type="text" name="alamat" required placeholder="Masukkan alamat lengkap">
            </div>
            
            <div class="form-group">
                <label>🏘️ RT/RW</label>
                <input type="text" name="rt_rw" required placeholder="000/000" pattern="\d{3}/\d{3}">
            </div>
            
            <div class="form-group">
                <label>🏘️ Kel/Desa</label>
                <input type="text" name="kel_desa" required placeholder="Nama Kelurahan/Desa">
            </div>
            
            <div class="form-group">
                <label>🏛️ Kecamatan</label>
                <input type="text" name="kecamatan" required placeholder="Nama Kecamatan">
            </div>
            
            <div class="form-group">
                <label>🕌 Agama</label>
                <select name="agama" required>
                    <option value="">Pilih Agama</option>
                    <option value="ISLAM">Islam</option>
                    <option value="KRISTEN">Kristen</option>
                    <option value="KATOLIK">Katolik</option>
                    <option value="HINDU">Hindu</option>
                    <option value="BUDDHA">Buddha</option>
                    <option value="KONGHUCU">Konghucu</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>💍 Status Perkawinan</label>
                <select name="status_perkawinan" required>
                    <option value="">Pilih Status</option>
                    <option value="BELUM KAWIN">Belum Kawin</option>
                    <option value="KAWIN">Kawin</option>
                    <option value="CERAI HIDUP">Cerai Hidup</option>
                    <option value="CERAI MATI">Cerai Mati</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>💼 Pekerjaan</label>
                <input type="text" name="pekerjaan" required placeholder="Contoh: PELAJAR/MAHASISWA">
            </div>
            
            <div class="form-group">
                <label>🌍 Kewarganegaraan</label>
                <input type="text" name="kewarganegaraan" value="WNI" required>
            </div>
            
            <hr style="margin: 2rem 0; border: none; border-top: 2px solid #e0e0e0;">
            
            <div style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); padding: 1.5rem; border-radius: 10px; margin-bottom: 1.5rem; border: 2px solid #667eea;">
                <h4 style="margin-top: 0; color: #667eea;">🔐 Buat Password Akun</h4>
                
                <div class="form-group">
                    <label>🔑 Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required 
                               placeholder="Minimal 8 karakter" minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'eyeIcon1')">
                            <span id="eyeIcon1">👁️</span>
                        </button>
                    </div>
                    <div id="passwordStrength" class="password-strength"></div>
                    
                    <div class="password-requirements">
                        <strong style="color: #667eea;">Syarat Password:</strong>
                        <div id="req-length" class="requirement">Minimal 8 karakter</div>
                        <div id="req-letter" class="requirement">Mengandung huruf</div>
                        <div id="req-number" class="requirement">Mengandung angka</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>🔄 Konfirmasi Password</label>
                    <div class="password-container">
                        <input type="password" id="confirm_password" name="confirm_password" required 
                               placeholder="Ketik ulang password">
                        <button type="button" class="password-toggle" onclick="togglePassword('confirm_password', 'eyeIcon2')">
                            <span id="eyeIcon2">👁️</span>
                        </button>
                    </div>
                    <div id="passwordMatch" style="margin-top: 0.5rem; font-size: 0.85rem;"></div>
                </div>
            </div>
            
            <button type="submit" class="btn-submit" id="submitBtn">
                🚀 Register Account
            </button>
        </form>
        
        <div class="auth-link" style="text-align: center; margin-top: 1.5rem;">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
</div>

<footer style="background: #333; color: white; padding: 2rem; text-align: center; margin-top: 4rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <p style="color: #999;">© 2025 Clothing Brand. All rights reserved.</p>
    </div>
</footer>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = '🙈';
    } else {
        input.type = 'password';
        icon.textContent = '👁️';
    }
}

// Password strength checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    
    // Check requirements
    const hasLength = password.length >= 8;
    const hasLetter = /[a-zA-Z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    
    // Update requirement indicators
    document.getElementById('req-length').classList.toggle('met', hasLength);
    document.getElementById('req-letter').classList.toggle('met', hasLetter);
    document.getElementById('req-number').classList.toggle('met', hasNumber);
    
    // Calculate strength
    let strength = 0;
    if (hasLength) strength++;
    if (hasLetter) strength++;
    if (hasNumber) strength++;
    if (password.length >= 12) strength++;
    if (/[!@#$%^&*]/.test(password)) strength++;
    
    // Display strength
    if (password.length === 0) {
        strengthDiv.textContent = '';
    } else if (strength <= 2) {
        strengthDiv.textContent = '🔴 Password Lemah';
        strengthDiv.className = 'password-strength strength-weak';
    } else if (strength <= 3) {
        strengthDiv.textContent = '🟡 Password Sedang';
        strengthDiv.className = 'password-strength strength-medium';
    } else {
        strengthDiv.textContent = '🟢 Password Kuat';
        strengthDiv.className = 'password-strength strength-strong';
    }
    
    checkPasswordMatch();
});

// Password match checker
document.getElementById('confirm_password').addEventListener('input', checkPasswordMatch);

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const matchDiv = document.getElementById('passwordMatch');
    
    if (confirmPassword.length === 0) {
        matchDiv.textContent = '';
        return;
    }
    
    if (password === confirmPassword) {
        matchDiv.textContent = '✅ Password cocok';
        matchDiv.style.color = '#28a745';
    } else {
        matchDiv.textContent = '❌ Password tidak cocok';
        matchDiv.style.color = '#dc3545';
    }
}

// Form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('❌ Password dan Konfirmasi Password tidak cocok!');
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        alert('❌ Password minimal 8 karakter!');
        return false;
    }
    
    if (!/[a-zA-Z]/.test(password)) {
        e.preventDefault();
        alert('❌ Password harus mengandung huruf!');
        return false;
    }
    
    if (!/[0-9]/.test(password)) {
        e.preventDefault();
        alert('❌ Password harus mengandung angka!');
        return false;
    }
});
</script>

</body>
</html>