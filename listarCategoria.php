<?php
require_once("Model/categoria.class.php");
$categorias = Categoria::obtenerTodxs();
?>

<h2 style="text-align: center;">Listado de Categorías</h2>
<div style="text-align: center; margin-bottom: 10px;">
    <a href="formAltaCategoria.php">+ Nueva Categoría</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre categorías</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($categorias as $categoria) { ?>
        <tr>
            <td><?= $categoria['id'] ?></td>
            <td><?= $categoria['nombre'] ?></td>
            <td>
                <a href="formEditarCategoria.php?id=<?= $categoria['id'] ?>">Editar</a>
                <form action="./Controller/categoria.controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="operacion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                    <button type="submit" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
