<?php
include "Model/categoria.class.php";

if (isset($_GET['id'])) {
    $categoria = Categoria::obtenerPorId($_GET['id']);
?>
    <h2>Editar Categoría</h2>
    <form action="./Controller/categoria.controller.php" method="POST">
        <input type="hidden" name="operacion" value="actualizar" />
        <label>ID:</label>
        <input type="text" name="id" value="<?= $categoria->getId(); ?>" readonly />
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $categoria->getNombre(); ?>" required />
        <input type="submit" value="Actualizar" />
    </form>
    <br><a href="listarCategoria.php">Volver</a>
<?php } else {
    echo "<h2>No se encontró la categoría</h2>";
}
?>
