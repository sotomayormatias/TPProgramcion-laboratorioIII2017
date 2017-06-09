<?php 
include_once "clases/cochera.php";
$arrayDeCocheras = Cochera::TraerTodos();
?>

<table class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>Número</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Piso</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($arrayDeCocheras as $cochera) {
                echo "<tr>
                    <td>".$cochera->getNumero()."</td>
                    <td>".$cochera->getEstado()->getDescripcion()."</td>
                    <td>".$cochera->getTipo()->getDescripcion()."</td>
                    <td>".$cochera->getPiso()."</td>
                    </tr>";
            }
        ?>
    </tbody>
</table>