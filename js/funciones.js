var $url = "administracion.php";

function validaLogin(){
    var $usuario = {};
    $usuario.email = $("#emailUser").val();
    $usuario.password = $("#passUser").val();
    var $recordar = $("#recordarme").is(':checked');

    $.ajax({
        url: "php/login.php",
        type: "POST",
        dataType: "json",
        data: {
            usuario: $usuario,
            recordar: $recordar
        },
        beforeSend: function(){
            $("#emailUser").prop("readonly", true);
            $("#passUser").prop("readonly", true);
        }
    })
    .done(function(response){
        if(response["exito"]){
            window.sessionStorage.setItem("usuario", response['usuario']);
            window.localStorage.setItem("token", response['token']);
            location.href = "home.php";
        }
        else{
            $("#errorLogin").html(response["mensaje"]);
            $("#emailUser").prop("readonly", false);
            $("#passUser").prop("readonly", false);
        }
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function desloguear()
{	
	$.ajax({
		url: "php/logout.php",
		type:"POST",
        accion: "logout"
	})
	.done(function(){
        window.sessionStorage.removeItem("usuario");
		location.href = "index.php";
	});
}

function mostrarEmpleados(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "getGrillaEmpleados"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function mostrarCocheras(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "getGrillaCocheras"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function mostrarVehiculos(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "getGrillaVehiculos"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function formAltaEmpleado(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "formAltaEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function agregarUsuario(){
    var $usuario = {};
    $usuario.nombre = $("#nombre").val();
    $usuario.correo = $("#correo").val();
    $usuario.turno = $("#turno").val();
    $usuario.password = $("#password").val();
    $usuario.rol = 2;
    $usuario.archivo = $("#hdnArchivoTemp").val();

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            usuario: $usuario,
            accion: "agregarUsuario"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function editarUsuario($id){
    var $usuario = {};
    $usuario.id = $id;
    $usuario.nombre = $("#nombre").val();
    $usuario.correo = $("#correo").val();
    $usuario.turno = $("#turno").val();
    $usuario.password = $("#password").val();
    $usuario.rol = 2;
    $usuario.archivo = $("#hdnArchivoTemp").val();

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            usuario: $usuario,
            accion: "editarUsuario"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function BorrarEmpleado($id){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            id: $id,
            accion: "borrarEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function SuspenderEmpleado($id){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            id: $id,
            accion: "suspenderEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function ActivarEmpleado($id){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            id: $id,
            accion: "activarEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function FormEdicionEmpleado($id){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            id: $id,
            accion: "FormEdicionEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function iniciarOperacion(){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "IniciarOperacion"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function asignarCochera(){
    $tipoCochera = 1;
    if($("#esReservada").is(":checked")){
        $tipoCochera = 2;
    }
    
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            tipoCochera: $tipoCochera,
            accion: "asignarCochera"
        }
    })
    .done(function(response){
        if(response == 0){
            $("#cocheraOperacion").html("No hay cocheras libres.");
        }
        else {
            $("#cocheraOperacion").html("Cochera asignada: <span id='nroCochera'><strong>" + response + "</strong></span>");
        }
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function agregarOperacion($usuario){
    var $vehiculo = {};
    $vehiculo.patente = $("#patente").val();
    $vehiculo.marca = $("#marca").val();
    $vehiculo.color = $("#color").val();
    $nroCochera = $("#nroCochera").text();

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            vehiculo: $vehiculo,
            nroCochera: $nroCochera,
            usuario: $usuario,
            accion: "agregarOperacion"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerOperaciones(){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerOperaciones"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function filtrarOperacion(){
    var $patente = $("#patente").val();

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            patente: $patente,
            accion: "filtrarOperacion"
        }
    })
    .done(function(response){
        $("#operaciones").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function finalizarOperacion($idOperacion, $costo){
    $usuario = window.sessionStorage.getItem("usuario");

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            idOperacion: $idOperacion,
            costo: $costo,
            usuario: $usuario,
            accion: "finalizarOperacion"
        }
    })
    .done(function(response){
        $("#principal").html(response);
        $("#myModal").modal("hide");
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function calcularCosto($id){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            idOperacion: $id,
            accion: "calcularCosto"
        }
    })
    .done(function(response){
        $res = $.parseJSON(response);
        $("#myModal .modal-body").html("<p>Se debe abonar: <strong>$"+$res['costo']+"</strong></p>");
        $("#finalizar").click(function(){finalizarOperacion($res['idOperacion'], $res['costo']);});
        $("#myModal").modal("show");
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerEstadisticasEmpleado(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerEstadisticasEmpleado"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerTransacciones(){
    focusTabs(2);
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerTransaccionesEmpleado"
        }
    })
    .done(function(response){
        $table = "<table class='table table-hover table-stripped'><thead><tr><th>Empleado</th><th>Transacciones</th></tr></thead><tbody>";
        $.each($.parseJSON(response), function() {
            $table += "<tr>";
            $table += "<td>" + this.nombre + "</td>";
            $table += "<td>" + this.transacciones + "</td>";
            $table += "</tr>";
        });
        $table += "</tbody></table>";

        $("#estadisticas").html($table);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerFichajes(){
    focusTabs(1);
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerFichajesEmpleado"
        }
    })
    .done(function(response){
        $table = "<table class='table table-hover table-stripped'><thead><tr><th>Empleado</th><th>Turno</th><th>Horario Ingreso</th></tr></thead><tbody>";
        $.each($.parseJSON(response), function() {
            $table += "<tr>";
            $table += "<td>" + this.nombre + "</td>";
            $table += "<td>" + this.turno + "</td>";
            $table += "<td>" + this.fechaLogin + "</td>";
            $table += "</tr>";
        });
        $table += "</tbody></table>";

        $("#estadisticas").html($table);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function filtrarEstadisticasEmpleado(){
    $fechaDesde = $("#fechaDesde").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');
    $fechaHasta = $("#fechaHasta").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');

    if($("#tabFichajes").hasClass("active")){
        $.ajax({
            url: $url,
            type: "POST",
            data: {
                accion: "traerFichajesEmpleado",
                fechaDesde: $fechaDesde,
                fechaHasta: $fechaHasta
            }
        })
        .done(function(response){
            $table = "<table class='table table-hover table-stripped'><thead><tr><th>Empleado</th><th>Turno</th><th>Horario Ingreso</th></tr></thead><tbody>";
            $.each($.parseJSON(response), function() {
                $table += "<tr>";
                $table += "<td>" + this.nombre + "</td>";
                $table += "<td>" + this.turno + "</td>";
                $table += "<td>" + this.fechaLogin + "</td>";
                $table += "</tr>";
            });
            $table += "</tbody></table>";

            $("#estadisticas").html($table);
        })
        .fail(function(response){
            alert(response.responseText);
        });
    }
    else {
        $.ajax({
            url: $url,
            type: "POST",
            data: {
                accion: "traerTransaccionesEmpleado",
                fechaDesde: $fechaDesde,
                fechaHasta: $fechaHasta
            }
        })
        .done(function(response){
            $table = "<table class='table table-hover table-stripped'><thead><tr><th>Empleado</th><th>Transacciones</th></tr></thead><tbody>";
            $.each($.parseJSON(response), function() {
                $table += "<tr>";
                $table += "<td>" + this.nombre + "</td>";
                $table += "<td>" + this.transacciones + "</td>";
                $table += "</tr>";
            });
            $table += "</tbody></table>";

            $("#estadisticas").html($table);
        })
        .fail(function(response){
            alert(response.responseText);
        });
    }
}

function traerEstadisticasCaja(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerEstadisticasCaja"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function filtrarEstadisticasCaja(){
    $fechaDesde = $("#fechaDesde").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');
    $fechaHasta = $("#fechaHasta").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "filtrarEstadisticasCaja",
            fechaDesde: $fechaDesde,
            fechaHasta: $fechaHasta
        }
    })
    .done(function(response){
        $table = "<table class='table table-hover table-stripped'><thead><tr><th>Monto</th><th>Cantidad de Vehiculos</th></tr></thead><tbody>";
            $.each($.parseJSON(response), function() {
                $table += "<tr>";
                $table += "<td>$" + this.costo + "</td>";
                $table += "<td>" + this.vehiculos + "</td>";
                $table += "</tr>";
            });
            $table += "</tbody></table>";

            $("#estadisticas").html($table);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerEstadisticasCochera(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerEstadisticasCochera"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function filtrarEstadisticasCochera(){
    $fechaDesde = $("#fechaDesde").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');
    $fechaHasta = $("#fechaHasta").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "filtrarEstadisticasCochera",
            fechaDesde: $fechaDesde,
            fechaHasta: $fechaHasta
        }
    })
    .done(function(response){
        $table = "<table class='table table-hover table-stripped'><thead><tr><th>Cochera</th><th>Piso</th><th>Cantidad de Vehiculos</th></tr></thead><tbody>";
            $.each($.parseJSON(response), function() {
                $table += "<tr>";
                $table += "<td>" + this.numero + "</td>";
                $table += "<td>" + this.piso + "</td>";
                $table += "<td>" + this.cantVehiculos + "</td>";
                $table += "</tr>";
            });
            $table += "</tbody></table>";

            $("#estadisticas").html($table);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function traerEstadisticasVehiculo(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "traerEstadisticasVehiculo"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

// function exportarVehiculoPDF(){
//     $.ajax({
//         url: $url,
//         type: "POST",
//         data: {
//             accion: "exportarVehiculoPDF"
//         }
//     })
//     .done(function(response){
//         // $("#principal").html(response);
//     })
//     .fail(function(response){
//         alert(response.responseText);
//     });
// }

function filtrarEstadisticasVehiculo(){
    $fechaDesde = $("#fechaDesde").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');
    $fechaHasta = $("#fechaHasta").data('datepicker').getFormattedDate('yyyy-mm-dd 00:00:00');

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "filtrarEstadisticasVehiculo",
            fechaDesde: $fechaDesde,
            fechaHasta: $fechaHasta
        }
    })
    .done(function(response){
        $table = "<table class='table table-hover table-stripped'><thead><tr><th>Patente</th><th>Marca</th><th>Cochera</th><th>Ingreso</th><th>Egreso</th><th>Costo</th></tr></thead><tbody>";
            $.each($.parseJSON(response), function() {
                $table += "<tr>";
                $table += "<td>" + this.patente + "</td>";
                $table += "<td>" + this.marca + "</td>";
                $table += "<td>" + this.cochera + "</td>";
                $table += "<td>" + this.ingreso + "</td>";
                $table += "<td>" + this.egreso + "</td>";
                $table += "<td>$" + this.costo + "</td>";
                $table += "</tr>";
            });
            $table += "</tbody></table>";

            $("#estadisticas").html($table);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

function focusTabs($index){
    switch ($index){
        case 1:
            $("#tabFichajes").addClass("active");
            $("#tabTransacciones").removeClass("active");
            break;
        case 2:
            $("#tabFichajes").removeClass("active");
            $("#tabTransacciones").addClass("active");
            break;
    }
}


function previsualizarFoto(){
    var archivo = $("#foto")[0];
    var formData = new FormData();
    formData.append("archivo", archivo.files[0]);
    formData.append("accion", "previsualizarFoto");

    var $request = new XMLHttpRequest();
    $request.onreadystatechange = function(){
        if($request.readyState == 4 && $request.status == 200){
            $("#divFoto").html(JSON.parse($request.responseText).html);
        }
    };
    $request.open("POST", $url, true);
    $request.send(formData);
}

function deshacerFoto($path){
    var formData = new FormData();
    formData.append("accion", "deshacerFoto");
    formData.append("pathFoto", $path);

    var $request = new XMLHttpRequest();
    $request.onreadystatechange = function(){
        if($request.readyState == 4 && $request.status == 200){
            $("#divFoto").html("");
            $("#foto").val("");
            $("#hdnArchivoTmp").val("");
        }
    };
    $request.open("POST", $url, true);
    $request.send(formData);
}

function TraerEstadiasPorVehiculo(){
    $.ajax({
        url: $url,
        type: "POST",
        data: {
            accion: "TraerEstadiasPorVehiculo"
        }
    })
    .done(function(response){
        $("#principal").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}

// FINAL
// function filtrarVehiculos(){
//     $.ajax({
//         url: $url,
//         type: "POST",
//         data: {
//             accion: "filtrarVehiculos"
//         }
//     })
//     .done(function(response){
//         $filtro = $("#patente").val();
//         $jsonData = $.parseJSON(response);
//         $filterData = $jsonData.filter(function(vehiculo){
//             return vehiculo.patente.includes($filtro);
//         });

//         $tbody = "";
//         $.each($filterData, function() {
//             $tbody += "<tr>";
//             $tbody += "<td>" + this.patente + "</td>";
//             $tbody += "<td>" + this.marca + "</td>";
//             $tbody += "<td>" + this.color + "</td>";
//             $tbody += "</tr>";
//         });
//         $(".table tbody").html($tbody);
//     })
//     .fail(function(response){
//         alert(response.responseText);
//     });
// }