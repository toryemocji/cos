<?php
session_start();

if (!isset($_SESSION['username'])) {
    http_response_code(403);
    echo "Brak dostępu";
    exit;
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $stmt->execute([$username, $message]);
    }
}
?>

