<?php
require_once __DIR__ . "/database.class.php";

class Conversacion {
    private $preguntaUsuario;
    private $respuestaBot;
    private $conexion;

    public function __construct($preguntaUsuario = null, $respuestaBot = null) {
        $this->preguntaUsuario = $preguntaUsuario;
        $this->respuestaBot    = $respuestaBot;
        $this->conexion        = Database::getInstance()->getConnection();
    }

    public function guardar() {
        $sql  = "INSERT INTO conversaciones (pregunta_usuario, respuesta_bot, fecha_hora) VALUES (?, ?, NOW())";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->preguntaUsuario, $this->respuestaBot]);
    }

    public static function obtenerTodas() {
        $conn = Database::getInstance()->getConnection();
        $sql  = "SELECT * FROM conversaciones ORDER BY fecha_hora DESC";
        $stmt = $conn->query($sql);
        $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lista = [];
        foreach ($filas as $f) {
            $lista[] = [
                'id'               => $f['id'],
                'pregunta_usuario' => $f['pregunta_usuario'],
                'respuesta_bot'    => $f['respuesta_bot'],
                'fecha_hora'       => $f['fecha_hora']
            ];
        }
        return $lista;
    }
 /** Getters */
    public function getId() {
        return $this->id;
    }
    public function getPreguntaUsuario() {
        return $this->preguntaUsuario;
    }
    public function getRespuestaBot() {
        return $this->respuestaBot;
    }
    public function getFechaHora() {
        return $this->fechaHora;
    }
}
?>