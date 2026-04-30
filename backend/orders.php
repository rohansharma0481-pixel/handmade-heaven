<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';
$userId = isset($_GET['userId']) ? (int)$_GET['userId'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'place') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $id = $input['id'] ?? null;
        $total = $input['total'] ?? 0;
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');
        $paymentMethod = $input['paymentMethod'] ?? 'COD';
        $utrNumber = trim($input['utrNumber'] ?? '');
        $items = $input['items'] ?? [];
        $email = trim($input['email'] ?? '');
        $name = trim($input['name'] ?? '');
        $sellerId = isset($input['sellerId']) ? (int)$input['sellerId'] : 1;
        $couponCode = $input['couponCode'] ?? null;
        $discountAmount = isset($input['discountAmount']) ? (float)$input['discountAmount'] : 0.00;

        if (!$id || empty($phone) || empty($address)) {
            sendJSON(['error' => 'Missing required order details.'], 400);
        }

        try {
            $pdo->beginTransaction();

            // Find or Create user by Email
            $userId = null;
            if (!empty($email)) {
                $stmtUser = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmtUser->execute([$email]);
                $userRow = $stmtUser->fetch();
                if ($userRow) {
                    $userId = $userRow['id'];
                } else {
                    $stmtNewUser = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    $stmtNewUser->execute([$name ?: 'Guest User', $email, password_hash('temporary', PASSWORD_DEFAULT)]);
                    $userId = $pdo->lastInsertId();
                }
            }

            // Insert into orders
            $stmt = $pdo->prepare("INSERT INTO orders (id, user_id, total, status, phone, address, payment_method, utr_number, seller_id, coupon_code, discount_amount) VALUES (?, ?, ?, 'pending_approval', ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $userId, $total, $phone, $address, $paymentMethod, $utrNumber, $sellerId, $couponCode, $discountAmount]);

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
        $total = $input['total'] ?? 0;
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');
        $paymentMethod = $input['paymentMethod'] ?? 'TBD';
        $customText = $input['customText'] ?? '';
        $customImage = $input['customImage'] ?? null;
        $email = trim($input['email'] ?? '');
        $name = trim($input['name'] ?? '');
        $sellerId = isset($input['sellerId']) ? (int)$input['sellerId'] : 1;

        if (!$id || empty($phone) || empty($address)) {
            sendJSON(['error' => 'Missing required order details.'], 400);
        }

        try {
            // Find or Create user by Email
            $userId = null;
            if (!empty($email)) {
                $stmtUser = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmtUser->execute([$email]);
                $userRow = $stmtUser->fetch();
                if ($userRow) {
                    $userId = $userRow['id'];
                } else {
                    $stmtNewUser = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    $stmtNewUser->execute([$name ?: 'Guest User', $email, password_hash('temporary', PASSWORD_DEFAULT)]);
                    $userId = $pdo->lastInsertId();
                }
            }

            $stmt = $pdo->prepare("INSERT INTO orders (id, user_id, total, status, phone, address, payment_method, custom_text, custom_image, seller_id) VALUES (?, ?, ?, 'pending_review', ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $userId, $total, $phone, $address, $paymentMethod, $customText, $customImage, $sellerId]);
            sendJSON(['success' => true, 'orderId' => $id]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Custom order processing failed: ' . $e->getMessage()], 500);
        }
    }

    if ($action === 'updateStatus') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $status = $input['status'] ?? '';
        $revisionNote = $input['revisionNote'] ?? null;

        if (!$orderId || !$status) {
            sendJSON(['error' => 'Missing Order ID or Status.'], 400);
        }

        if ($revisionNote !== null) {
            $stmt = $pdo->prepare("UPDATE orders SET status = ?, revision_note = ? WHERE id = ?");
            $ok = $stmt->execute([$status, $revisionNote, $orderId]);
        } else {
            $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $ok = $stmt->execute([$status, $orderId]);
        }

        if ($ok) {
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
        $utrNumber = trim($input['utrNumber'] ?? '');

        if (!$orderId) {
            sendJSON(['error' => 'Missing Order ID.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET status = ?, payment_method = ?, utr_number = ? WHERE id = ?");
        if ($stmt->execute([$status, $paymentMethod, $utrNumber, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to update status and payment method.'], 500);
        }
    }

    if ($action === 'updateExtraCharge') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $extraCharge = isset($input['extraCharge']) ? (float)$input['extraCharge'] : 0;

        if (!$orderId) {
            sendJSON(['error' => 'Missing Order ID.'], 400);
        }

        // Update extra_charge and set status to pending_approval so customer must re-approve
        $stmt = $pdo->prepare("UPDATE orders SET extra_charge = ?, status = 'pending_approval' WHERE id = ?");
        if ($stmt->execute([$extraCharge, $orderId])) {
            // Return updated total for display
            $stmtGet = $pdo->prepare("SELECT total, extra_charge FROM orders WHERE id = ?");
            $stmtGet->execute([$orderId]);
            $row = $stmtGet->fetch();
            sendJSON(['success' => true, 'extra_charge' => (float)$row['extra_charge'], 'base_total' => (float)$row['total']]);
        } else {
            sendJSON(['error' => 'Failed to update extra charge.'], 500);
        }
    }

    if ($action === 'updateDeliveryDate') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $deliveryDate = trim($input['deliveryDate'] ?? '');

        if (!$orderId) {
            sendJSON(['error' => 'Missing Order ID.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET delivery_date = ? WHERE id = ?");
        if ($stmt->execute([$deliveryDate, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to update delivery date.'], 500);
        }
    }
    if ($action === 'markPaid') {
        $input = json_decode(file_get_contents('php://input'), true);
        $orderId = $input['orderId'] ?? null;
        $paymentDetails = trim($input['paymentDetails'] ?? '');

        if (!$orderId) {
            sendJSON(['error' => 'Missing Order ID.'], 400);
        }

        $stmt = $pdo->prepare("UPDATE orders SET payment_status = 'Paid', payment_details = ? WHERE id = ?");
        if ($stmt->execute([$paymentDetails, $orderId])) {
            sendJSON(['success' => true]);
        } else {
            sendJSON(['error' => 'Failed to mark as paid.'], 500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'getAll') {
        $sellerId = isset($_GET['sellerId']) ? (int)$_GET['sellerId'] : null;
        
        if ($sellerId) {
            $stmt = $pdo->prepare("SELECT o.*, u.name as user_name, u.email as user_email FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.seller_id = ? ORDER BY o.date DESC");
            $stmt->execute([$sellerId]);
        } else {
            $stmt = $pdo->query("SELECT o.*, u.name as user_name, u.email as user_email FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.date DESC");
        }
        $orders = $stmt->fetchAll();

        foreach ($orders as &$order) {
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
        $email = trim($_GET['email'] ?? '');
        $realUserId = null;

        // First try to find user by email (more reliable than localStorage timestamp ID)
        if (!empty($email)) {
            $stmtU = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmtU->execute([$email]);
            $uRow = $stmtU->fetch();
            if ($uRow) $realUserId = $uRow['id'];
        }

        // Fallback: try the userId param if it looks like a real DB id (small number)
        if (!$realUserId && $userId && $userId < 100000) {
            $realUserId = $userId;
        }

        if (!$realUserId) {
            sendJSON([], 200); // Return empty array instead of error
        }

        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
        $stmt->execute([$realUserId]);
        $orders = $stmt->fetchAll();

        foreach ($orders as &$order) {
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

    if ($action === 'getOrderCount') {
        if (!$userId) {
            sendJSON(['error' => 'User ID required.'], 400);
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) as order_count FROM orders WHERE user_id = ? AND status != 'Cancelled'");
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        
        sendJSON(['success' => true, 'order_count' => (int)$result['order_count']]);
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
