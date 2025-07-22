<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['haslo'] ?? '');

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // ✅ Zalogowano – zapisz do sesji i przekieruj
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: /index.php");
            exit;
        } else {
            echo "❌ Nieprawidłowy email lub hasło.";
        }
    } else {
        echo "⚠️ Wypełnij wszystkie pola.";
    }
} else {
    echo "❌ Niewłaściwa metoda żądania.";
}

