<?php 
include_once("autentificadorJWT.php");

class MWParaAutenticar{
    public function VerificarUsuario($request, $response, $next){
        if($request->isGet()){
            $newResponse = $next($request, $response);
        }
        else{
            try{
                $token = $request->getHeaderLine("token");
                autentificadorJWT::verificarToken($token);
                // $newResponse = $response->withAddedHeader("tokenResponse", $token);
                $newResponse = $next($request, $response);
                return $newResponse;
            }
            catch(Exception $e){
                // echo $e;
                $response->getBody()-> write($e);
                return $response;
            }
        }
        
        return $newResponse;

    }
}
?>