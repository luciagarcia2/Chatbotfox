<?php 
header("Content-Type: application/json; charset=UTF-8");

require_once "./Model/respuesta.class.php";
require_once "./Model/conversacion.class.php";

// Obtener el JSON enviado
$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input["pregunta"]) || trim($input["pregunta"]) === "") {
    echo json_encode(["respuesta" => "⚠️ Por favor, escribí una pregunta."]);
    exit;
}

$pregunta = trim($input["pregunta"]);
$respuesta = Respuesta::buscar($pregunta);

// Guardar conversación
$conversacion = new Conversacion($pregunta, $respuesta);
$conversacion->guardar();

// Retornar pregunta y respuesta en JSON
echo json_encode([
    "pregunta"  => $pregunta,
    "respuesta" => $respuesta ?: "🤖 Lo siento, no encontré una respuesta relacionada."
]);
