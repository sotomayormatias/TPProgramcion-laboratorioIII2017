<?php
require_once 'operacion.php';
require_once 'vehiculo.php';
require_once 'cochera.php';
require_once 'IApiUsable.php';

class OperacionApi extends Operacion implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$elUsuario = Operacion::TraerOperacionPorId($id);
		$newResponse = $response->withJson($elUsuario, 200);  
		return $response;
	}

	public function TraerTodos($request, $response, $args) {
		$todos = Operacion::TraerTodasLasOperaciones();
		$response = $response->withJson($todos, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$nroCochera = filter_var($ArrayDeParametros['cochera'], FILTER_SANITIZE_STRING);
		$patente = filter_var($ArrayDeParametros['patente'], FILTER_SANITIZE_STRING);
		$marca = filter_var($ArrayDeParametros['marca'], FILTER_SANITIZE_STRING);
		$color = filter_var($ArrayDeParametros['color'], FILTER_SANITIZE_STRING);
		$costo = filter_var($ArrayDeParametros['costo'], FILTER_SANITIZE_STRING);
		$ingreso = filter_var($ArrayDeParametros['ingreso'], FILTER_SANITIZE_STRING);
		$egreso = filter_var($ArrayDeParametros['egreso'], FILTER_SANITIZE_STRING);
		$empleadoIngreso = filter_var($ArrayDeParametros['empleadoIngreso'], FILTER_SANITIZE_STRING);
		$empleadoEgreso = filter_var($ArrayDeParametros['empleadoEgreso'], FILTER_SANITIZE_STRING);

		$cochera = Cochera::TraerCocheraPorNro($nroCochera);
		$vehiculo = new Vehiculo(null, $patente, $marca, $color);
		$operacion = new Operacion(null, $cochera, $vehiculo, $costo, $ingreso, $egreso, $empleadoIngreso, $empleadoEgreso);
		$id = Operacion::Guardar($operacion);

        $objDelaRespuesta= new stdclass();
        if($id > 0){
		    $objDelaRespuesta->resultado = "Exito!";
        }
        else {
            $objDelaRespuesta->resultado = "No se pudieron insertar los datos";
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);  

		return $newResponse;
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$cantidadDeBorrados = Operacion::Eliminar($id);

		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->cantidad=$cantidadDeBorrados;
		if($cantidadDeBorrados>0){
			$objDelaRespuesta->resultado="Borrado exitoso!!!";
		}
		else{
			$objDelaRespuesta->resultado="no Borro nada!!!";
		}
		$newResponse = $response->withJson($objDelaRespuesta, 200);  
		return $newResponse;
	}

	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		
		$id = filter_var($ArrayDeParametros['id'], FILTER_SANITIZE_STRING);
		$nroCochera = filter_var($ArrayDeParametros['cochera'], FILTER_SANITIZE_STRING);
		$idVehiculo = filter_var($ArrayDeParametros['vehiculo'], FILTER_SANITIZE_STRING);
		$costo = filter_var($ArrayDeParametros['costo'], FILTER_SANITIZE_STRING);
		$ingreso = filter_var($ArrayDeParametros['ingreso'], FILTER_SANITIZE_STRING);
		$egreso = filter_var($ArrayDeParametros['egreso'], FILTER_SANITIZE_STRING);
		$empleadoIngreso = filter_var($ArrayDeParametros['empleadoIngreso'], FILTER_SANITIZE_STRING);
		$empleadoEgreso = filter_var($ArrayDeParametros['empleadoEgreso'], FILTER_SANITIZE_STRING);

		$cochera = Cochera::TraerCocheraPorNro($nroCochera);
		$vehiculo = Vehiculo::TraerVehiculoPorId($idVehiculo);
		$operacion = new Operacion($id, $cochera, $vehiculo, $costo, $ingreso, $egreso, $empleadoIngreso, $empleadoEgreso);

		$resultado = Operacion::Modificar($operacion);
		$objDelaRespuesta= new stdclass();
        if($resultado){
		    $objDelaRespuesta->resultado = "Modificacion exitosa!";
        }
        else {
            $objDelaRespuesta->resultado = "No se pudieron modificar los datos";
        }
		return $response->withJson($objDelaRespuesta, 200);		
	}
}