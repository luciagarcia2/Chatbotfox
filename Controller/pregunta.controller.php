<?php
include "../Model/preguntas.class.php";

$operacion = $_POST["operacion"];
$result = null;

if ($operacion == "guardar") {
    $pregunta = new Pregunta(null, $_POST['texto'], $_POST['id_categoria']);
    $result = $pregunta->guardar();

} else if ($operacion == "actualizar") {
    $pregunta = new Pregunta($_POST['id'], $_POST['texto'], $_POST['id_categoria']);
    $result = $pregunta->actualizar();

} else if ($operacion == "eliminar") {
    $pregunta = new Pregunta($_POST['id'], null, null);
    $result = $pregunta->eliminar();
}

if ($result) {
    echo "<br> La operación se ejecutó con éxito.";
} else {
    echo "<br> La operación no se ejecutó con éxito.";
}
echo "<br> <a href='../listarPregunta.php'>Volver</a>";
?>
