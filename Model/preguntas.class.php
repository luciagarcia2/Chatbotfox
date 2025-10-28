<?php
require_once "database.class.php";

class Pregunta {
    private $id;
    private $texto;
    private Categoria $id_categoria;
    private $conexion;

    public function __construct($id = null, $texto = null, $id_categoria = null) {
        $this->id = $id;
        $this->texto = $texto;
        $this->id_categoria = $id_categoria;
        $this->conexion = Database::getInstance()->getConnection();
    }

    public static function obtenerPorId($id) {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM preguntas WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {

            $categoria = Categoria::obtenerPorId(id: $resultado['id']); 
            return new Pregunta(
                $categoria, 
                $resultado['preguntas'],
                $resultado['id_categorias']
            );
        }
        return null;
    }

    public static function obtenerTodxs() {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM preguntas";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar() {
        $sql = "INSERT INTO preguntas (preguntas, id_categorias) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->texto, $this->id_categoria]);
    }

    public function actualizar() {
        $sql = "UPDATE preguntas SET preguntas = ?, id_categorias = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->texto, $this->id_categoria, $this->id]);
    }

    public function eliminar() {
        $sql = "DELETE FROM preguntas WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$this->id]);
    }

    public function getId() {
        return $this->id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setIdCategoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }
}
