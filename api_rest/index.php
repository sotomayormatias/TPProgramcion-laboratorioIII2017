<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once '../clases/conexion.php';
require_once '../clases/cochera.php';
require_once '../clases/usuario.php';
require_once '../clases/vehiculo.php';
require_once '../clases/operacion.php';

$app = new \Slim\App;

$app->get('/cochera[/]', function (Request $request, Response $response) {
    $arrayDeCocheras = Cochera::TraerTodos();
    $response = $response->withJson($arrayDeCocheras);
    // $response->getBody()->write(json_encode($arrayDeCocheras)); //Esto hace lo mismo que la linea de arriba
    return $response;
});

$app->get('/usuario[/]', function (Request $request, Response $response) {
    $arrayDeUsuarios = Usuario::TraerTodos();
    $response = $response->withJson($arrayDeUsuarios);
    return $response;
});

$app->post('/usuario[/]', function (Request $request, Response $response) {
    $parsedBody = $request->getParsedBody();
    $nombre = filter_var($parsedBody['nombre'], FILTER_SANITIZE_STRING);
    $correo = filter_var($parsedBody['correo'], FILTER_SANITIZE_STRING);
    $password = filter_var($parsedBody['password'], FILTER_SANITIZE_STRING);
    $rol = filter_var($parsedBody['rol'], FILTER_SANITIZE_STRING);
    $turno = filter_var($parsedBody['turno'], FILTER_SANITIZE_STRING);

    $usuario = new Usuario(null, $nombre, $correo, $password, $rol, $turno);
    //no se debe borrar el response, se debe agregarle un json como con el get de usuario
    Usuario::Guardar($usuario);
    $response->getBody()->write("se guardo el usuario");
    // $response = $response->withJson($usuario);
    return $response;
});

$app->get('/vehiculo[/]', function (Request $request, Response $response) {
    $arrayDeVehiculos = Vehiculo::TraerTodos();
    $response = $response->withJson($arrayDeVehiculos);
    return $response;
});

$app->get('/operacion[/]', function (Request $request, Response $response) {
    $arrayDeOperaciones = Operacion::TraerTodos();
    $response = $response->withJson($arrayDeOperaciones);
    return $response;
});

$app->post('/operacion[/]', function (Request $request, Response $response) {
    $parsedBody = $request->getParsedBody();
    $cochera = filter_var($parsedBody['cochera'], FILTER_SANITIZE_STRING);
    $vehiculo = filter_var($parsedBody['vehiculo'], FILTER_SANITIZE_STRING);
    $costo = filter_var($parsedBody['costo'], FILTER_SANITIZE_STRING);
    $ingreso = filter_var($parsedBody['ingreso'], FILTER_SANITIZE_STRING);
    $egreso = filter_var($parsedBody['egreso'], FILTER_SANITIZE_STRING);
    $empleadoIngreso = filter_var($parsedBody['empleadoIngreso'], FILTER_SANITIZE_STRING);
    $empleadoEgreso = filter_var($parsedBody['empleadoEgreso'], FILTER_SANITIZE_STRING);

    $usuario = new Operacion(null, $cochera, $vehiculo, $costo, $ingreso, $egreso, $empleadoIngreso, $empleadoEgreso);
    Usuario::Guardar($usuario);
    $response->getBody()->write("se guardo la operacion");
    
    return $response;
});

$app->post('/cd[/]', function (Request $request, Response $response) {
    $parsedBody = $request->getParsedBody();
    // $jsonBody = json_decode($parsedBody, true);
    $titulo = filter_var($parsedBody['titulo'], FILTER_SANITIZE_STRING);
    $cantante = filter_var($parsedBody['cantante'], FILTER_SANITIZE_STRING);
    $anio = filter_var($parsedBody['anio'], FILTER_SANITIZE_STRING);
    $archivos = $request->getUploadedFiles();
    $foto = $archivos['foto'];

    //Esto hay que hacerlo en la llamada al metodo del cd, pasandole el archivo por parametro
    //No deberia haber logica en los metodos del slim
    $foto->moveTo("img/" . $titulo . ".jpg");

    // $cd = new cd(null, $titulo, $cantante, $anio);
    // $cd->insertarElCd();

    return $response;
});

$app->delete('/cd[/]', function (Request $request, Response $response) {
    $parsedBody = $request->getParsedBody();
    $cd = new cd($parsedBody['id'], NULL, NULL, NULL);
    $cd->BorrarCd();

    return $response;
});

$app->run();
?>