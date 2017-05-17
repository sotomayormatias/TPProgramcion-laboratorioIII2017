<?php
class Conexion{
    private static $_objetoConexion;
    private $_objetoPDO;

    private function __construct(){
        $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=primerParcial;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->_objetoPDO->exec("SET CHARACTER SET utf8");
    }

    public static function getConexion(){
        if(!ISSET(self::$_objetoConexion)){
            self::$_objetoConexion = new Conexion();
        }
        return self::$_objetoConexion;
    }

    public function retornarConsulta($sql){
        return $this->_objetoPDO->prepare($sql);
    }
}
?>