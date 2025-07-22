<?php
require_once 'config.php';

header('Content-Type: application/json');

$stmt = $pdo->query("SELECT username, message, created_at FROM messages ORDER BY created_at DESC LIMIT 20");
$messages = $stmt->fetchAll();
echo json_encode($messages);
?>
