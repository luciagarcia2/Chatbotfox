<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alta de Rol</title>
</head>
<body>
    <header>
        <h1>Formulario de Alta de Rol</h1>
    </header>
    <main>
        <form name="formAltaRol" action="./Controller/rol.controller.php" method="POST">
            <input type="hidden" name="operacion" value="guardar" />
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" />
            <input type="submit" value="Aceptar" />
        </form>
    </main>
</body>
</html>