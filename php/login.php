<?php
    include_once "../clases/usuario.php";
    include_once "../clases/conexion.php";
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
    else {
        $_SESSION['usuario'] = $usuario->getId();
        if($recordar == "true") {
			setcookie("usuario", $usuario->getCorreo(), time() + 3600, "/");
		}
		else {
			setcookie("usuario", "", time() + 3600, "/");
		}
    }

    echo json_encode($response);
?>