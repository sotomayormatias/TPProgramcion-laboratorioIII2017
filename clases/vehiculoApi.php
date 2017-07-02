<?php
require_once 'vehiculo.php';
require_once 'IApiUsable.php';

class VehiculoApi extends Vehiculo implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$vehiculo = Vehiculo::TraerVehiculoPorId($id);
		$newResponse = $response->withJson($vehiculo, 200);  
		return $response;
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