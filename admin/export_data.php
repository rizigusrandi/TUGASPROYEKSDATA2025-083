<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

$type = $_GET['type'] ?? '';

if($type === 'transactions') {
    $file = '../data/transactions.txt';
    $filename = 'transactions_' . date('Y-m-d') . '.csv';
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // Header CSV
    fputcsv($output, ['Transaction ID', 'NIK', 'Customer Name', 'Total', 'Payment Method', 'Items', 'Date']);
    
    // Data
    if(file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line) {
            if(trim($line)) {
                $parts = explode('|', $line);
                if(count($parts) >= 7) {
                    fputcsv($output, $parts);
                }
            }
        }
    }
    
    fclose($output);
    exit;
    
} elseif($type === 'customers') {
    $file = '../data/customers.txt';
    $filename = 'customers_' . date('Y-m-d') . '.csv';
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // Header CSV
    fputcsv($output, ['NIK', 'Name', 'Birth Date', 'Registration Date']);
    
    // Data
    if(file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line) {
            if(trim($line)) {
                $parts = explode('|', $line);
                if(count($parts) >= 4) {
                    fputcsv($output, $parts);
                }
            }
        }
    }
    
    fclose($output);
    exit;
    
} else {
    header("Location: dashboard.php");
    exit;
}