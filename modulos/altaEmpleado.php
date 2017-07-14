<?php 
    include_once "clases/turno.php";
    include_once "clases/rol.php";

    $turnos = Turno::TraerTodos();
?>

<form method="POST" onsubmit="agregarUsuario(); return false;" data-toggle="validator">
    <div class="form-group">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" required/>
    </div>
    <div class="form-group">
        <input type="email" name="correo" id="correo" placeholder="Correo" class="form-control" required/>
    </div>
    <div class="form-group" >
        <select name="turno" id="turno" class="form-control" required>
        <?php 
        foreach($turnos as $turno){
        ?>
            <option value="<?php echo $turno->getId(); ?>"><?php echo $turno->getDescripcion(); ?></option>
        <?php 
        } 
        ?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="password" id="password" placeholder="Password" class="form-control" required/>
    </div>
    <div class="form-group">
        <input class="form-control" type="file" name="foto" id="foto" onchange="previsualizarFoto()">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block btn-sm btn-flat" value="Agregar"/>
    </div>
    <div class="help-block with-errors"></div>
    <div id="divFoto"></div>
</form>