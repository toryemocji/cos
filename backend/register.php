<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $email && $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $hashed]);
            echo "Rejestracja zakończona sukcesem!";
        } catch (PDOException $e) {
            echo "Błąd: " . $e->getMessage();
        }
    } else {
        echo "Podaj nazwę użytkownika, email i hasło.";
    }
} else {
    echo "Metoda żądania musi być POST.";
}
?>
