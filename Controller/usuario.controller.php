<?php
include "../Model/usuario.class.php";

// CAPTURAMOS LA VARIABLE OPERACION QUE VIENE DEL FORMULARIO O DEL LISTAR 
$operacion = $_POST["operacion"];

$result = null;

if ($operacion == "guardar") {
    $usu = new Usuario(null, $_POST['nombre'], $_POST['mail'], $_POST['clave'], $_POST['rol_id']);
    $result = $usu->guardar();

} elseif ($operacion == "actualizar") {
    $usu = new Usuario($_POST['id'], $_POST['nombre'], $_POST['mail'], $_POST['clave'], $_POST['rol_id']);
    $result = $usu->actualizar();

} elseif ($operacion == "eliminar") {
    $usu = new Usuario($_POST['id']);
    $result = $usu->eliminar();
}

if ($result) {
    print "<br>La operación se ejecutó con éxito.";
} else {
    print "<br>La operación no se ejecutó con éxito.";
}

print "<br><a href='../listarUsuario.php'>Volver</a>";
?>
