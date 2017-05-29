<?php 
    include "clases/turno.php";
    include "clases/rol.php";

    $turnos = Turno::TraerTodos();
?>

<form method="POST" onsubmit="agregarUsuario(); return false;">
    <div class="form-group">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" />
    </div>
    <div class="form-group">
        <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control" />
    </div>
    <div class="form-group" >
        <select name="turno" id="turno" class="form-control">
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
        <input type="text" name="password" id="password" placeholder="Password" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" value="Agregar"/>
    </div>
</form>