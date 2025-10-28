<?php
require_once "database.class.php";
include_once "rol.class.php"; 
class Usuario
{
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $rol;
    private $conexion;

    // Constructor para inicializar las propiedades del usuario
    public function __construct($id = null, $nombre = null, $email = null, $password = null, $rol = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->conexion = Database::getInstance()->getConnection();
    }



    public function guardar()
    {
        //primero generamos la consulta
        $sql = "INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (?, ?, ?, ?)";
        //despues preparamos la consulta con los datos que nos pasan
        $stmt = $this->conexion->prepare($sql);
        //luego hacemos el return de los datos 
        return $stmt->execute([$this->nombre, $this->email, $this->password, $this->rol]);
    }



    public static function obtenerTodxs()
    {
        $conexion = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM usuarios";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }






    public static function obtenerPorId($id)
{
    $conexion = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM usuarios WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $rol = Rol::obtenerPorId(id: $resultado['id']); 
        return new Usuario(
            $resultado['id'],
            $resultado['nombre'],
            $resultado['email'],
            $resultado['password'],
            $rol // o 'rol' si tu columna se llama así
        );
    }
    return null;
}

public static function obtenerPorEmail($email)
{
    $conexion = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM usuarios WHERE email=?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$email]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        return new Usuario(
            $resultado['id'],
            $resultado['nombre'],
            $resultado['email'],
            $resultado['password'],
            $resultado['rol_id'] // o 'rol' si tu columna se llama así
        );
    }
    return null;
}

   public static function verificarLogin($mail, $clave)
{
    $conexion = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$mail, $clave]);

    // Traer el usuario (si existe)
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario; // Devuelve el usuario o false si no existe
}



    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
     public function getMail(){
        return $this->email;
    }
     public function getClave(){
        return $this->password;
    }
      public function getRol(){
        return $this->rol;
    }

    public function actualizar()
{
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ?, rol_id = ? WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);
    $ok = $stmt->execute([$this->nombre, $this->email, $this->password, $this->rol, $this->id]);
    return $ok;
}

public function eliminar()
{
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);
    $ok = $stmt->execute([$this->id]);
    return $ok;

}
   
}
?>