<?php
header('Content-Type: application/json');

require_once 'config.php';

$stmt = $pdo->query("SELECT username, message, created_at FROM messages ORDER BY created_at DESC LIMIT 20");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($messages);
?>
