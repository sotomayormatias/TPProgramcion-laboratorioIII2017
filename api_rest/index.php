<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once '../clases/conexion.php';

require_once '../clases/cocheraApi.php';
require_once '../clases/usuarioApi.php';
require_once '../clases/operacionApi.php';
require_once '../clases/vehiculoApi.php';
require_once '../clases/MWParaAutenticar.php';

$app = new \Slim\App;


$app->group('/cochera', function () {
  $this->get('[/]', \CocheraApi::class . ':traerTodos');
  $this->get('/{id}', \CocheraApi::class . ':traerUno');
  $this->post('[/]', \CocheraApi::class . ':CargarUno');
  $this->delete('/{id}', \CocheraApi::class . ':BorrarUno');
  $this->put('[/]', \CocheraApi::class . ':ModificarUno');
})->add(\MWParaAutenticar::class . ':VerificarUsuario');

$app->group('/usuario', function () {
  $this->get('[/]', \UsuarioApi::class . ':traerTodos');
  $this->get('/{id}', \UsuarioApi::class . ':traerUno');
  $this->post('[/]', \UsuarioApi::class . ':CargarUno');
  $this->delete('/{id}', \UsuarioApi::class . ':BorrarUno');
  $this->put('[/]', \UsuarioApi::class . ':ModificarUno');
});

$app->group('/operacion', function () {
  $this->get('[/]', \OperacionApi::class . ':traerTodos');
  $this->get('/{id}', \OperacionApi::class . ':traerUno');
  $this->post('[/]', \OperacionApi::class . ':CargarUno');
  $this->delete('/{id}', \OperacionApi::class . ':BorrarUno');
  $this->put('[/]', \OperacionApi::class . ':ModificarUno');
});

$app->group('/vehiculo', function () {
  $this->get('[/]', \VehiculoApi::class . ':traerTodos');
  $this->get('/{id}', \VehiculoApi::class . ':traerUno');
  $this->post('[/]', \VehiculoApi::class . ':CargarUno');
  $this->delete('/{id}', \VehiculoApi::class . ':BorrarUno');
  $this->put('[/]', \VehiculoApi::class . ':ModificarUno');
})->add(\MWParaAutenticar::class . ':VerificarUsuario');

$app->run();
?>