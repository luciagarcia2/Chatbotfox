<?php
// Controller/login.controller.php (DEBUG)
session_start();

$usuario_file = __DIR__ . '/../Model/usuario.class.php';
$database_file = __DIR__ . '/../Model/database.class.php';

// 1) ¿Existe el archivo?
if (!file_exists($usuario_file)) {
    die("ERROR: no se encuentra el archivo Model/usuario.class.php en: $usuario_file");
}
if (!file_exists($database_file)) {
    die("ERROR: no se encuentra el archivo Model/database.class.php en: $database_file");
}

// 2) Incluimos
require_once $database_file;
require_once $usuario_file;

// 3) ¿Se cargó la clase?
if (!class_exists('Usuario')) {
    die("ERROR: clase Usuario NO encontrada después del require. Verificá Model/usuario.class.php (posible parse error).");
}

// 4) ¿Existe el método validarLogin?
if (!method_exists('Usuario', 'validarLogin')) {
    $metodos = get_class_methods('Usuario') ?: [];
    die("ERROR: el método validarLogin NO existe en la clase Usuario. Métodos disponibles: " . implode(', ', $metodos));
}

// Si llegamos acá, el método existe y podemos continuar normalmente
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;
if ($operacion !== 'login') {
    $_SESSION['login_error'] = "Operación no válida.";
    header("Location: ../login.php");
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $_SESSION['login_error'] = "Complete email y contraseña.";
    header("Location: ../login.php");
    exit;
}

$usuario = Usuario::validarLogin($email, $password);
if ($usuario) {
    $_SESSION['user_id'] = $usuario->id;
    $_SESSION['user_email'] = $usuario->email;
    $_SESSION['user_nombre'] = $usuario->nombre;
    $_SESSION['user_rol'] = $usuario->rol_id;
    header("Location: ../index.html");
    exit;
} else {
    $_SESSION['login_error'] = "Email o contraseña incorrectos.";
    header("Location: ../login.php");
    exit;
}
