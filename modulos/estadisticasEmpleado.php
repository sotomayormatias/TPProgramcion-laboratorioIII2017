<?php 
    $json = Usuario::TraerFichajes(NULL, NULL);
    $fichajes = json_decode($json);
?>

<form method="POST" onsubmit="filtrarEstadisticasEmpleado(); return false;" class="form-inline">
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
            <li role="presentation" class="active" id="tabFichajes"><a onclick="traerFichajes()">Fichajes</a></li>
            <li role="presentation" id="tabTransacciones"><a onclick="traerTransacciones()">Transacciones</a></li>
        </ul>
    </div>
</form>

<div id="estadisticas">
    <table class="table table-hover table-stripped" >
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Turno</th>
                <th>Horario Ingreso</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fichajes as $fichaje) {
                echo "<tr>
                        <td>".$fichaje->nombre."</td>
                        <td>".$fichaje->turno."</td>
                        <td>".$fichaje->fechaLogin."</td>
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