<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoría</title>
</head>
<body>
    <header>
        <h1>Formulario de Categoría</h1>
    </header>
    <main>
        <form action="./Controller/categoria.controller.php" method="POST">
            <input type="hidden" name="operacion" value="guardar" />
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required />
            <input type="submit" value="Agregar" />
        </form>
    </main>
</body>
</html>
