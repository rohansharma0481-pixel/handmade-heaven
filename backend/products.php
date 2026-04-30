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
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';
            $category = isset($_GET['category']) ? trim($_GET['category']) : '';
            $minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
            $maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 999999;
            $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';
            $sellerId = isset($_GET['seller_id']) ? (int)$_GET['seller_id'] : null;

            $sql = "SELECT * FROM products WHERE price >= ? AND price <= ?";
            $params = [$minPrice, $maxPrice];

            if ($sellerId) {
                $sql .= " AND seller_id = ?";
                $params[] = $sellerId;
            }

            if (!empty($search)) {
                $sql .= " AND (name LIKE ? OR description LIKE ?)";
                $params[] = "%$search%";
                $params[] = "%$search%";
            }

            if (!empty($category)) {
                $sql .= " AND category = ?";
                $params[] = $category;
            }

            if ($sort === 'price_asc') {
                $sql .= " ORDER BY price ASC";
            } elseif ($sort === 'price_desc') {
                $sql .= " ORDER BY price DESC";
            } else {
                $sql .= " ORDER BY id DESC"; // default
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
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
        $seller_id = isset($input['seller_id']) && $input['seller_id'] !== '' ? (int)$input['seller_id'] : null;

        if (empty($name) || $price <= 0) {
            sendJSON(['error' => 'Product name and a valid price are required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category, stock, featured, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $image, $category, $stock, $featured, $seller_id]);
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
        $seller_id = isset($input['seller_id']) && $input['seller_id'] !== '' ? (int)$input['seller_id'] : null;

        if (!$pId || empty($name) || $price <= 0) {
            sendJSON(['error' => 'Valid Product ID, Name, and Price required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, image=?, category=?, stock=?, featured=?, seller_id=? WHERE id=?");
            $stmt->execute([$name, $description, $price, $image, $category, $stock, $featured, $seller_id, $pId]);
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

    if ($action === 'linkArtisan') {
        $seller_id = isset($input['seller_id']) ? (int)$input['seller_id'] : null;
        $product_ids = $input['product_ids'] ?? [];

        if (!$seller_id) {
            sendJSON(['error' => 'Seller ID required.'], 400);
        }

        try {
            if (!empty($product_ids)) {
                $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
                $stmt = $pdo->prepare("UPDATE products SET seller_id = ? WHERE id IN ($placeholders)");
                $stmt->execute(array_merge([$seller_id], $product_ids));
            }
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to link products: ' . $e->getMessage()], 500);
        }
    }
}
sendJSON(['error' => 'Invalid request.'], 400);
?>
