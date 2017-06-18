<?php
  include_once "clases/usuario.php";
  include_once "clases/conexion.php";

  session_start();
  $userId = $_SESSION['usuario'];
  $usuarioLogueado = Usuario::TraerUsuarioPorId($userId);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="AdminLTE-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="AdminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="AdminLTE-master/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <link href="AdminLTE-master/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link href="css/estilos.css" rel="stylesheet" type="text/css" />

    <title>Park Here</title>
  </head>

  <body class="skin-blue" data-spy="scroll">
    <header class="main-header">               
      <nav class="navbar navbar-static-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a href="home.php" class="navbar-brand">Park <b>Here</b>
              <!--<span><img src="img/millenniumFalcon.png" style="height: 30px;"></span>-->
              <span><img src="img/deathStar.png" style="height: 30px;"></span>
              <!--<span><img src="img/parkHereLogo.png" style="height: 30px;"></span>-->
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <?php if($usuarioLogueado->getRol()->getId() != 2) { ?>
                <li class="active"><a onclick="mostrarEmpleados()">Empleados <span class="sr-only">(current)</span></a></li>
              <?php } ?>
              <li><a onclick="mostrarVehiculos()">Vehiculos</a></li>
              <li><a onclick="mostrarCocheras()">Cocheras</a></li>
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operaciones <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a onclick="iniciarOperacion()">Nueva</a></li>
                <li><a onclick="traerOperaciones()">Finalizar</a></li>
                <?php if($usuarioLogueado->getRol()->getId() != 2) { ?>
                  <li class="divider"></li>
                  <li><a href="#">Información</a></li>
                <?php } ?>
              </ul>
              </li>
            </ul>
            <!--<form class="navbar-form navbar-left" role="search">
            <div class="form-group">
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
            </form>-->
            <ul class="nav navbar-nav navbar-right">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="img/loginImage.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $usuarioLogueado->getNombre(); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                  <img src="img/loginImage.jpg" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $usuarioLogueado->getNombre(). " - Turno " . $usuarioLogueado->getTurno()->getDescripcion(); ?>
                    <small>Member since Nov. 2012</small>
                  </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="center-block">
                      <a onclick="desloguear()" class="btn btn-default btn-flat btn-block">Finalizar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
    <div id="principal" class="col-md-6 col-md-offset-3">
      <?php include("modulos/main.php"); ?>
    </div>

  <div class="modal" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Finalizar Operación</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="finalizar">Finalizar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

    <!-- jQuery 2.1.3 -->
    <script src="AdminLTE-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="AdminLTE-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="AdminLTE-master/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="js/funciones.js"></script>
  </body>
</html>


