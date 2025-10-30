<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Respuesta | Sistema de FAQs</title>
    <style>
        /* Estilos previos */
    </style>
</head>
<body>
    <header>
        <h1>Formulario de Respuesta</h1>
        <h2>Crear Nueva Respuesta</h2>
    </header>
    <main>
        <div class="form-container">
            <div class="form-header">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h2>Crear Nueva Respuesta</h2>
            </div>
            
            <div class="form-body">
                <form action="./Controller/respuesta.controller.php" method="POST" autocomplete="off">
                    <input type="hidden" name="operacion" value="guardar">
                    
                    <div class="form-group">
                        <label for="respuesta">Texto de la respuesta</label>
                        <textarea class="form-control" name="respuesta" id="respuesta" required rows="3" placeholder="Escriba la respuesta completa"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="pregunta_id">Pregunta asociada</label>
                        <select class="form-control" name="pregunta_id" id="pregunta_id" required>
                            <option value="" disabled selected>-- Seleccione una pregunta --</option>
                            <?php foreach ($preguntas as $pregunta): ?>
                                <option value="<?= htmlspecialchars($pregunta['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <?= htmlspecialchars($pregunta['preguntas'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Guardar Respuesta
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
