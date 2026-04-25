<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'submit';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'submit') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $subject = trim($input['subject'] ?? '');
        $message = trim($input['message'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            sendJSON(['error' => 'Name, Email, and Message are required fields.'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            sendJSON(['error' => 'Invalid email format.'], 400);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO contact_queries (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            sendJSON(['success' => true, 'message' => 'Query submitted successfully!']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to save query: ' . $e->getMessage()], 500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'getAll') {
        try {
            $stmt = $pdo->query("SELECT * FROM contact_queries ORDER BY created_at DESC");
            $queries = $stmt->fetchAll();
            sendJSON($queries);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to fetch queries: ' . $e->getMessage()], 500);
        }
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
