<?php 
include_once "clases/usuario.php";
include_once "clases/conexion.php";
// session_start();

$accion = isset($_POST['accion']) ? $_POST['accion'] : NULL;

switch($accion){
    case "getGrillaEmpleados":
        include("modulos/grillaEmpleados.php");
        break;
        
    case "getGrillaCocheras":
        include("modulos/grillaCocheras.php");
        break;

    case "getGrillaVehiculos":
        include("modulos/grillaVehiculos.php");
        break;

    case "formAltaEmpleado":
        include("modulos/altaEmpleado.php");
        break;

    case "agregarUsuario":
        $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

        $usuario = new Usuario(null, $obj->nombre, $obj->correo, $obj->password, $obj->rol, $obj->turno);
        Usuario::Guardar($usuario);

        include("modulos/grillaEmpleados.php");
        break;

    case "editarUsuario":
        $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

        $usuario = new Usuario(null, $obj->nombre, $obj->correo, $obj->password, $obj->rol, $obj->turno);
        Usuario::Modificar($usuario);

        include("modulos/grillaEmpleados.php");
        break;
    
    case "borrarEmpleado":
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        Usuario::Eliminar($id);
        
        include("modulos/grillaEmpleados.php");
        break;
    
    case "FormEdicionEmpleado":
        include("modulos/edicionEmpleado.php");
        break;

    case "IniciarOperacion":
        include("modulos/altaOperacion.php");
        break;

    default:
        echo ":(";
}
?>