<?php
require_once "database.class.php";

class Respuesta {
    private $id;
    private $respuesta;
    private Pregunta $pregunta_id;
    private $conexion;

    public function __construct($id = null, $respuesta = null, $pregunta_id = null) {
        $this->id = $id;
        $this->respuesta = $respuesta;
        $this->pregunta_id = $pregunta_id;
        $this->conexion = Database::getInstance()->getConnection();
    }

    public function guardar() {
        $sql = "INSERT INTO respuesta (respuesta, pregunta_id) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->respuesta, $this->pregunta_id]);
    }

    public function actualizar() {
        $sql = "UPDATE respuesta SET respuesta = ?, pregunta_id = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->respuesta, $this->pregunta_id, $this->id]);
    }

    public function eliminar() {
        $sql = "DELETE FROM respuesta WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->id]);
    }

    public static function obtenerTodxs() {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT r.id, r.respuesta, r.pregunta_id, p.preguntas 
                FROM respuesta r 
                JOIN preguntas p ON r.pregunta_id = p.id";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId($id) {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM respuesta WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {

            $pregunta = Pregunta::obtenerPorId(id: $res['id']); 

            return new Respuesta(
                $pregunta,
                $res['respuesta'],
                $res['pregunta_id']);
        }
        return null;
    }
    public static function buscar($preguntaTexto) {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT r.respuesta 
                FROM respuesta r 
                JOIN preguntas p ON r.pregunta_id = p.id 
                WHERE LOWER(p.preguntas) LIKE LOWER(?) 
                LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(["%$preguntaTexto%"]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ? $res['respuesta'] : "Lo siento, no tengo una respuesta para eso.😓";
    }


    public function getId() { return $this->id; }
    public function getTexto() { return $this->respuesta; }
    public function getPreguntaId() { return $this->pregunta_id; }
}
