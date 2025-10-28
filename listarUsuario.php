<?php
require_once("./Model/usuario.class.php");
$usuarios = Usuario::obtenerTodxs(); // método estático
?>

<h2 style="text-align: center;">Listado de Usuarios</h2>
<div style="text-align: center; margin-bottom: 10px;">
    <a href="formAltaUsu.php">+ Nuevo Usuario</a>
</div>

<table border="1" cellpadding="10" cellspacing="0" style="margin: auto;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Contraseña</th>
        <th>Rol ID</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usu) { ?>
        <tr>
            <td><?= $usu['id'] ?></td>
            <td><?= $usu['nombre'] ?></td>
            <td><?= $usu['email'] ?></td>
            <td><?= $usu['password'] ?></td>
            <td><?= $usu['rol_id'] ?></td>
            <td>
                <a href="formEditarUsuario.php?id=<?= $usu['id'] ?>">Editar</a>
                |
                <form action="./Controller/usuario.controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="operacion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $usu['id'] ?>">
                    <button type="submit" onclick="return confirm('¿Seguro que querés eliminar este usuario?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
