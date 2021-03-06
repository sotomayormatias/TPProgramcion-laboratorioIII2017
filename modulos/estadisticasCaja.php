<?php 
    $json = Operacion::TraerCaja(NULL, NULL);
    $resultados = json_decode($json);
?>

<h1>Estadísticas de Caja</h1>
<form method="POST" onsubmit="filtrarEstadisticasCaja(); return false;" class="form-inline">
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
</form>

<div id="estadisticas">
    <table class="table table-hover table-stripped" >
        <thead>
            <tr>
                <th>Monto</th>
                <th>Cantidad de Vehiculos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $resultado) {
                echo "<tr>
                        <td>$".$resultado->costo."</td>
                        <td>".$resultado->vehiculos."</td>
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