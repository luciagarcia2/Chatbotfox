<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alta de Usuario</title>
</head>
<body>
    <header>
        <h1>Formulario de Alta de Usuario</h1>
    </header>
    <main>
        <form name="formAltaUsu" action="./Controller/usuario.controller.php" method="POST">
            <input type="hidden" name="operacion" value="guardar" />
            
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre"/>
            
            <label for="mail">Email: </label>
            <input type="text" name="mail" id="mail"/>
            
            <label for="clave">Password: </label>
            <input type="text" name="clave" id="clave"/>
            
            <label for="rol_id">Rol: </label>
            <select name="rol_id" id="rol_id">
                <option value="">Seleccione un rol</option>
                <?php
                foreach ($roles as $rol) {
                    echo "<option value='".$rol['id']."'>".$rol['nombre']."</option>";
                }
                ?>
            </select>
            
            <input type="submit" value="Aceptar" />
        </form>
    </main>
</body>
</html>