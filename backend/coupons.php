<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'validate';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'validate') {
        $input = json_decode(file_get_contents('php://input'), true);
        $code = strtoupper(trim($input['code'] ?? ''));
        $cartTotal = (float)($input['cartTotal'] ?? 0);

        if (empty($code)) {
            sendJSON(['error' => 'Coupon code is required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("SELECT * FROM coupons WHERE code = ? AND is_active = 1 AND (expiry_date IS NULL OR expiry_date >= CURDATE())");
            $stmt->execute([$code]);
            $coupon = $stmt->fetch();

            if (!$coupon) {
                sendJSON(['error' => 'Invalid or expired coupon code.'], 404);
            }

            if ($cartTotal < (float)$coupon['min_cart_value']) {
                sendJSON(['error' => 'Minimum cart value for this coupon is ₹' . $coupon['min_cart_value']], 400);
            }

            $discount = 0;
            if ($coupon['type'] === 'percent') {
                $discount = $cartTotal * ((float)$coupon['value'] / 100);
            } else {
                $discount = (float)$coupon['value'];
            }

            // Ensure discount doesn't exceed total
            if ($discount > $cartTotal) {
                $discount = $cartTotal;
            }

            sendJSON([
                'success' => true,
                'code' => $coupon['code'],
                'type' => $coupon['type'],
                'value' => (float)$coupon['value'],
                'discount' => $discount
            ]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    } elseif ($action === 'add') {
        $input = json_decode(file_get_contents('php://input'), true);
        $code = strtoupper(trim($input['code'] ?? ''));
        $type = $input['type'] ?? 'fixed';
        $value = (float)($input['value'] ?? 0);
        $minCartValue = (float)($input['minCartValue'] ?? 0);
        $expiryDate = !empty($input['expiryDate']) ? $input['expiryDate'] : null;

        if (empty($code) || $value <= 0) {
            sendJSON(['error' => 'Code and positive value are required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("SELECT id FROM coupons WHERE code = ?");
            $stmt->execute([$code]);
            if ($stmt->fetch()) {
                sendJSON(['error' => 'Coupon code already exists.'], 400);
            }

            $stmt = $pdo->prepare("INSERT INTO coupons (code, type, value, min_cart_value, expiry_date, is_active) VALUES (?, ?, ?, ?, ?, 1)");
            $stmt->execute([$code, $type, $value, $minCartValue, $expiryDate]);
            sendJSON(['success' => true, 'message' => 'Coupon created successfully.']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    } elseif ($action === 'delete') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = isset($input['id']) ? (int)$input['id'] : null;

        if (!$id) {
            sendJSON(['error' => 'Coupon ID is required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM coupons WHERE id = ?");
            $stmt->execute([$id]);
            sendJSON(['success' => true, 'message' => 'Coupon deleted successfully.']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'list') {
        try {
            $stmt = $pdo->query("SELECT * FROM coupons ORDER BY created_at DESC");
            $coupons = $stmt->fetchAll();
            sendJSON($coupons);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to fetch coupons: ' . $e->getMessage()], 500);
        }
    }
}
?>
