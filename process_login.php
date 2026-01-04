<?php
session_start();

$nik = $_POST['nik'];
$password = $_POST['password'];

// Check in customers.txt (new system with hashed password)
$customer_file = 'data/customers.txt';
$found = false;

if(file_exists($customer_file)) {
    $lines = file($customer_file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line) {
        if(trim($line)) {
            $parts = explode('|', $line);
            if(count($parts) >= 4) {
                $stored_nik = $parts[0];
                $stored_nama = $parts[1];
                $stored_password = $parts[3];
                
                // Check if NIK matches
                if($stored_nik === $nik) {
                    // Verify password (support both hashed and plain text for backward compatibility)
                    if(password_verify($password, $stored_password) || $password === $stored_password) {
                        $_SESSION['nik'] = $nik;
                        $_SESSION['nama'] = $stored_nama;
                        $found = true;
                        break;
                    }
                }
            }
        }
    }
}

// If not found in new system, try old KTP.txt system (backward compatibility)
if(!$found) {
    $file_path = 'data/KTP.txt';
    
    if(file_exists($file_path)) {
        $file = file($file_path, FILE_IGNORE_NEW_LINES);
        $currentUser = [];
        
        foreach ($file as $line) {
            // Detect NIK
            if (strpos($line, 'NIK') !== false && strpos($line, ':') !== false) {
                preg_match('/:\s*(\d+)/', $line, $match);
                if(isset($match[1])) {
                    $currentUser['nik'] = trim($match[1]);
                }
            }

            // Detect Nama
            if (strpos($line, 'Nama') !== false && strpos($line, ':') !== false && !isset($currentUser['nama'])) {
                $parts = explode(':', $line, 2);
                if(isset($parts[1])) {
                    $currentUser['nama'] = trim($parts[1]);
                }
            }

            // Detect Tempat/Tgl Lahir (for old password system: DDMMYYYY)
            if (strpos($line, 'Tempat/Tgl Lahir') !== false && strpos($line, ':') !== false) {
                preg_match('/(\d{2}-\d{2}-\d{4})/', $line, $tgl);
                if(isset($tgl[0])) {
                    $currentUser['password'] = str_replace('-', '', $tgl[0]);
                }
            }

            // Check if we have complete user data
            if (isset($currentUser['nik'], $currentUser['password'], $currentUser['nama'])) {
                // Verify credentials (old system)
                if ($currentUser['nik'] === $nik && $currentUser['password'] === $password) {
                    $_SESSION['nik'] = $nik;
                    $_SESSION['nama'] = $currentUser['nama'];
                    $found = true;
                    break;
                }
                // Reset for next user
                $currentUser = [];
            }
        }
    }
}

if($found) {
    header("Location: dashboard.php");
} else {
    header("Location: login.php?error=1");
}
exit;