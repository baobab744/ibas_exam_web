<?php
// Проверяем, что пользователь авторизован
if (!isset($_COOKIE['user_data'])) {
    header("Location: login.php");
    exit();
}

$username = $_COOKIE['user_data'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            background: #e9f0f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            color: #333;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 30px;
        }
        a.exit-link {
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        a.exit-link:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>

    <h1>Hello, <?= htmlspecialchars($username) ?></h1>
    <a href="logout.php" class="exit-link">Exit</a>

</body>
</html>
