<?php
require 'db.php';

$channel = $_GET['channel'] ?? 'general';
$after = intval($_GET['after'] ?? 0);

$stmt = $pdo->prepare("SELECT id, user, content FROM messages WHERE channel = ? AND id > ? ORDER BY id ASC");
$stmt->execute([$channel, $after]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($messages);
?>