<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';
$userId = isset($_GET['userId']) ? (int)$_GET['userId'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'place') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $id = $input['id'] ?? null;
        $userId = $input['user_id'] ?? null;
        $total = $input['total'] ?? 0;
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');
        $paymentMethod = $input['paymentMethod'] ?? 'COD';
        $items = $input['items'] ?? [];

        if (!$id || empty($phone) || empty($address)) {
            sendJSON(['error' => 'Missing required order details.'], 400);
        }

        try {
            $pdo->beginTransaction();

            // Insert into orders
            $stmt = $pdo->prepare("INSERT INTO orders (id, user_id, total, status, phone, address, payment_method) VALUES (?, ?, ?, 'pending_approval', ?, ?, ?)");
            $stmt->execute([$id, $userId, $total, $phone, $address, $paymentMethod]);

            // Insert items and update stock
            $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
            $stmtStock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?");

            foreach ($items as $item) {
                $pId = $item['productId'];
                $qty = $item['qty'];
                $price = $item['price'];

                // Insert item
                $stmtItem->execute([$id, $pId, $qty, $price]);

                // Deduct stock
                $stmtStock->execute([$qty, $pId, $qty]);
                if ($stmtStock->rowCount() === 0) {
                    $pdo->rollBack();
                    sendJSON(['error' => "Insufficient stock for product ID $pId."], 400);
                }
            }

            $pdo->commit();
            sendJSON(['success' => true, 'orderId' => $id]);
        } catch (Exception $e) {
            $pdo->rollBack();
            sendJSON(['error' => 'Order processing failed: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'placeCustom') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $id = $input['id'] ?? null;
        $userId = $input['user_id'] ?? null;
        $total = $input['total'] ?? 0;
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');
        $paymentMethod = $input['paymentMethod'] ?? 'TBD';
        $customText = $input['customText'] ?? '';
        $customImage = $input['customImage'] ?? null;

        if (!$id || empty($phone) || empty($address)) {
            sendJSON(['error' => 'Missing required order details.'], 400);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO orders (id, user_id, total, status, phone, address, payment_method, custom_text, custom_image) VALUES (?, ?, ?, 'pending_review', ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $userId, $total, $phone, $address, $paymentMethod, $customText, $customImage]);
            sendJSON(['success' => true, 'orderId' => $id]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Custom order processing failed: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'updateStatus') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $status = $input['status'] ?? '';

        if (!$orderId || !$status) {
            sendJSON(['error' => 'Missing Order ID or Status.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to update status.'], 500);
        }
    }

    if ($action === 'updatePreview') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $previewImage = $input['previewImage'] ?? '';

        if (!$orderId || !$previewImage) {
            sendJSON(['error' => 'Missing Order ID or Preview Image.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET preview_image = ?, status = 'pending_approval' WHERE id = ?");
        if ($stmt->execute([$previewImage, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to update preview image.'], 500);
        }
    }

    if ($action === 'confirmAndPay') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $status = $input['status'] ?? 'Processing';
        $paymentMethod = $input['paymentMethod'] ?? 'COD';

        if (!$orderId) {
            sendJSON(['error' => 'Missing Order ID.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET status = ?, payment_method = ? WHERE id = ?");
        if ($stmt->execute([$status, $paymentMethod, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to update status and payment method.'], 500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'getAll') {
        $stmt = $pdo->query("SELECT o.*, u.name as user_name, u.email as user_email FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.date DESC");
        $orders = $stmt->fetchAll();

        foreach ($orders as &$order) {
            $order['id'] = (int)$order['id'];
            $order['total'] = (float)$order['total'];
            
            $stmtItems = $pdo->prepare("SELECT oi.*, p.name, p.image FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
            $stmtItems->execute([$order['id']]);
            $order['items'] = $stmtItems->fetchAll();
            
            foreach ($order['items'] as &$item) {
                $item['price'] = (float)$item['price'];
                $item['qty'] = (int)$item['qty'];
            }
        }
        sendJSON($orders);
    }

    if ($action === 'get') {
        if (!$userId) {
            sendJSON(['error' => 'User ID required.'], 400);
        }

        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll();

        foreach ($orders as &$order) {
            $order['id'] = (int)$order['id'];
            $order['total'] = (float)$order['total'];
            
            $stmtItems = $pdo->prepare("SELECT oi.*, p.name, p.image FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
            $stmtItems->execute([$order['id']]);
            $order['items'] = $stmtItems->fetchAll();
            
            foreach ($order['items'] as &$item) {
                $item['price'] = (float)$item['price'];
                $item['qty'] = (int)$item['qty'];
            }
        }

        sendJSON($orders);
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
