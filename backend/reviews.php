<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';
$productId = isset($_GET['productId']) ? (int)$_GET['productId'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get') {
        if (!$productId) {
            sendJSON(['error' => 'Product ID required.'], 400);
        }

        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY date DESC");
        $stmt->execute([$productId]);
        $reviews = $stmt->fetchAll();

        foreach ($reviews as &$r) {
            $r['rating'] = (int)$r['rating'];
        }

        sendJSON($reviews);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $input = json_decode(file_get_contents('php://input'), true);

        $productId = $input['productId'] ?? null;
        $name = trim($input['name'] ?? 'Guest');
        $rating = (int)($input['rating'] ?? 5);
        $text = trim($input['text'] ?? '');

        if (!$productId || empty($text)) {
            sendJSON(['error' => 'Product ID and text are required.'], 400);
        }

        $date = date('Y-m-d');

        $stmt = $pdo->prepare("INSERT INTO reviews (product_id, name, rating, text, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$productId, $name, $rating, $text, $date]);

        $reviewId = $pdo->lastInsertId();
        sendJSON([
            'success' => true,
            'review' => [
                'id' => $reviewId,
                'product_id' => $productId,
                'name' => $name,
                'rating' => $rating,
                'text' => $text,
                'date' => $date
            ]
        ]);
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
