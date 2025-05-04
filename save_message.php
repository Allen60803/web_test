<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['user'], $data['content'], $data['channel'])) {
  http_response_code(400);
  echo json_encode(['error' => '資料不完整']);
  exit;
}

$user = $data['user'];
$content = $data['content'];
$channel = $data['channel'];

$stmt = $pdo->prepare("INSERT INTO messages (user, content, channel, timestamp) VALUES (?, ?, ?, NOW())");
$stmt->execute([$user, $content, $channel]);

echo json_encode(['success' => true]);
?>