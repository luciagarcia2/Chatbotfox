<?php
include "Model/categoria.class.php";
$categorias = Categoria::obtenerTodxs();
?>

<form action="./Controller/pregunta.controller.php" method="POST">
    <input type="hidden" name="operacion" value="guardar" />
    
    <label>Texto de la Pregunta:</label>
    <input type="text" name="texto" required />

    <label>Categoría:</label>
    <select name="id_categoria" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $categoria) { ?>
            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Aceptar" />
</form>
