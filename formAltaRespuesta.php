<?php

require_once("./Model/preguntas.class.php");
$preguntas = Pregunta::obtenerTodxs();
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Respuesta | Sistema de FAQs</title>
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
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
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2>Crear Nueva Respuesta</h2>
        </div>
        
        <div class="form-body">
            <form action="./Controller/respuesta.controller.php" method="POST" autocomplete="off">
                <input type="hidden" name="operacion" value="guardar">
                
                <div class="form-group">
                    <label for="respuesta">Texto de la respuesta</label>
                    <textarea 
                        class="form-control" 
                        name="respuesta" 
                        id="respuesta" 
                        required
                        rows="3"
                        placeholder="Escriba la respuesta completa"
                    ></textarea>
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
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H16.1716C16.702 3 17.2107 3.21071 17.5858 3.58579L20.4142 6.41421C20.7893 6.78929 21 7.29799 21 7.82843V19C21 20.1046 20.1046 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Guardar Respuesta
                </button>
            </form>
        </div>
    </div>
</body>
</html>