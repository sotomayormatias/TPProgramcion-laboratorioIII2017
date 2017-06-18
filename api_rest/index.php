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
// $app->get('/hello/{name}', function (Request $request, Response $response) {
//     $name = $request->getAttribute('name');
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

// $app->get('/', function (Request $request, Response $response) {
//     $response->getBody()->write("Hello Slim Framework GET");

//     return $response;
// });

// $app->post('/', function (Request $request, Response $response) {
//     $response->getBody()->write("Hello Slim Framework POST");

//     return $response;
// });

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