<?php
include "Model/rol.class.php";


if (isset($_GET['id'])) {
    $rol = Rol::obtenerPorId($_GET['id']);
    ?>
    
    <h2>Editar Rol</h2>
    <form name="formEditarRol" action="./Controller/rol.controller.php" method="POST">
        <input type="hidden" name="operacion" value="actualizar" />
        <label for="">id del Rol</label>
        <input type="text" name="id" value="<?=$rol->getId(); ?>" readonly />
        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?=$rol->getNombre(); ?>" />
        <input type="submit" value="" />
        
    </form>
    
    <?php
    print"<br> <a href='listarRol.php'>Volver</a>";

} else {
    print"<h2>No se ha encontrado el rol</h2>";
}

?>