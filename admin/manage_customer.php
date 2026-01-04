<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'delete_customer') {
    $nik = $_POST['nik'];
    
    // 1. Delete from customers.txt
    $customers_file = '../data/customers.txt';
    $customers = [];
    $deleted = false;
    
    if (file_exists($customers_file)) {
        $lines = file($customers_file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            if (trim($line)) {
                $parts = explode('|', $line);
                if (count($parts) >= 4) {
                    // Keep all customers except the one to delete
                    if ($parts[0] !== $nik) {
                        $customers[] = $line;
                    } else {
                        $deleted = true;
                    }
                }
            }
        }
    }
    
    if ($deleted) {
        // Save updated customers list
        file_put_contents($customers_file, implode("\n", $customers) . "\n");
        
        // 2. Delete from KTP.txt
        $ktp_file = '../data/KTP.txt';
        if (file_exists($ktp_file)) {
            $ktp_content = file_get_contents($ktp_file);
            $ktp_blocks = explode("================================================================================\n\n", $ktp_content);
            $new_ktp_content = '';
            
            foreach ($ktp_blocks as $block) {
                if (trim($block) && strpos($block, "NIK                : $nik") === false) {
                    $new_ktp_content .= $block . "================================================================================\n\n";
                }
            }
            
            file_put_contents($ktp_file, $new_ktp_content);
        }
        
        // 3. Delete transactions related to this customer
        $trans_file = '../data/transactions.txt';
        $transactions = [];
        
        if (file_exists($trans_file)) {
            $lines = file($trans_file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                if (trim($line)) {
                    $parts = explode('|', $line);
                    // Keep transactions not from this customer
                    if (count($parts) >= 7 && $parts[1] !== $nik) {
                        $transactions[] = $line;
                    }
                }
            }
            file_put_contents($trans_file, implode("\n", $transactions) . "\n");
        }
        
        // 4. Delete transaction details
        $trans_detail_file = '../data/transaction_details.txt';
        if (file_exists($trans_detail_file)) {
            // Get all transaction IDs from this customer
            $customer_trans_ids = [];
            if (file_exists($trans_file)) {
                $lines = file($trans_file, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    if (trim($line)) {
                        $parts = explode('|', $line);
                        if (count($parts) >= 7 && $parts[1] === $nik) {
                            $customer_trans_ids[] = $parts[0];
                        }
                    }
                }
            }
            
            // Remove details for those transactions
            $details = [];
            $lines = file($trans_detail_file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                if (trim($line)) {
                    $parts = explode('|', $line);
                    if (count($parts) >= 1 && !in_array($parts[0], $customer_trans_ids)) {
                        $details[] = $line;
                    }
                }
            }
            file_put_contents($trans_detail_file, implode("\n", $details) . "\n");
        }
        
        // 5. Delete receipts
        $receipts_dir = '../receipts/';
        if (is_dir($receipts_dir)) {
            $files = scandir($receipts_dir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filepath = $receipts_dir . $file;
                    if (is_file($filepath)) {
                        $content = file_get_contents($filepath);
                        if (strpos($content, "NIK            : $nik") !== false) {
                            unlink($filepath);
                        }
                    }
                }
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Customer deleted successfully'
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Customer not found'
        ]);
    }
    exit;
    
} else {
    header("Location: dashboard.php");
    exit;
}