<?php

require_once("./Model/preguntas.class.php");
require_once("./Model/respuesta.class.php");

// Validación estricta del ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die('<div class="error-alert">❌ Error: ID de respuesta no válido</div>');
}

$id = (int)$_GET['id'];
$respuestaObj = Respuesta::obtenerPorId($id);

if (!$respuestaObj) {
    die('<div class="error-alert">❌ Error: La respuesta solicitada no existe</div>');
}

$preguntas = Pregunta::obtenerTodxs();
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Respuesta | Sistema de FAQs</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --danger: #e5383b;
            --light-bg: #f8f9fa;
            --border: #dee2e6;
            --text-muted: #6c757d;
        }
        
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            background-color: #f1f5f9;
            color: #212529;
            line-height: 1.6;
            padding: 2rem;
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .form-header {
            padding: 1.5rem;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .form-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #343a40;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .error-alert {
            padding: 1rem;
            background-color: #fee2e2;
            color: var(--danger);
            border-radius: 6px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--danger);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .form-container {
                border-radius: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9L9 12.1716L17.5858 3.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2>Editar Respuesta</h2>
        </div>
        
        <div class="form-body">
            <form action="./Controller/respuesta.controller.php" method="POST" autocomplete="off">
                <input type="hidden" name="operacion" value="actualizar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($respuestaObj->getId(), ENT_QUOTES, 'UTF-8') ?>">
                
                <div class="form-group">
                    <label for="respuesta">Texto de la respuesta</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="texto" 
                        id="respuesta" 
                        required
                        placeholder="Escriba la respuesta completa"
                        value="<?= htmlspecialchars($respuestaObj->getTexto(), ENT_QUOTES, 'UTF-8') ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="pregunta_id">Pregunta asociada</label>
                    <select class="form-control" name="pregunta_id" id="pregunta_id" required>
                        <option value="" disabled>-- Seleccione una pregunta --</option>
                        <?php foreach ($preguntas as $pregunta): ?>
                            <option 
                                value="<?= htmlspecialchars($pregunta['id'], ENT_QUOTES, 'UTF-8') ?>"
                                <?= $pregunta['id'] == $respuestaObj->getPreguntaId() ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($pregunta['preguntas'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Actualizar Respuesta
                </button>
            </form>
        </div>
    </div>
</body>
</html>