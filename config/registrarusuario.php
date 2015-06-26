<?php
session_start();
if(isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["nom"]) && isset($_POST["tel"]))
{
	require("conexion.php");
	$user = mysqli_real_escape_string($con, $_POST["user"]);
	$pass = mysqli_real_escape_string($con, $_POST["pass"]);
	$nom = mysqli_real_escape_string($con, $_POST["nom"]);
	$tel = mysqli_real_escape_string($con, $_POST["tel"]);
	$consulta = mysqli_query($con, "SELECT * FROM usuario WHERE usuario = '$user'");
	if(mysqli_num_rows($consulta) > 0)
	{
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El usuario no pudo ser registrado porque ya existe este nombre de usuario.</div>';
	}
	else
	{
		$consulta2 = mysqli_query($con, "INSERT INTO usuario VALUES('', '$user', '$pass', '$nom', '$tel')");
		if($consulta2)
		{
			$_SESSION["usuario"] = $user;
			echo '<script>location.reload();</script>';
		}
		else
		{
			echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El usuario no pudo ser guardado, vuelva a intentarlo.</div>';
		}
	}
	mysqli_close($con);
}
?>
