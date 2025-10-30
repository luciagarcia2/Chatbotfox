<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Pregunta</title>
</head>
<body>
    <header>
        <h1>Formulario de Pregunta</h1>
    </header>
    <main>
        <form action="./Controller/pregunta.controller.php" method="POST">
            <input type="hidden" name="operacion" value="guardar" />
            
            <label for="texto">Texto de la Pregunta:</label>
            <input type="text" name="texto" id="texto" required />

            <label for="id_categoria">Categoría:</label>
            <select name="id_categoria" id="id_categoria" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria) { ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                <?php } ?>
            </select>

            <input type="submit" value="Aceptar" />
        </form>
    </main>
</body>
</html>
