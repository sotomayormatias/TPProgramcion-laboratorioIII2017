<?php
    require '../api_rest/vendor/autoload.php';
    use Firebase\JWT\JWT;

    class AutentificadorJWT{
        private static $claveSecreta = "supercalifragilisticoespialidoso"; //esta clave tiene que ser supersecreta y compleja, y si tiene caracteres raros mejor
        private static $tipoEncriptacion = ['HS256'];

        public static function crearToken($datos){
            $ahora = time();
            $payload = array('iat' => $ahora, 
                            'exp' => $ahora + (60 * 60 * 24), 
                            'data' => $datos, 
                            'app' => "apirestjwt");

            return JWT::encode($payload, self::$claveSecreta);
        }

        public static function verificarToken($token){
            $decodificado = JWT::decode($token, self::$claveSecreta, self::$tipoEncriptacion);
        }

        public static function obtenerPayload($token){
            return JWT::decode($token, self::$claveSecreta, self::$tipoEncriptacion);
        }

        public static function obtenerData($token){
            return JWT::decode($token, self::$claveSecreta, self::$tipoEncriptacion)->data;
        }
    }
?>