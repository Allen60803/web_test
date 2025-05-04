<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php"); // 未登入時強制跳轉到登入頁
  exit;
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Discord風格聊天室</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="app">
    <aside class="sidebar">
      <button class="toggle-theme">🌓</button>
      <button class="logout-button" onclick="window.location.href='logout.php'">登出</button>
    </aside>
    <main class="main">
      <header class="channel-header" id="channelTitle"># 一般</header>
      <section class="chat-window">
        <div class="message-list" id="messageList"></div>
        <div class="message-input">
          <input type="text" id="messageInput" placeholder="輸入訊息並按 Enter..." />
        </div>
      </section>
    </main>
  </div>
  <script>
    window.loggedInUser = <?php echo json_encode($username); ?>;
  </script>
  <script src="main.js"></script>
</body>
</html>
