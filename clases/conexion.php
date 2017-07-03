<?php
class Conexion{
    private static $_objetoConexion;
    private $_objetoPDO;

    private function __construct(){
        $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=estacionamiento;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // $this->_objetoPDO = new PDO('mysql:host=mysql.hostinger.com.ar;dbname=u497458896_tp;charset=utf8', 'u497458896_tp', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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