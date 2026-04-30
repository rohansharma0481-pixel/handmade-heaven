<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'get';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get') {
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM sellers WHERE id = ?");
            $stmt->execute([$id]);
            $seller = $stmt->fetch();
            if ($seller) {
                sendJSON($seller);
            } else {
                sendJSON(['error' => 'Artisan not found.'], 404);
            }
        } else {
            $stmt = $pdo->query("SELECT * FROM sellers");
            $sellers = $stmt->fetchAll();
            sendJSON($sellers);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($action === 'add') {
        $name = trim($input['name'] ?? '');
        $bio = trim($input['bio'] ?? '');
        $image = trim($input['image'] ?? 'images/placeholder.jpg');

        if (empty($name)) {
            sendJSON(['error' => 'Artisan name is required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO sellers (name, bio, image) VALUES (?, ?, ?)");
            $stmt->execute([$name, $bio, $image]);
            sendJSON(['success' => true, 'message' => 'Artisan added successfully.']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    } elseif ($action === 'delete') {
        $id = isset($input['id']) ? (int)$input['id'] : null;

        if (!$id) {
            sendJSON(['error' => 'Artisan ID is required.'], 400);
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM sellers WHERE id = ?");
            $stmt->execute([$id]);
            sendJSON(['success' => true, 'message' => 'Artisan deleted successfully.']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }
}
?>
