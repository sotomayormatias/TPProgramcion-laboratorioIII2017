<?php
    include_once "../clases/usuario.php";
    include_once "../clases/conexion.php";
    session_start();

    $response["exito"] = TRUE;
    $response["mensaje"] = "";

    $obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
    
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
    }

    echo json_encode($response);
?>