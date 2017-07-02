<?php
    include_once "./clases/cochera.php";

    $arrayCocheras = Cochera::TraerCocherasOcupadas();
    $cocherasOcupadas = count($arrayCocheras);
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
        <h3>150</h3>
        <p>Transacciones</p>
    </div>
    <div class="icon">
        <i class="ion ion-android-car"></i>
    </div>
    <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
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
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner">
        <h3>44</h3>
        <p>User Registrations</p>
    </div>
    <div class="icon">
        <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div><!-- ./col -->
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
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
</div><!-- ./col -->
</div><!-- /.row -->