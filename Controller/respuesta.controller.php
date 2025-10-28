<?php
include "../Model/respuesta.class.php";

$operacion = $_POST["operacion"];
$result = null;

if ($operacion == "guardar") {
    $res = new Respuesta(null, $_POST['respuesta'], $_POST['pregunta_id']);
    $result = $res->guardar(); 

} elseif ($operacion == "actualizar") {
    $res = new Respuesta($_POST['id'], $_POST['texto'], $_POST['pregunta_id']);
    $result = $res->actualizar();

} elseif ($operacion == "eliminar") {
    $res = new Respuesta($_POST['id']);
    $result = $res->eliminar();
}

if ($result) {
    print "<br>La operación se ejecutó con éxito.";
} else {
    print "<br>La operación no se ejecutó con éxito.";
}

print "<br><a href='../listarRespuesta.php'>Volver</a>";
