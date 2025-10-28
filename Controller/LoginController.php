<?php
session_start();
require_once "../Model/usuario.class.php";

class LoginController
{
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['aceptar'])) {
            $mail = trim($_POST['mail']);
            $clave = trim($_POST['clave']);

            $usuario = Usuario::verificarLogin($mail, $clave);

            if (!$usuario) {
                $_SESSION['error'] = "Usuario o contraseña incorrectos.";
                header("Location: ../Login.php");
                exit();
            }

            // Guardar usuario en sesión
            $_SESSION['usuario'] = [
                "id" => $usuario['id'],
                "nombre" => $usuario['nombre'],
                "email" => $usuario['email'],
                "rol" => $usuario['rol_id']
            ];

            // Redirige SIEMPRE al index de tu proyecto
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../Login.php");
            exit();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../Login.php");
        exit();
    }
}

// --- Enrutador ---
$controller = new LoginController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $controller->login();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            header("Location: ../Login.php");
            exit();
    }
} else {
    header("Location: ../Login.php");
    exit();
}
