<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// 載入 .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$databaseUrl = $_ENV['DATABASE_URL'] ?? '';

try {
    if (!$databaseUrl) {
        throw new Exception("未設定 DATABASE_URL");
    }

    // 使用正則解析 DATABASE_URL
    $pattern = '/^postgres(?:ql)?:\/\/([^:]+):([^@]+)@([^:]+):(\d+)\/(.+)$/';
    if (!preg_match($pattern, $databaseUrl, $matches)) {
        throw new Exception("DATABASE_URL 格式錯誤，無法解析");
    }

    list(, $user, $pass, $host, $port, $dbname) = $matches;

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ 資料庫連線成功";
} catch (Exception $e) {
    echo "❌ 資料庫連線失敗: " . $e->getMessage();
}
?>