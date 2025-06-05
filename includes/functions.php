<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function registerUser($pdo, $name, $email, $genre, $password, $confirm_password) {
    if ($password !== $confirm_password) {
        return ['success' => false, 'message' => 'Passwords do not match'];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Invalid email format'];
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'message' => 'Email already exists'];
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, genre, password) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$name, $email, $genre, $hashed_password]);
        return ['success' => true, 'message' => 'Account created successfully'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
}

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        return ['success' => true, 'message' => 'Login successful'];
    }
    return ['success' => false, 'message' => 'Invalid email or password'];
}
?>