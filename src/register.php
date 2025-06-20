<?php
include "db.php";

// Включаем буферизацию вывода для перехвата всех echo, варнингов и ошибок
ob_start();

if (isset($_POST['register'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: login.php");
        exit();
    } else {
        // Выводим ошибку в буфер, чтобы потом показать в нужном месте
        echo $result;
        echo "registration error";
    }
}

// Забираем всё, что было выведено (включая варнинги)
$phpErrors = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body {
            background: #e9f0f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-box {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 350px;
        }
        h1 {
            margin-bottom: 25px;
            text-align: center;
            color: #333;
            font-weight: 700;
        }
        .php-errors {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 14px;
            white-space: pre-wrap;
            word-break: break-word;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            border: none;
            padding: 12px 0;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-link {
            margin-top: 18px;
            text-align: center;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h1>Registration</h1>
    <?php if (!empty($phpErrors)): ?>
        <div class="php-errors"><?= $phpErrors ?></div>
    <?php endif; ?>
    <form method="post" action="register.php" autocomplete="off">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required autofocus>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" name="register" value="Register">
    </form>
    <div class="login-link">
        <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
