<?php
    class Database{
        private static $instancia=null;

        private $nombre="chatbot_2";
        private $servidor="127.0.0.1";
        private $usuario="root";
        private $clave="";
        private $conexion;


        
        public function __construct(){
            try{
                $dsn="mysql:host={$this->servidor};dbname={$this->nombre};charset=utf8";
                $this->conexion=new PDO($dsn,$this->usuario,$this->clave);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                die("Error de conexion: ". $e->getMessage());
            }
        }
        public static function getInstance(){
            if(!isset(self::$instancia)){
                self::$instancia=new Database();
            }
            return self::$instancia;
        }

        public function getConnection(){
            return $this->conexion;
        }
    }
?>
