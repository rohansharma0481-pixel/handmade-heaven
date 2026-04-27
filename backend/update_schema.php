<?php
require_once 'db.php';
try {
    $stmt = $pdo->query("SHOW COLUMNS FROM contact_queries LIKE 'reply'");
    $exists = $stmt->fetch();
    
    if (!$exists) {
        $pdo->exec("ALTER TABLE contact_queries ADD COLUMN reply TEXT DEFAULT NULL");
        echo "Column 'reply' added successfully.";
    } else {
        echo "Column 'reply' already exists.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
