<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $userId = $input['userId'] ?? null;
    $productId = $input['productId'] ?? null;
    $itemType = $input['item_type'] ?? 'cart'; // 'cart' or 'wishlist'
    $qty = isset($input['qty']) ? (int)$input['qty'] : 1;

    if (!$userId) {
        sendJSON(['error' => 'User ID is required.'], 400);
    }

    if ($action === 'add') {
        if (!$productId) {
            sendJSON(['error' => 'Product ID is required.'], 400);
        }

        try {
            // Check if item already exists
            $stmt = $pdo->prepare("SELECT id, quantity FROM wishlist_cart WHERE user_id = ? AND product_id = ? AND item_type = ?");
            $stmt->execute([$userId, $productId, $itemType]);
            $row = $stmt->fetch();

            if ($row) {
                // Update quantity
                $newQty = $row['quantity'] + $qty;
                $stmtUpdate = $pdo->prepare("UPDATE wishlist_cart SET quantity = ? WHERE id = ?");
                $stmtUpdate->execute([$newQty, $row['id']]);
            } else {
                // Insert new item
                $stmtInsert = $pdo->prepare("INSERT INTO wishlist_cart (user_id, product_id, item_type, quantity) VALUES (?, ?, ?, ?)");
                $stmtInsert->execute([$userId, $productId, $itemType, $qty]);
            }
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to add item: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'update') {
        if (!$productId) {
            sendJSON(['error' => 'Product ID is required.'], 400);
        }

        try {
            if ($qty <= 0) {
                // Remove item if qty <= 0
                $stmtDelete = $pdo->prepare("DELETE FROM wishlist_cart WHERE user_id = ? AND product_id = ? AND item_type = ?");
                $stmtDelete->execute([$userId, $productId, $itemType]);
            } else {
                $stmtUpdate = $pdo->prepare("UPDATE wishlist_cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND item_type = ?");
                $stmtUpdate->execute([$qty, $userId, $productId, $itemType]);
            }
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to update item: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'remove') {
        if (!$productId) {
            sendJSON(['error' => 'Product ID is required.'], 400);
        }

        try {
            $stmtDelete = $pdo->prepare("DELETE FROM wishlist_cart WHERE user_id = ? AND product_id = ? AND item_type = ?");
            $stmtDelete->execute([$userId, $productId, $itemType]);
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to remove item: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'clear') {
        try {
            $stmtClear = $pdo->prepare("DELETE FROM wishlist_cart WHERE user_id = ? AND item_type = ?");
            $stmtClear->execute([$userId, $itemType]);
            sendJSON(['success' => true]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to clear items: ' . $e->getMessage()], 500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = isset($_GET['userId']) ? (int)$_GET['userId'] : null;
    $itemType = $_GET['item_type'] ?? 'cart';

    if (!$userId) {
        sendJSON([], 200); // Return empty array if no user ID
    }

    try {
        $stmt = $pdo->prepare("
            SELECT wc.id, wc.product_id, wc.quantity, wc.created_at, 
                   p.name, p.price, p.image, p.stock 
            FROM wishlist_cart wc
            JOIN products p ON wc.product_id = p.id
            WHERE wc.user_id = ? AND wc.item_type = ?
            ORDER BY wc.created_at DESC
        ");
        $stmt->execute([$userId, $itemType]);
        $items = $stmt->fetchAll();

        // Format data to match what frontend expects
        $formattedItems = [];
        foreach ($items as $item) {
            $formattedItems[] = [
                'productId' => (int)$item['product_id'],
                'qty' => (int)$item['quantity'],
                'product' => [
                    'id' => (int)$item['product_id'],
                    'name' => $item['name'],
                    'price' => (float)$item['price'],
                    'image' => $item['image'],
                    'stock' => (int)$item['stock']
                ]
            ];
        }

        sendJSON($formattedItems);
    } catch (Exception $e) {
        sendJSON(['error' => 'Failed to fetch items: ' . $e->getMessage()], 500);
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
