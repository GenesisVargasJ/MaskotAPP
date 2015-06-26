var map;
var mapa;
var gdir;
var geocoder = null;
var addressMarker;
function SoloNumero(e)
{
	var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
	{
		return true;
	}
    return /\d/.test(String.fromCharCode(keynum));
}
function ValidarUsuario()
{
	var user = $("#user").val();
	var pass = $("#pass").val();
	if(user != "" && pass != "")
	{
		$("#resultado").html('<img src="img/loading.gif" height="30"> Espera un momento');
		$.ajax({
			url: "config/validausuario.php",
			type: "POST",
			data: "user="+user+"&pass="+pass,
			success: function(resp){
				$('#resultado').html(resp)
			}		
		});
	}
	else
	{
		$("#resultado").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> Por favor escribe tu usuario y/o contraseña.</div>');
	}
}
function RegistrarUsuario()
{
	var user = $("#user2").val();
	var pass = $("#pass2").val();
	var nom = $("#nombre").val();
	var tel = $("#telefono").val();
	if(user != "" && pass != "" && nom != "" && tel != "")
	{
		$("#resultado2").html('<img src="img/loading.gif" height="30"> Espera un momento');
		$.ajax({
			url: "config/registrarusuario.php",
			type: "POST",
			data: "user="+user+"&pass="+pass+"&nom="+nom+"&tel="+tel,
			success: function(resp){
				$('#resultado2').html(resp)
			}		
		});
	}
	else
	{
		$("#resultado2").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> Por favor escribe los datos para registrar el usuario.</div>');
	}
}
function ActualizarUsuario()
{
	var user = $("#user2").val();
	var pass = $("#pass2").val();
	var nom = $("#nombre").val();
	var tel = $("#telefono").val();
	if(user != "" && pass != "" && nom != "" && tel != "")
	{
		$("#resultado2").html('<img src="img/loading.gif" height="30"> Espera un momento');
		$.ajax({
			url: "config/actualizarusuario.php",
			type: "POST",
			data: "user="+user+"&pass="+pass+"&nom="+nom+"&tel="+tel,
			success: function(resp){
				$('#resultado2').html(resp)
				$("#user2").val("");
				$("#pass2").val("");
				$("#nombre").val("");
				$("#telefono").val("");
			}		
		});
	}
	else
	{
		$("#resultado2").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> Por favor escribe los datos para actualizar el usuario.</div>');
	}
}
function RegistrarMascota()
{
	var tipo = $("#tipo").val();
	var nom = $("#nombre").val();
	var raza = $("#raza").val();
	var detalle = $("#detalles").val();
	var edad = $("#edad").val();
	var direccion = $("#direccion").val();
	var imagen = document.getElementById("imagen").files[0];
	var info = new FormData();
	info.append("imagen",imagen);
	info.append("tipo",tipo);
	info.append("nom",nom);
	info.append("raza",raza);
	info.append("detalle",detalle);
	info.append("edad",edad);
	if(tipo != "" && nom != "" && raza != "" && detalle != "" && edad != "" && imagen != "")
	{
		$("#resultado2").html('<img src="img/loading.gif" height="30"> Espera un momento');
		var geocoder = new google.maps.Geocoder();
	    geocoder.geocode({ 'address': direccion}, geocodeResult);
	    info.append("latitud",$("#latitud").val());
		info.append("longitud",$("#longitud").val());
		$.ajax({
			url: "config/registrarmascota.php",
			type: "POST",
			data:info,
			processData:false,
			contentType:false,
			cache:false,
			success: function(resp){
				$('#resultado2').html(resp);
				$("#tipo").val("");
				$("#nombre").val("");
				$("#raza").val("");
				$("#detalles").val("");
				$("#edad").val("");
				$("#direccion").val("");
			}		
		});
	}
	else
	{
		$("#resultado2").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> Por favor escribe los datos para registrar la mascota.</div>');
	}
}
function geocodeResult(results, status) 
{
	if (status == 'OK') 
	{
		$('#latitud').val(results[0].geometry.location.lat());
		$('#longitud').val(results[0].geometry.location.lng());
    } 
    else 
    {
		alert("No se pudo registrar la ubicación: " + status);
	}
}
function CargarMapa() 
{
	if (GBrowserIsCompatible()) 
	{
		mapa = new GMap2(document.getElementById("mapa"));
		mapa.setCenter(new GLatLng(10.976162,-74.812703), 12); 
		mapa.addControl(new GLargeMapControl());
		mapa.addControl(new GMapTypeControl());
	}
}
function LocalizarMascota()
{
	
}
function Salir()
{
	$("#div").load("config/logout.php");
}
function Oculta(div, div2)
{
	$("#"+div).hide();
	$("#"+div2).show();
}
