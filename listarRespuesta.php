<?php
require_once("./Model/respuesta.class.php");

// Obtener datos del modelo
$respuestas = Respuesta::obtenerTodxs();
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Respuestas</title>
    <style>
        :root {
            --primary: #4361ee;
            --danger: #e5383b;
            --hover: #4895ef;
            --border: #e0e0e0;
            --header-bg: #f8f9fa;
        }
        
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            padding: 2rem;
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        h2 {
            color: #2b2d42;
            margin: 0;
            font-size: 1.8rem;
        }
        
        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-new:hover {
            background-color: var(--hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background: white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        th, td {
            padding: 1.2rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        
        thead {
            background-color: var(--header-bg);
        }
        
        th {
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        
        tbody tr {
            transition: background-color 0.2s;
        }
        
        tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        .actions-cell {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }
        
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-edit {
            background-color: #f8f9fa;
            border: 1px solid var(--border);
            color: #495057;
        }
        
        .btn-edit:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        
        .btn-delete {
            background: none;
            border: none;
            padding: 0;
            color: var(--danger);
            font-size: 0.9rem;
        }
        
        .btn-delete:hover {
            color: #c1121f;
            text-decoration: underline;
        }
        
        .delete-form {
            display: inline;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🗂️ Listado de Respuestas</h2>
        <a href="formAltaRespuesta.php" class="btn-new">
            <span>+</span> Nueva respuesta
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Respuesta</th>
                    <th>Pregunta asociada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($respuestas as $res): ?>
                    <tr>
                        <td><?= $res['id'] ?></td>
                        <td><?= htmlspecialchars($res['respuesta'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($res['preguntas'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions-cell">
                            <a href="formEditarRespuesta.php?id=<?= $res['id'] ?>" class="btn-action btn-edit">
                                ✏️ Editar
                            </a>
                            
                            <form 
                                action="./Controller/respuesta.controller.php" 
                                method="POST" 
                                class="delete-form"
                                onsubmit="return confirm('¿Confirmas eliminar esta respuesta?');"
                            >
                                <input type="hidden" name="operacion" value="eliminar">
                                <input type="hidden" name="id" value="<?= $res['id'] ?>">
                                <button type="submit" class="btn-action btn-delete">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>