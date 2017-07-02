<?php
require_once 'cochera.php';
require_once 'estadoCochera.php';
require_once 'tipoCochera.php';
require_once 'IApiUsable.php';

class CocheraApi extends Cochera implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$laCochera=Cochera::TraerCocheraPorId($id);
		$newResponse = $response->withJson($laCochera, 200);  
		return $response;
	}

	public function TraerTodos($request, $response, $args) {
		$todasLasCocheras = Cochera::TraerTodasLasCocheras();
		$response = $response->withJson($todasLasCocheras, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$numero= $ArrayDeParametros['numero'];
		$estado= $ArrayDeParametros['estado'];
		$piso= $ArrayDeParametros['piso'];
		$tipo= $ArrayDeParametros['tipo'];

		$miCochera = new Cochera(NULL, $numero, $estado, $piso, $tipo);
		$id = Cochera::Guardar($miCochera);

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
		$cantidadDeBorrados = Cochera::Eliminar($id);

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
		
		$id=$ArrayDeParametros['id'];
		$numero= $ArrayDeParametros['numero'];
		$idEstado= $ArrayDeParametros['estado'];
		$piso= $ArrayDeParametros['piso'];
		$idTipo= $ArrayDeParametros['tipo'];

		$estado = EstadoCochera::TraerEstadoPorId($idEstado);
		$tipo = TipoCochera::TraerTipoPorId($idTipo);
		$miCochera = new Cochera($id, $numero, $estado, $piso, $tipo);

		$resultado = Cochera::Modificar($miCochera);
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