<?php
if(isset($_POST["nom"]))
{
	require("conexion.php");
	$nom = mysqli_real_escape_string($con, $_POST["nom"]);
	$consulta = mysqli_query($con, "SELECT * FROM tipomascota WHERE nombre = '$nom'");
	if(mysqli_num_rows($consulta) > 0)
	{
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El tipo de mascota no pudo ser registrado porque ya existe.</div>';
	}
	else
	{
		$consulta2 = mysqli_query($con, "INSERT INTO tipomascota VALUES('', '$nom')");
		if($consulta2)
		{
			echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El tipo de mascota ha sido guardado exitosamente.</div>';
		}
		else
		{
			echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> El tipo de mascota no pudo ser guardado, vuelva a intentarlo.</div>';
		}
	}
	mysqli_close($con);
}
?>
