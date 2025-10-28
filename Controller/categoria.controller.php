<?php
include "../Model/categoria.class.php";

$operacion = $_POST["operacion"];
$result = null;

if ($operacion == "guardar") {
    $categoria = new Categoria(null, $_POST['nombre']);
    $result = $categoria->guardar();

} else if ($operacion == "actualizar") {
    $categoria = new Categoria($_POST['id'], $_POST['nombre']);
    $result = $categoria->actualizar();

} else if ($operacion == "eliminar") {
    $categoria = new Categoria($_POST['id'], null);
    $result = $categoria->eliminar();
}

if ($result) {
    echo "<br> Operación exitosa.";
} else {
    echo "<br> Operación fallida.";
}
echo "<br> <a href='../listarCategoria.php'>Volver</a>";
?>
