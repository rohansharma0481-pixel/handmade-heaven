<?php
require_once 'backend/db.php';
try {
    $stmt = $pdo->query("SELECT id, name, seller_id FROM products LIMIT 5");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {}
?>
