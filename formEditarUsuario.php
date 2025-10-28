<?php
include "Model/usuario.class.php";


if (isset($_GET['id'])) {
    $Usu= Usuario::obtenerPorId($_GET['id']);
    ?>
    
    <h2>Editar usuario</h2>
    <form name="formEditarUsuario" action="./Controller/usuario.controller.php" method="POST">
        <input type="hidden" name="operacion" value="actualizar" />
        <label for="">id del Usuario</label>
        <input type="text" name="id" value="<?=$Usu->getId(); ?>" readonly />
        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?=$Usu->getNombre(); ?>" />
        <label for="">Email: </label>
        <input type="text" name="mail" value="<?=$Usu->getMail(); ?>" />
        <label for="">Clave </label>
        <input type="text" name="clave" value="<?=$Usu->getClave(); ?>" />
        <label for="">Rol: </label>
        <input type="text" name="rol_id" value="<?=$Usu->getRol(); ?>" />

        <input type="submit" value="" />
        
    </form>
    
    <?php
    print"<br> <a href='listarUsuario.php'>Volver</a>";

} else {
    print"<h2>No se ha encontrado el usuario</h2>";
}
