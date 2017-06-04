<?php 
//Solo traigo los usuarios empleados
$arrayDeEmpleados = Usuario::TraerUsuariosPorRol(2);
?>

<table class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Turno</th>
            <th colspan=2><a onclick='formAltaEmpleado()' class='btn btn-primary btn-sm btn-flat'><span class='glyphicon glyphicon-user'></span>  Argegar</a></span></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($arrayDeEmpleados as $empleado) {
                echo "<tr>
                    <td>".$empleado->getNombre()."</td>
                    <td>".$empleado->getCorreo()."</td>
                    <td>".$empleado->getTurno()->getDescripcion()."</td>
                    <td><a onclick='FormEdicionEmpleado(".$empleado->getId().")' class='btn btn-warning btn-sm btn-flat'><span class='glyphicon glyphicon-pencil'></span>  Editar</a></td>
                    <td><a onclick='BorrarEmpleado(".$empleado->getId().")' class='btn btn-danger btn-sm btn-flat'><span class='glyphicon glyphicon-trash'></span>  Borrar</a></td>
                    </tr>";
            }
        ?>
    </tbody>
</table>