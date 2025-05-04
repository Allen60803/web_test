<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user'] = $user['username'];
  header("Location: index.php"); // 登入成功，跳轉至聊天頁面
} else {
  echo "登入失敗，請檢查帳號密碼";
  echo "<a href='login.php'>返回登入頁</a>";
}
