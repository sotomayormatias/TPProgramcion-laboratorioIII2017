<?php
    include_once "../clases/usuario.php";
    include_once "../clases/conexion.php";
    include_once "../clases/autentificadorJWT.php";
    session_start();

    $response["exito"] = TRUE;
    $response["mensaje"] = "";

    $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
    $recordar = isset($_POST['recordar']) ? $_POST['recordar'] : NULL;
    
    $usuario = Usuario::TraerUsuarioPorCorreo($obj->email);

    if($usuario->getCorreo() != $obj->email){
        $response["exito"] = FALSE;
        $response["mensaje"] = "El usuario no existe";
    }
    else if($usuario->getPassword() != $obj->password){
        $response["exito"] = FALSE;
        $response["mensaje"] = "El password es incorrecto";
    }
    else if($usuario->GetEstado() == 2){
        $response["exito"] = FALSE;
        $response["mensaje"] = "El usuario se encuentra suspendido";
    }
    else {
        $_SESSION['usuario'] = $usuario->getId();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $_SESSION['login'] = date("H:i:s");
        $response['usuario'] = $usuario->getId();

        $datos = array(
            'nombre' => $usuario->GetNombre(),
            'correo' => $usuario->GetCorreo()
        );
        $response['token'] = AutentificadorJWT::crearToken($datos);

        if($recordar == "true") {
			setcookie("usuario", $usuario->getCorreo(), time() + 3600, "/");
		}
		else {
			setcookie("usuario", "", time() + 3600, "/");
		}
        $usuario->ficharIngreso();
    }

    echo json_encode($response);
?>