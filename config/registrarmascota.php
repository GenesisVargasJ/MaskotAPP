<?php
session_start();
if(isset($_POST["tipo"]) && isset($_POST["nom"]) && isset($_POST["raza"]) && isset($_POST["edad"]) && isset($_POST["detalle"]))
{
	require("conexion.php");
	$tipo = mysqli_real_escape_string($con, $_POST["tipo"]);
	$nom = mysqli_real_escape_string($con, $_POST["nom"]);
	$raza = mysqli_real_escape_string($con, $_POST["raza"]);
	$edad = mysqli_real_escape_string($con, $_POST["edad"]);
	$detalle = mysqli_real_escape_string($con, $_POST["detalle"]);
	$lat = $_POST["latitud"];
	$long = $_POST["longitud"];
	$sesion = $_SESSION["usuario"];
	$consulta = mysqli_query($con, "SELECT id_usuario FROM usuario WHERE usuario='$sesion'");
	$res = mysqli_fetch_array($consulta, MYSQL_ASSOC);
	$id = $res["id_usuario"];
	$archivo = $_FILES['imagen']['tmp_name'];
	$imagen = $_FILES['imagen']['name'];
	move_uploaded_file($archivo, "../img/".$imagen);
	$consulta2 = mysqli_query($con, "INSERT INTO mascota VALUES('', '$id', '$tipo', '$nom', '$raza', '$edad', '$detalle', '$imagen', '$lat', '$long')");
	if($consulta2)
	{
		echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> La mascota ha sido regístrada exitosamente.</div>';
	}
	else
	{
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> La mascota no pudo ser regístrada, vuelva a intentarlo.</div>';
	}
	mysqli_close($con);
}
?>
