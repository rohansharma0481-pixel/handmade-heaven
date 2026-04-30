<?php
require_once 'db.php';

try {
    // 1. Find Mehak's seller ID
    $stmt = $pdo->prepare("SELECT id FROM sellers WHERE name LIKE '%Mehak%' LIMIT 1");
    $stmt->execute();
    $seller = $stmt->fetch();

    if ($seller) {
        $sellerId = $seller['id'];
        
        // 2. Update all products to point to Mehak
        $stmt = $pdo->prepare("UPDATE products SET seller_id = ?");
        $stmt->execute([$sellerId]);
        
        echo "SUCCESS: All products updated to Seller ID $sellerId (Mehakdeep Kaur).\n";
    } else {
        // If Mehak is not found, maybe look for the first available seller
        $stmt = $pdo->query("SELECT id, name FROM sellers LIMIT 1");
        $seller = $stmt->fetch();
        if ($seller) {
            $sellerId = $seller['id'];
            $stmt = $pdo->prepare("UPDATE products SET seller_id = ?");
            $stmt->execute([$sellerId]);
            echo "SUCCESS: Mehak not found, but all products updated to Seller '{$seller['name']}' (ID $sellerId).\n";
        } else {
            echo "ERROR: No sellers found in database.\n";
        }
    }
} catch (Exception $e) {
    echo "DB ERROR: " . $e->getMessage() . "\n";
}
?>
