<?php 
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/Login.css" />
    <title>Login</title>
</head>
<body>
    <div class="contenedor-login">
        <!-- 🦊 Mascota lateral -->
        <img src="./css/fox.png" 
             alt="Mascota Fox" class="mascota lado">

        <!-- Caja del login -->
        <div class="login-box">
            <h2>Iniciar sesión</h2>

            <?php if ($error): ?>
                <p class="error" role="alert"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" action="./Controller/LoginController.php?action=login">
                <div class="campo">
                    <label for="mail">Correo electrónico</label>
                    <input type="text" id="mail" name="mail" placeholder="Ej: usuario@correo.com" required autocomplete="username" />
                </div>

                <div class="campo">
                    <label for="clave">Contraseña</label>
                    <input type="password" id="clave" name="clave" placeholder="Tu contraseña" required autocomplete="current-password" />
                </div>

                <input type="submit" name="aceptar" value="Ingresar" />
            </form>

            <div class="logout">
                <a href="./Controller/LoginController.php?action=logout">Cerrar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>