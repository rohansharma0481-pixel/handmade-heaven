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
            $conversation = json_encode([
                ['sender' => 'customer', 'text' => $message, 'created_at' => date('Y-m-d H:i:s')]
            ]);
            $stmt = $pdo->prepare("INSERT INTO contact_queries (name, email, subject, message, conversation) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message, $conversation]);
            sendJSON(['success' => true, 'message' => 'Query submitted successfully!']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to save query: ' . $e->getMessage()], 500);
        }
    } elseif ($action === 'saveReply') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = intval($input['id'] ?? 0);
        $reply = trim($input['reply'] ?? '');

        if ($id <= 0 || empty($reply)) {
            sendJSON(['error' => 'Invalid ID or empty reply.'], 400);
        }

        try {
            $stmtFetch = $pdo->prepare("SELECT message, reply, conversation FROM contact_queries WHERE id = ?");
            $stmtFetch->execute([$id]);
            $query = $stmtFetch->fetch();
            
            $messages = [];
            if ($query) {
                if (!empty($query['conversation'])) {
                    $messages = json_decode($query['conversation'], true);
                } else {
                    $messages[] = ['sender' => 'customer', 'text' => $query['message'], 'created_at' => 'Legacy'];
                    if (!empty($query['reply'])) {
                        $messages[] = ['sender' => 'artisan', 'text' => $query['reply'], 'created_at' => 'Legacy'];
                    }
                }
            }
            
            $messages[] = ['sender' => 'artisan', 'text' => $reply, 'created_at' => date('Y-m-d H:i:s')];
            $conversationJson = json_encode($messages);

            $stmt = $pdo->prepare("UPDATE contact_queries SET reply = ?, conversation = ? WHERE id = ?");
            $stmt->execute([$reply, $conversationJson, $id]);
            sendJSON(['success' => true, 'message' => 'Reply saved successfully!']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to save reply: ' . $e->getMessage()], 500);
        }
    } elseif ($action === 'customerReply') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = intval($input['id'] ?? 0);
        $reply = trim($input['reply'] ?? '');

        if ($id <= 0 || empty($reply)) {
            sendJSON(['error' => 'Invalid ID or empty reply.'], 400);
        }

        try {
            $stmtFetch = $pdo->prepare("SELECT message, reply, conversation FROM contact_queries WHERE id = ?");
            $stmtFetch->execute([$id]);
            $query = $stmtFetch->fetch();
            
            $messages = [];
            if ($query) {
                if (!empty($query['conversation'])) {
                    $messages = json_decode($query['conversation'], true);
                } else {
                    $messages[] = ['sender' => 'customer', 'text' => $query['message'], 'created_at' => 'Legacy'];
                    if (!empty($query['reply'])) {
                        $messages[] = ['sender' => 'artisan', 'text' => $query['reply'], 'created_at' => 'Legacy'];
                    }
                }
            }
            
            $messages[] = ['sender' => 'customer', 'text' => $reply, 'created_at' => date('Y-m-d H:i:s')];
            $conversationJson = json_encode($messages);

            $stmt = $pdo->prepare("UPDATE contact_queries SET conversation = ? WHERE id = ?");
            $stmt->execute([$conversationJson, $id]);
            sendJSON(['success' => true, 'message' => 'Reply saved successfully!']);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to save customer reply: ' . $e->getMessage()], 500);
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

    if ($action === 'getByEmail') {
        $email = trim($_GET['email'] ?? '');
        if (empty($email)) {
            sendJSON(['error' => 'Email required.'], 400);
        }
        try {
            $stmt = $pdo->prepare("SELECT * FROM contact_queries WHERE email = ? ORDER BY created_at DESC");
            $stmt->execute([$email]);
            $queries = $stmt->fetchAll();
            sendJSON($queries);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to fetch queries: ' . $e->getMessage()], 500);
        }
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
