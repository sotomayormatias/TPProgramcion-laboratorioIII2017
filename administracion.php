<?php 
include "clases/usuario.php";
include "clases/conexion.php";

$accion = isset($_POST['accion']) ? $_POST['accion'] : NULL;

switch($accion){
    case "login":
    $response["exito"] = TRUE;
    $response["mensaje"] = "";

    $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
    
    $usuario = Usuario::TraerUsuarioPorCorreo($obj->email);

    if($usuario->getCorreo() != $obj->email){
        $response["exito"] = FALSE;
        $response["mensaje"] = "El usuario no existe";
    }
    else if($usuario->getPassword() != $obj->password){
        $response["exito"] = FALSE;
        $response["mensaje"] = "El password es incorrecto";
    }

    echo json_encode($response);
}
?>