<?php
require_once("./Model/rol.class.php");
$roles = Rol::obtenerTodxs(); // metodo estatico, son propios de la clase.

?>

<h2 style="text-align: center;">Listado de Roles</h2>
<div style="text-align: center; margin-bottom: 10px;">
    <a href="formAltaRol.php">+ Nuevo Rol</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($roles as $rol) { ?>
        <tr>
            <td><?= $rol['id'] ?></td>
            <td><?= $rol['nombre'] ?></td>
            <td>
                <!-- Botón de Editar -->
                <a href="formEditarRol.php?id=<?= $rol['id'] ?>">Editar</a>

                <!-- Botón de Eliminar con formulario POST -->
                <form action="./Controller/rol.controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="operacion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $rol['id'] ?>">
                    <button type="submit"
                        onclick="return confirm('¿Seguro que querés eliminar este rol?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>