<?php
require_once "database.class.php";

class Categoria {
    private $id;
    private $nombre;
    private $conexion;

    public function __construct($id = null, $nombre = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->conexion = Database::getInstance()->getConnection();
    }

    public static function obtenerPorId($id) {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM categorias WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return new Categoria($resultado['id'], $resultado['nombre']);
        }
        return null;
    }

    public static function obtenerTodxs() {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM categorias";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar() {
        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->nombre]);
    }

    public function actualizar() {
        $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->nombre, $this->id]);
    }

    public function eliminar() {
        $sql = "DELETE FROM categorias WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->id]);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}
?>
