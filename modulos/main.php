<?php
    include_once "./clases/cochera.php";
    include_once "./clases/operacion.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $arrayCocheras = Cochera::TraerCocherasOcupadas();
    $cocherasOcupadas = count($arrayCocheras);
    $arrayTransacciones = Operacion::traerTransacciones(date("Y-m-d 00:00:00"), date("Y-m-d 00:00:00", strtotime("+1 day")));
    $cantTransacciones = count($arrayTransacciones);

?>


<!-- Ionicons 2.0.0 -->
<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> 
<!-- Small boxes (Stat box) -->
<h1>Park <b>Here</b></h1>
<div class="row">
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
    <div class="inner">
        <h3><?php echo $cantTransacciones; ?></h3>
        <p>Transacci<?php if($cantTransacciones > 1) echo "ones"; else echo "ón"; ?></p>
    </div>
    <div class="icon">
        <i class="ion ion-android-car"></i>
    </div>
    <a onclick="traerOperaciones()" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div><!-- ./col -->
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner">
        <h3><?php echo $cocherasOcupadas; ?></h3>
        <p>Cochera<?php if($cocherasOcupadas > 1){echo "s";} ?> ocupada<?php if($cocherasOcupadas > 1){echo "s";} ?></p>
    </div>
    <div class="icon">
        <i class="ion ion-pie-graph"></i>
    </div>
    <a onclick="mostrarCocheras()" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div><!-- ./col -->
<div class="col-lg-8 col-lg-offset-2 col-xs-8 col-xs-offset-2">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner">
        <h3><?php echo "$".array_sum(array_column($arrayTransacciones, 'costo')); ?></h3>
        <p>Caja</p>
    </div>
    <div class="icon">
        <i class="ion ion-cash"></i>
    </div>
    <a onclick="traerEstadisticasVehiculo()" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div><!-- ./col -->
<!--<div class="col-lg-6 col-xs-6">
    <div class="small-box bg-red">
    <div class="inner">
        <h3>65</h3>
        <p>Unique Visitors</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>-->
</div><!-- /.row -->