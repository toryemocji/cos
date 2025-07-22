<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        try {
            $stmt->execute([$username, $hashed]);
            echo "Rejestracja zakończona sukcesem!";
        } catch (PDOException $e) {
            echo "Błąd: " . $e->getMessage();
        }
    } else {
        echo "Podaj nazwę użytkownika i hasło.";
    }
}
?>
