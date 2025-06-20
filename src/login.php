<?php
include "db.php";

// Включаем буферизацию вывода для перехвата всех echo, варнингов и ошибок
ob_start();

$errorMsg = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        setcookie("user_data", $user['username'], time() + 3600, "/");

        header("Location: welcome.php");
        exit();

    } else {
        echo "<span style='color:red;'>wrong username or pass</span>";
    }
}

// Забираем всё, что было выведено (включая варнинги)
$phpErrors = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        .login-box {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 1000px;
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
        .register-link {
            margin-top: 18px;
            text-align: center;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1>Login</h1>
    <?php if (!empty($phpErrors)): ?>
        <div class="php-errors"><?= $phpErrors ?></div>
    <?php endif; ?>
    <form method="post" action="login.php" autocomplete="off">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required autofocus>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" name="login" value="Enter">
    </form>
    <div class="register-link">
        <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>
