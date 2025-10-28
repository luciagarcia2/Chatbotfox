<?php
include "Model/pregunta.class.php";
include "Model/categoria.class.php";

$categorias = Categoria::obtenerTodxs();

if (isset($_GET['id'])) {
    $pregunta = Pregunta::obtenerPorId($_GET['id']);
?>
    <h2>Editar Pregunta</h2>
    <form action="./Controller/pregunta.controller.php" method="POST">
        <input type="hidden" name="operacion" value="actualizar" />

        <label>ID:</label>
        <input type="text" name="id" value="<?= $pregunta->getId(); ?>" readonly />

        <label>Texto:</label>
        <input type="text" name="texto" value="<?= $pregunta->getTexto(); ?>" required />

        <label>Categoría:</label>
        <select name="id_categoria" required>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $pregunta->getIdCategoria() ? 'selected' : '' ?>>
                    <?= $categoria['nombre'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Actualizar" />
    </form>
    <br><a href="listarPregunta.php">Volver</a>
<?php
} else {
    echo "<h2>No se encontró la pregunta</h2>";
}
?>
