<?php
require_once("./Model/rol.class.php");
$roles = Rol::obtenerTodxs(); // método estático, son propios de la clase.
?>

<form name="formAltaUsu" action="./Controller/usuario.controller.php" method="POST">
    <input type="hidden" name="operacion" value="guardar" />

    <label for="">Nombre: </label>
    <input type="text" name="nombre"/>

    <label for="">Email: </label>
    <input type="text" name="mail"/>

    <label for="">Password: </label>
    <input type="text" name="clave"/>

    <label for="">Rol: </label>
    <select name="rol_id">
        <option value="">Seleccione un rol</option>
        <?php
        foreach ($roles as $rol) {
            echo "<option value='".$rol['id']."'>".$rol['nombre']."</option>";
        }
        ?>
    </select>

    <input type="submit" value="Aceptar" />
</form>
