<?php
session_start();
if(isset($_POST["user"]) && isset($_POST["pass"]))
{
	require("conexion.php");
	$user = mysqli_real_escape_string($con, $_POST["user"]);
	$pass = mysqli_real_escape_string($con, $_POST["pass"]);
	$consulta = mysqli_query($con, "SELECT * FROM usuario WHERE usuario = '$user' AND contrasena = '$pass'");
	if(mysqli_num_rows($consulta) > 0)
	{
		$_SESSION["usuario"] = $user;
		echo '<script>location.reload();</script>';
	}
	else
	{
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Atención!</strong> El usuario y/o clave son incorrectas, vuelva a intentarlo.</div>';
	}
	mysqli_close($con);
}
?>
