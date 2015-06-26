var map = null;
var marker = null;
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
function RegistrarTipoMascota()
{
	var nom = $("#tipomascota").val();
	if(nom != "")
	{
		$("#resultado3").html('<img src="img/loading.gif" height="30"> Espera un momento');
		$.ajax({
			url: "config/registrartipomascota.php",
			type: "POST",
			data: "nom="+nom,
			success: function(resp){
				$('#resultado3').html(resp);
				RefrescaDiv("registromascota","config/refrescadivregistromascota.php");
				$("#tipomascota").val("");
			}		
		});
	}
	else
	{
		$("#resultado3").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> Por favor escribe los datos para registrar el tipo de mascota.</div>');
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
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': direccion}, geocodeResult);
	var lati = $("#latitud").val();
	var longi = $("#longitud").val();
	var imagen = document.getElementById("imagen").files[0];
	var info = new FormData();
	info.append("tipo",tipo);
	info.append("nom",nom);
	info.append("raza",raza);
	info.append("edad",edad);
	info.append("detalle",detalle);
	info.append("imagen",imagen);
	info.append("latitud",lati);
	info.append("longitud",longi);
	if(tipo != "" && nom != "" && raza != "" && detalle != "" && edad != "")
	{
		$("#resultado2").html('<img src="img/loading.gif" height="30"> Espera un momento');
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
				RefrescaDiv("listadomascota","config/refrescadivlistadomascota.php");
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
function geocodeResult2(results, status) 
{
	if (status == 'OK') 
	{
		var mapOptions = {
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($("#mapa").get(0), mapOptions);
        map.fitBounds(results[0].geometry.viewport);
        var markerOptions = { position: results[0].geometry.location }
        var marker = new google.maps.Marker(markerOptions);
        marker.setMap(map);
    } 
    else 
    {
		alert("No se pudo encontrar la ubicación de la mascota porque se regístro de manera incorrecta");
	}
}
function CargarMapa() 
{
	var myLatlng = new google.maps.LatLng(0, 0);
	var myOptions = {
		zoom: 3,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map($("#mapa").get(0), myOptions);
}
function LocalizarMascota()
{
	var mascota = $("#mascota").val();
	var lat = $('#latitud-'+mascota).val();
	var long = $('#longitud-'+mascota).val();
    var map;
    var mapOptions = {
            zoom: 20,
            disableDefaultUI: true,
            center: new google.maps.LatLng(lat,long), 
            mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
    var markerOptions = { position: new google.maps.LatLng(lat,long) }
    var marker = new google.maps.Marker(markerOptions);
    marker.setMap(map);
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
function RefrescaDiv(div, archivo)
{
	$("#"+div).html('<img src="img/loading.gif" height="30"> Espera un momento');
	$("#"+div).load(archivo);
}
