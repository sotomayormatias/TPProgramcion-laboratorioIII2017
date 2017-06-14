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

function editarUsuario(){
    var $usuario = {};
    $usuario.nombre = $("#nombre").val();
    $usuario.correo = $("#correo").val();
    $usuario.turno = $("#turno").val();
    $usuario.password = $("#password").val();
    $usuario.rol = 2;

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

function finalizarOperacion($idOperacion){

    $.ajax({
        url: $url,
        type: "POST",
        data: {
            idOperacion: $idOperacion,
            accion: "finalizarOperacion"
        }
    })
    .done(function(response){
        $("#operaciones").html(response);
    })
    .fail(function(response){
        alert(response.responseText);
    });
}