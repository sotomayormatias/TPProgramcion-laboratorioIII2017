<?php 
//Solo traigo los usuarios empleados
$arrayDeEmpleados = Usuario::TraerUsuariosPorRol(2);
?>

<h1>Empleados</h1>
<table class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Turno</th>
            <th colspan=3><a onclick='formAltaEmpleado()' class='btn btn-primary btn-sm btn-flat' data-toggle='tooltip' title='Agregar'><span class='glyphicon glyphicon-user'></span><span class='glyphicon glyphicon-plus'></span></a></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($arrayDeEmpleados as $empleado) {
                $grilla = "<tr>
                    <td>".$empleado->getNombre()."</td>
                    <td>".$empleado->getCorreo()."</td>
                    <td>".$empleado->getTurno()->getDescripcion()."</td>
                    <td><a onclick='FormEdicionEmpleado(".$empleado->getId().")' class='btn btn-info btn-sm btn-flat' data-toggle='tooltip' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a></td>
                    <td><a onclick='BorrarEmpleado(".$empleado->getId().")' class='btn btn-danger btn-sm btn-flat' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a></td>";
                    if($empleado->getEstado() == 1){
                        $grilla .= "<td><a onclick='SuspenderEmpleado(".$empleado->getId().")' class='btn btn-warning btn-sm btn-flat' data-toggle='tooltip' title='Suspender'><span class='glyphicon glyphicon-remove'></span></a></td>";
                    }
                    else {
                        $grilla .= "<td><a onclick='ActivarEmpleado(".$empleado->getId().")' class='btn btn-success btn-sm btn-flat' data-toggle='tooltip' title='Activar'><span class='glyphicon glyphicon-ok'></span></a></td>";
                    }
                    $grilla .= "</tr>";

                echo $grilla;
            }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>