<?php 
    $json = Cochera::TraerEstadisticas(NULL, NULL);
    $estadisticas = json_decode($json);
?>

<form method="POST" onsubmit="filtrarEstadisticas(); return false;" class="form-inline">
    <div class="filtro">
    <div class="form-group">
        <label for="fechaDesde">Desde</label>
        <div class="input-group date" id="fechaDesde" name="fechaDesde">
            <input type="text" class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="fechaHasta">Hasta</label>
        <div class="input-group date" id="fechaHasta" name="fechaHasta">
            <input type="text" class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-sm btn-flat" value="Filtrar"/>
    </div>
    </div>
    <div class="filtro">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Empleados</a></li>
            <li role="presentation"><a href="#">Cocheras</a></li>
            <li role="presentation"><a href="#">Vehiculos</a></li>
        </ul>
    </div>
</form>

<div id="operaciones">
    <table class="table table-hover table-stripped" >
        <thead>
            <tr>
                <th>Cochera</th>
                <th>Piso</th>
                <th>Cantidad de Vehiculos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estadisticas as $estadistica) {
                echo "<tr>
                        <td>".$estadistica->numero."</td>
                        <td>".$estadistica->piso."</td>
                        <td>".$estadistica->cantVehiculos."</td>
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