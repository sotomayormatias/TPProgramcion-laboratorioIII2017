<?php 
include "clases/usuario.php";
include "clases/conexion.php";
session_start();

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
        else {
            $_SESSION['usuario'] = $usuario;
        }

        echo json_encode($response);
        break;

    case "getGrillaUsuarios":
        include("modulos/grillaUsuarios.php");
        break;
        
    case "getGrillaCocheras":
        include("modulos/grillaCocheras.php");
        break;

    case "getGrillaVehiculos":
        include("modulos/grillaVehiculos.php");
        break;

    case "formAltaUsuario":
        include("modulos/altaUsuario.php");
        break;

    case "agregarUsuario":
        $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

        $usuario = new Usuario(null, $obj->nombre, $obj->correo, $obj->password, $obj->rol, $obj->turno);
        Usuario::Guardar($usuario);

        include("modulos/grillaUsuarios.php");
        break;
    
    case "borrarEmpleado":
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        Usuario::Eliminar($id);
        
        include("modulos/grillaUsuarios.php");
        break;

    default:
        echo ":(";
}
?>