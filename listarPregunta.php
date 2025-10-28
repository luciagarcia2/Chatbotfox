<?php
require_once("Model/preguntas.class.php");
$preguntas = Pregunta::obtenerTodxs();
?>

<h2 style="text-align: center;">Listado de Preguntas</h2>
<div style="text-align: center; margin-bottom: 10px;">
    <a href="formAltaPregunta.php">+ Nueva Pregunta</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Texto</th>
        <th>ID Categoría</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($preguntas as $pregunta) { ?>
        <tr>
            <td><?= $pregunta['id'] ?></td>
            <td><?= $pregunta['preguntas'] ?></td>
            <td><?= $pregunta['id_categorias'] ?></td>
            <td>
                <a href="formEditarPregunta.php?id=<?= $pregunta['id'] ?>">Editar</a>
                <form action="./Controller/pregunta.controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="operacion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $pregunta['id'] ?>">
                    <button type="submit" onclick="return confirm('¿Seguro que querés eliminar esta pregunta?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
