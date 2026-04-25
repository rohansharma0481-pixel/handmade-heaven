<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get') {
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch();
            if ($product) {
                $product['featured'] = (bool)$product['featured'];
                $product['price'] = (float)$product['price'];
                $product['stock'] = (int)$product['stock'];
                sendJSON($product);
            } else {
                sendJSON(['error' => 'Product not found.'], 404);
            }
        } else {
            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll();
            foreach ($products as &$p) {
                $p['featured'] = (bool)$p['featured'];
                $p['price'] = (float)$p['price'];
                $p['stock'] = (int)$p['stock'];
            }
            sendJSON($products);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($action === 'add') {
        $name = trim($input['name'] ?? '');
        $description = trim($input['description'] ?? '');
        $price = (float)($input['price'] ?? 0);
        $image = trim($input['image'] ?? 'images/placeholder.jpg');
        $category = trim($input['category'] ?? 'Uncategorized');
        $stock = (int)($input['stock'] ?? 0);
        $featured = (int)($input['featured'] ?? 0);

        if (empty($name) || $price <= 0) {
            sendJSON(['error' => 'Product name and a valid price are required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category, stock, featured) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $image, $category, $stock, $featured]);
            sendJSON(['success' => true, 'id' => $pdo->lastInsertId()]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to add product: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'edit') {
        $pId = (int)($input['id'] ?? 0);
        $name = trim($input['name'] ?? '');
        $description = trim($input['description'] ?? '');
        $price = (float)($input['price'] ?? 0);
        $image = trim($input['image'] ?? '');
        $category = trim($input['category'] ?? '');
        $stock = (int)($input['stock'] ?? 0);
        $featured = (int)($input['featured'] ?? 0);

        if (!$pId || empty($name) || $price <= 0) {
            sendJSON(['error' => 'Valid Product ID, Name, and Price required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, image=?, category=?, stock=?, featured=? WHERE id=?");
            $stmt->execute([$name, $description, $price, $image, $category, $stock, $featured, $pId]);
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to update product: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'delete') {
        $pId = (int)($input['id'] ?? 0);
        if (!$pId) {
            sendJSON(['error' => 'Product ID required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
            $stmt->execute([$pId]);
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to delete product: ' . $e->getMessage()], 500);
        }
    }
}
sendJSON(['error' => 'Invalid request.'], 400);
?>
