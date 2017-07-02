<?php 
    include_once "clases/turno.php";
    include_once "clases/rol.php";

    $turnos = Turno::TraerTodos();
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    $empleado = Usuario::TraerUsuarioPorId($id);
?>

<form method="POST" onsubmit="editarUsuario(<?php echo $id; ?>); return false;">
    <div class="form-group">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" value="<?php echo $empleado->getNombre(); ?>" />
    </div>
    <div class="form-group">
        <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control" value="<?php echo $empleado->getCorreo(); ?>" />
    </div>
    <div class="form-group" >
        <select name="turno" id="turno" class="form-control">
        <?php 
        foreach($turnos as $turno){
        ?>
            <option <?php if($turno->getId() == $empleado->getTurno()->getId()){ echo "selected"; } ?> value="<?php echo $turno->getId(); ?>"><?php echo $turno->getDescripcion(); ?></option>
        <?php 
        } 
        ?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="password" id="password" placeholder="Password" class="form-control" value="<?php echo $empleado->getPassword(); ?>" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" value="Guardar"/>
    </div>
</form>