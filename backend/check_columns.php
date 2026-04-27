<?php
require_once 'db.php';
try {
    $stmt = $pdo->query("DESCRIBE contact_queries");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo implode(", ", $columns);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
