<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class UsuarioApi extends Usuario implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$elUsuario = Usuario::TraerUsuarioPorId($id);
		$newResponse = $response->withJson($elUsuario, 200);  
		return $response;
	}

	public function TraerTodos($request, $response, $args) {
		$todos = Usuario::TraerTodosLosUsuarios();
		$response = $response->withJson($todos, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$nombre = filter_var($ArrayDeParametros['nombre'], FILTER_SANITIZE_STRING);
		$correo = filter_var($ArrayDeParametros['correo'], FILTER_SANITIZE_STRING);
		$password = filter_var($ArrayDeParametros['password'], FILTER_SANITIZE_STRING);
		$rol = filter_var($ArrayDeParametros['rol'], FILTER_SANITIZE_STRING);
		$turno = filter_var($ArrayDeParametros['turno'], FILTER_SANITIZE_STRING);
		$estado = filter_var($parsedBody['estado'], FILTER_SANITIZE_STRING);

		$usuario = new Usuario(null, $nombre, $correo, $password, $rol, $turno, $estado);
		$id = Usuario::Guardar($usuario);

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
		$cantidadDeBorrados = Usuario::Eliminar($id);

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
		$nombre = filter_var($ArrayDeParametros['nombre'], FILTER_SANITIZE_STRING);
		$correo = filter_var($ArrayDeParametros['correo'], FILTER_SANITIZE_STRING);
		$password = filter_var($ArrayDeParametros['password'], FILTER_SANITIZE_STRING);
		$rol = filter_var($ArrayDeParametros['rol'], FILTER_SANITIZE_STRING);
		$turno = filter_var($ArrayDeParametros['turno'], FILTER_SANITIZE_STRING);
		$estado = filter_var($ArrayDeParametros['estado'], FILTER_SANITIZE_STRING);

		$usuario = new Usuario($id, $nombre, $correo, $password, $rol, $turno, $estado);

		$resultado = Usuario::Modificar($usuario);
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