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
}