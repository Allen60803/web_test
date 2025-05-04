<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require 'db.php';
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->execute([$username, $password]);

  echo "註冊成功，請<a href='login.php'>登入</a>";
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>註冊</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="register-container">
    <h1>註冊新帳號</h1>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="帳號" required>
      <input type="password" name="password" placeholder="密碼" required>
      <button type="submit">註冊</button>
    </form>
    <p>已經有帳號？<a href="login.php">點此登入</a></p>
  </div>
</body>
</html>
