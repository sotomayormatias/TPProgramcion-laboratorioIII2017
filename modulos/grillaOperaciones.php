<?php 
    $operaciones = Operacion::TraerTodasLasOperaciones();
?>

<h1>Transacciones Pendientes</h1>
<form method="POST" onsubmit="filtrarOperacion(); return false;" class="form-inline" data-toggle="validator">
    <div class="filtro">
        <div class="form-group">
            <input type="text" name="patente" id="patente" placeholder="Patente" class="form-control" minlength="6" required pattern="^[a-zA-Z]{2,3}[0-9]{3}([a-zA-Z]{2})?$"/>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block btn-sm btn-flat" value="Filtrar"/>
        </div>
    </div>
</form>

<div id="operaciones">
    <table class="table table-hover table-stripped" >
        <thead>
            <tr>
                <th>Cochera</th>
                <th>Patente</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Ingreso</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($operaciones as $operacion) {
                echo "<tr>
                    <td>".$operacion->getCochera()->getNumero()."</td>
                    <td>".$operacion->getVehiculo()->getPatente()."</td>
                    <td>".$operacion->getVehiculo()->getMarca()."</td>
                    <td>".$operacion->getVehiculo()->getColor()."</td>
                    <td>".$operacion->getIngreso()."</td>
                    <td><a onclick='calcularCosto(".$operacion->getId().")' class='btn btn-danger btn-sm btn-flat'><span class='glyphicon glyphicon-off'></span>  Finalizar</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
