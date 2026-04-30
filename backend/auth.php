<?php
require_once 'db.php';

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($action === 'signup') {
        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');

        if (empty($name) || empty($email) || empty($password)) {
            sendJSON(['error' => 'All fields are required.'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            sendJSON(['error' => 'Invalid email format.'], 400);
        }

        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            sendJSON(['error' => 'Email already registered.'], 400);
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $phone, $address]);

        $userId = $pdo->lastInsertId();
        sendJSON([
            'success' => true,
            'user' => [
                'id' => $userId,
                'name' => $name,
                'email' => $email
            ]
        ]);
    }

    if ($action === 'login') {
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';

        if (empty($email) || empty($password)) {
            sendJSON(['error' => 'Email and password are required.'], 400);
        }

        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            sendJSON([
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ]);
        } else {
            sendJSON(['error' => 'Invalid email or password.'], 401);
        }
    }

    if ($action === 'admin_login') {
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';

        if (empty($email) || empty($password)) {
            sendJSON(['error' => 'Email and password are required.'], 400);
        }

        $stmt = $pdo->prepare("SELECT admin_id, admin_name, email, password FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && ($password === $admin['password'] || password_verify($password, $admin['password']))) {
            sendJSON([
                'success' => true,
                'admin' => [
                    'id' => $admin['admin_id'],
                    'name' => $admin['admin_name'],
                    'email' => $admin['email']
                ]
            ]);
        } else {
            sendJSON(['error' => 'Invalid admin email or password.'], 401);
        }
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
