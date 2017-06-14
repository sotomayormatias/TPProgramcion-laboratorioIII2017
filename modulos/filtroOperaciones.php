<?php 
    $patente = isset($_POST['patente']) ? $_POST['patente'] : NULL;
    $operaciones = Operacion::TraerOperacionPorPatente($patente);
    // var_dump($operacion);
    if(count($operaciones) == 0){
?>
    <h1>No existe un auto con esta patente</h1>

    <?php }else{ ?>

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
                    <td>".$operacion->getCochera()."</td>
                    <td>".$operacion->getVehiculo()->getPatente()."</td>
                    <td>".$operacion->getVehiculo()->getMarca()."</td>
                    <td>".$operacion->getVehiculo()->getColor()."</td>
                    <td>".$operacion->getIngreso()."</td>
                    <td><a onclick='finalizarOperacion(".$operacion->getId().")' class='btn btn-danger btn-sm btn-flat'><span class='glyphicon glyphicon-off'></span>  Finalizar</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php } ?>
