<?php
require_once 'db.php';

// 1. Create sellers table
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS sellers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        bio TEXT,
        image VARCHAR(255)
    )");
    echo "Table 'sellers' created or already exists.<br>";
} catch (Exception $e) {
    echo "Sellers table error: " . $e->getMessage() . "<br>";
}

// 2. Seed default seller if not exists
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM sellers WHERE id = 1");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO sellers (id, name, bio, image) VALUES (1, 'Handmade Heaven Artisan', 'Creating beautiful handmade crafts with love and care.', 'images/artisan1.jpg')");
        $pdo->exec("INSERT INTO sellers (name, bio, image) VALUES ('Crafty Queen', 'Specialist in clay art and customized gifts.', 'images/artisan2.jpg')");
        echo "Default sellers seeded.<br>";
    } else {
        echo "Default sellers already exist.<br>";
    }
} catch (Exception $e) {
    echo "Seeding sellers error: " . $e->getMessage() . "<br>";
}

// 3. Add seller_id to products if not exists
try {
    $stmt = $pdo->query("SHOW COLUMNS FROM products LIKE 'seller_id'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE products ADD COLUMN seller_id INT DEFAULT 1");
        $pdo->exec("ALTER TABLE products ADD CONSTRAINT fk_product_seller FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE SET NULL");
        echo "Column 'seller_id' added to products.<br>";
    } else {
        echo "Column 'seller_id' already exists in products.<br>";
    }
} catch (Exception $e) {
    echo "Adding seller_id error: " . $e->getMessage() . "<br>";
}

// 4. Create coupons table
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS coupons (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(50) NOT NULL UNIQUE,
        type ENUM('percent', 'flat') NOT NULL,
        value DECIMAL(10, 2) NOT NULL,
        min_cart_value DECIMAL(10, 2) DEFAULT 0,
        expiry_date DATE,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table 'coupons' created or already exists.<br>";
} catch (Exception $e) {
    echo "Coupons table error: " . $e->getMessage() . "<br>";
}

// Seed some coupons
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM coupons");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO coupons (code, type, value, min_cart_value, expiry_date) VALUES 
            ('WELCOME10', 'percent', 10.00, 0.00, '2026-12-31'),
            ('FLAT50', 'flat', 50.00, 500.00, '2026-12-31')");
        echo "Sample coupons seeded.<br>";
    } else {
        echo "Coupons already exist.<br>";
    }
} catch (Exception $e) {
    echo "Seeding coupons error: " . $e->getMessage() . "<br>";
}

// 5. Add coupon_code and discount_amount to orders if not exists
try {
    $stmt = $pdo->query("SHOW COLUMNS FROM orders LIKE 'coupon_code'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE orders ADD COLUMN coupon_code VARCHAR(50) DEFAULT NULL");
        $pdo->exec("ALTER TABLE orders ADD COLUMN discount_amount DECIMAL(10, 2) DEFAULT 0.00");
        echo "Columns 'coupon_code' and 'discount_amount' added to orders.<br>";
    } else {
        echo "Columns 'coupon_code' already exist in orders.<br>";
    }
} catch (Exception $e) {
    echo "Adding order columns error: " . $e->getMessage() . "<br>";
}

echo "Migration script finished.";
?>
