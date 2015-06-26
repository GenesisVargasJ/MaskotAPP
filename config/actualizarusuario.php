<?php
session_start();
if(isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["nom"]) && isset($_POST["tel"]))
{
	require("conexion.php");
	$sesion = $_SESSION["usuario"];
	$consulta = mysqli_query($con, "SELECT id_usuario FROM usuario WHERE usuario='$sesion'");
	$res = mysqli_fetch_array($consulta, MYSQL_ASSOC);
	$id = $res["id_usuario"];
	$user = mysqli_real_escape_string($con, $_POST["user"]);
	$pass = mysqli_real_escape_string($con, $_POST["pass"]);
	$nom = mysqli_real_escape_string($con, $_POST["nom"]);
	$tel = mysqli_real_escape_string($con, $_POST["tel"]);
	$consulta2 = mysqli_query($con, "SELECT * FROM usuario WHERE usuario = '$user'");
	if(mysqli_num_rows($consulta2) > 0)
	{
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El usuario no pudo ser actualizado porque ya existe este nombre de usuario.</div>';
	}
	else
	{
		$consulta3 = mysqli_query($con, "UPDATE usuario SET usuario='$user', contrasena='$pass', nombre='$nom', telefono='$tel' WHERE id_usuario='$id'");
		if($consulta3)
		{
			$_SESSION["usuario"] = $user;
			echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El usuario ha sido actualizado exitosamente.</div>';
		}
		else
		{
			echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El usuario no pudo ser actualizado, vuelva a intentarlo.</div>';
		}
	}
	mysqli_close($con);
}
?>
