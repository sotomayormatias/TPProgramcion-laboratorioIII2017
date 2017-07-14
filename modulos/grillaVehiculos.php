<?php 
include_once "clases/vehiculo.php";
$arrayDeVehiculos = Vehiculo::TraerTodosLosVehiculos();
?>

<h1>Vehículos</h1>
<!--FINAL-->
<!--<div class="filtro">
    <div class="form-group col-md-4 col-md-offset-4">
        <input onkeyup="filtrarVehiculos()" type="text" name="patente" id="patente" placeholder="Patente" class="form-control" pattern="^[a-zA-Z]{2,3}[0-9]{3}([a-zA-Z]{2})?$"/>
    </div>
</div>-->
<?php
if(count($arrayDeVehiculos) > 0){
?>

<table class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>Patente</th>
            <th>Marca</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($arrayDeVehiculos as $vehiculo) {
                echo "<tr>
                    <td>".$vehiculo->getPatente()."</td>
                    <td>".$vehiculo->getMarca()."</td>
                    <td>".$vehiculo->getColor()."</td>
                    </tr>";
            }
        ?>
    </tbody>
</table>

<?php 
}
else{
    echo "<h1>No hay autos estacionados<br>El estacionamiento está vacío</h1>";
}
?>