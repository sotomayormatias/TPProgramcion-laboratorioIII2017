<?php
require_once 'vehiculo.php';
require_once 'usuario.php';
require_once 'operacion.php';
require_once 'cochera.php';

class EstadisticasApi {

	public function Traer($request, $response, $args) {
		$accion=$args['accion'];
		$ArrayDeParametros = $request->getParsedBody();
		$fechaDesde= $ArrayDeParametros['fechaDesde'];
		$fechaHasta= $ArrayDeParametros['fechaHasta'];

		switch($accion){
			case 'fichajesEmpleados':
				$resultado = json_decode(Usuario::traerFichajes($fechaDesde, $fechaHasta));
				break;
			case 'transaccionesEmpelados':
				$resultado = json_decode(Usuario::traerTransacciones($fechaDesde, $fechaHasta));
				break;
			case 'infoVehiculos':
				$resultado = json_decode(Vehiculo::traerEstadisticas($fechaDesde, $fechaHasta));
				break;
			case 'caja':
				$resultado = json_decode(Operacion::traerCaja($fechaDesde, $fechaHasta));
				break;
			case 'usoReservadas':
				$resultado = json_decode(Cochera::TraerUsosReservadas($fechaDesde, $fechaHasta));
				break;
			case 'usoComunes':
				$resultado = json_decode(Cochera::TraerUsosComunes($fechaDesde, $fechaHasta));
				break;
			case 'cocherasMasUsadas':
				$resultado = json_decode(Cochera::TraerMasUsadas($fechaDesde, $fechaHasta));
				break;
			case 'cocherasMenosUsadas':
				$resultado = json_decode(Cochera::TraerMenosUsadas($fechaDesde, $fechaHasta));
				break;
			case 'cocherasNuncaUsadas':
				$resultado = json_decode(Cochera::TraerNuncaUsadas($fechaDesde, $fechaHasta));
				break;
			case 'cantVehiculos':
				$resultado = json_decode(Vehiculo::TraerEstadiasPorVehiculo($fechaDesde, $fechaHasta));
				break;
			default:
				break;
		}

		$newResponse = $response->withJson($resultado, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$todosLosVehiculos = Vehiculo::TraerTodosLosVehiculos();
		$response = $response->withJson($todosLosVehiculos, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$patente= $ArrayDeParametros['patente'];
		$marca= $ArrayDeParametros['marca'];
		$color= $ArrayDeParametros['color'];

		$vehiculo = new Vehiculo(NULL, $patente, $marca, $color);
		$id = Vehiculo::Guardar($vehiculo);

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
		$id = $args['id'];
		$cantidadDeBorrados = Vehiculo::Eliminar($id);

		$objDelaRespuesta = new stdclass();
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
		
		$id = $ArrayDeParametros['id'];
		$patente = $ArrayDeParametros['patente'];
		$marca = $ArrayDeParametros['marca'];
		$color = $ArrayDeParametros['color'];

		$vehiculo = new Vehiculo($id, $patente, $marca, $color);

		$resultado = Vehiculo::Modificar($vehiculo);
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