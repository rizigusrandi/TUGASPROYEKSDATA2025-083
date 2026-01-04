<?php
session_start();

$nik = $_POST['nik'];
$nama = strtoupper($_POST['nama']);
$tempat_lahir = strtoupper($_POST['tempat_lahir']);
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = strtoupper($_POST['alamat']);
$rt_rw = $_POST['rt_rw'];
$kel_desa = strtoupper($_POST['kel_desa']);
$kecamatan = strtoupper($_POST['kecamatan']);
$agama = $_POST['agama'];
$status_perkawinan = $_POST['status_perkawinan'];
$pekerjaan = strtoupper($_POST['pekerjaan']);
$kewarganegaraan = $_POST['kewarganegaraan'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate password match
if($password !== $confirm_password) {
    header("Location: register.php?error=password_mismatch");
    exit;
}

// Validate password requirements
if(strlen($password) < 8) {
    header("Location: register.php?error=password_short");
    exit;
}

if(!preg_match('/[a-zA-Z]/', $password)) {
    header("Location: register.php?error=password_no_letter");
    exit;
}

if(!preg_match('/[0-9]/', $password)) {
    header("Location: register.php?error=password_no_number");
    exit;
}

// Hash password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if NIK already exists
$file = 'data/KTP.txt';
if(file_exists($file)) {
    $content = file_get_contents($file);
    if(strpos($content, "NIK                : $nik") !== false) {
        header("Location: register.php?error=exists");
        exit;
    }
}

// Format tanggal lahir
$date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
$formatted_date = $date->format('d-m-Y');
$tempat_tgl_lahir = "$tempat_lahir, $formatted_date";

// Create KTP format
$ktp_data = "
================================================================================
                          REPUBLIK INDONESIA
                        KARTU TANDA PENDUDUK (KTP)
================================================================================

NIK                : $nik
Nama               : $nama
Tempat/Tgl Lahir   : $tempat_tgl_lahir
Jenis Kelamin      : $jenis_kelamin
Alamat             : $alamat
    RT/RW          : $rt_rw
    Kel/Desa       : $kel_desa
    Kecamatan      : $kecamatan
Agama              : $agama
Status Perkawinan  : $status_perkawinan
Pekerjaan          : $pekerjaan
Kewarganegaraan    : $kewarganegaraan

================================================================================

";

// Append to file
file_put_contents($file, $ktp_data, FILE_APPEND);

// Create customer record with hashed password
$customer_file = 'data/customers.txt';
$customer_data = "$nik|$nama|$tanggal_lahir|$hashed_password|" . date('Y-m-d H:i:s') . "\n";
file_put_contents($customer_file, $customer_data, FILE_APPEND);

header("Location: login.php?success=1");
exit;