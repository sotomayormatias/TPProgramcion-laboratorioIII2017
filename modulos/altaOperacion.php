<?php 
    // include_once "clases/turno.php";
    // include_once "clases/rol.php";
?>

<form method="POST" onsubmit="agregarOperacion(); return false;">
    <div class="form-group">
        <input type="text" name="patente" id="patente" placeholder="Patente" class="form-control" />
    </div>
    <div class="form-group">
        <input type="text" name="marca" id="marca" placeholder="Marca" class="form-control" />
    </div>
    <div class="form-group">
        <input type="text" name="color" id="color" placeholder="Color" class="form-control" />
    </div>
    <div class="row">
        <div class="col-xs-3">    
            <div class="checkbox icheck">
            <label>
                <input type="checkbox" id="esReservada">  Cochera Reservada
            </label>
            </div>                        
        </div>
        <div class="col-xs-3">
            <input type="button" class="btn btn-success btn-sm btn-flat" onclick="asignarCochera()" value="Asignar Cochera"/>
        </div>
        <div class="col-xs-6">
            <span class="lead" id="cocheraOperacion"></span>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block btn-sm btn-flat" value="Agregar"/>
    </div>
</form>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>