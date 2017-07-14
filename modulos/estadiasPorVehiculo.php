<?php 
    $json = Vehiculo::TraerEstadiasPorVehiculo(NULL, NULL);
    $estadisticas = json_decode($json);
?>

<h1>Estadias de Vehículos</h1>
<div id="estadisticas">
    <table class="table table-hover table-stripped" >
        <thead>
            <tr>
                <th>Patente</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Cantidad de Estadias</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estadisticas as $estadistica) {
                echo "<tr>
                        <td>".$estadistica->patente."</td>
                        <td>".$estadistica->marca."</td>
                        <td>".$estadistica->color."</td>
                        <td>".$estadistica->cantEstadias."</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function () {
        $("#fechaDesde").datepicker({
        autoclose: true
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#fechaHasta').datepicker('setStartDate', minDate);
        });

        $("#fechaHasta").datepicker({
        autoclose: true
        })
        .on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#fechaDesde').datepicker('setEndDate', maxDate);
        });
    });
</script>