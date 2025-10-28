<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            width: 300px;
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .login-box input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-box input[type="submit"]:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .logout {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="./Controller/LoginController.php?action=login">
            <input type="text" name="mail" placeholder="Email" required />
            <input type="password" name="clave" placeholder="Contraseña" required />
            <input type="submit" name="aceptar" value="Ingresar" />
        </form>

        <div class="logout">
            <a href="./Controller/LoginController.php?action=logout">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
