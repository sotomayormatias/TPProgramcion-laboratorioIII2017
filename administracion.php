<?php 
include_once "clases/usuario.php";
include_once "clases/conexion.php";
include_once "clases/cochera.php";
include_once "clases/vehiculo.php";
include_once "clases/operacion.php";
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

    case "asignarCochera":
        $tipo = isset($_POST['tipoCochera']) ? $_POST['tipoCochera'] : NULL;
        $cocheras = Cochera::TraerCocherasLibres($tipo);
        if(count($cocheras) > 0){
            $posAleatoria = rand(0, count($cocheras) - 1);
            echo $cocheras[$posAleatoria]->getNumero();
        }
        else {
            echo 0;
        }
        break;

    case "agregarOperacion":
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $obj = isset($_POST['vehiculo']) ? json_decode(json_encode($_POST['vehiculo'])) : NULL;
        $vehiculo = new Vehiculo(null, $obj->patente, $obj->marca, $obj->color);

        $nroCochera = isset($_POST['nroCochera']) ? $_POST['nroCochera'] : NULL;
        $cochera = Cochera::TraerCocheraPorNro($nroCochera);

        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
        $operacion = new Operacion(null, $cochera, $vehiculo, 0, date("Y-m-d H:i:s"), null, $usuario, null);
        Operacion::Guardar($operacion);
        include("modulos/grillaCocheras.php");
        break;

    case "filtrarOperacion":
        include("modulos/filtroOperaciones.php");
        break;

    case "traerOperaciones":
        include("modulos/grillaOperaciones.php");
        break;

    case "finalizarOperacion":
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
        $idOperacion = isset($_POST['idOperacion']) ? $_POST['idOperacion'] : NULL;
        $costo = isset($_POST['costo']) ? $_POST['costo'] : NULL;
        
        $operacion = Operacion::TraerOperacionPorId($idOperacion);
        $operacion->SetEmpleadoEgreso($usuario);
        $operacion->SetCosto($costo);
        $operacion->SetEgreso(date("Y-m-d H:i:s"));

        Operacion::Modificar($operacion);
        $operacion->GetCochera()->CambiarEstado();

        include("modulos/grillaOperaciones.php");
        break;
    
    case "calcularCosto":
        $idOperacion = isset($_POST['idOperacion']) ? $_POST['idOperacion'] : NULL;
        $costo = Operacion::calcularCosto($idOperacion);
        echo json_encode(array('idOperacion'=>$idOperacion, 'costo'=>$costo));
        break;

    case "traerEstadisticasEmpleado":
        include("modulos/estadisticasEmpleado.php");
        break;

    case "traerTransaccionesEmpleado":
        $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : NULL;
        $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : NULL;
        echo Usuario::traerTransacciones($fechaDesde, $fechaHasta);
        break;

    case "traerFichajesEmpleado":
        $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : NULL;
        $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : NULL;
        echo Usuario::traerFichajes($fechaDesde, $fechaHasta);
        break;

    case "traerEstadisticasCochera":
        include("modulos/estadisticasCochera.php");
        break;

    case "filtrarEstadisticasCochera":
        $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : NULL;
        $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : NULL;
        echo Cochera::TraerEstadisticas($fechaDesde, $fechaHasta);
        break;

    case "traerEstadisticasVehiculo":
        include("modulos/estadisticasVehiculo.php");
        break;

    case "filtrarEstadisticasVehiculo":
        $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : NULL;
        $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : NULL;
        echo Vehiculo::TraerEstadisticas($fechaDesde, $fechaHasta);
        break;

    default:
        echo ":(";
}
?>