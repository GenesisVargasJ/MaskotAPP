<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="glyphicon glyphicon-piggy-bank"></i> Mis Mascotas</h3>
	</div>
	<div class="panel-body">
	<?php
	session_start();
	require("conexion.php");
	$sesion = $_SESSION["usuario"];
	$consulta2 = mysqli_query($con, "SELECT id_usuario FROM usuario WHERE usuario='$sesion'");
	$res = mysqli_fetch_array($consulta2, MYSQL_ASSOC);
	$id = $res["id_usuario"];
	$consulta3 = mysqli_query($con, "SELECT m.nombre, t.nombre AS tipo, m.edad, m.imagen FROM mascota m, tipomascota t WHERE m.id_usuario = '$id' AND m.id_tipomascota = t.id_tipomascota");
	if(mysqli_num_rows($consulta3) > 0)
	{
	?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Tipo Mascota</th>
				<th>Imagen</th>
			</tr>
		</thead>
		<tbody>
		<?php						
		while($res2 = mysqli_fetch_array($consulta3, MYSQL_ASSOC))
		{
		?>
			<tr><td><?php echo $res2["nombre"]; ?></td><td><?php echo $res2["tipo"]; ?></td><td><?php echo $res2["edad"]; ?> Años</td><td><img src="img/<?php echo $res2["imagen"]; ?>" height="40" width="40"></td></tr>
		<?php
		}
		?>
		</tbody>
	</table>
	<?php
	}
	else
	{
	?>
	<div class="alert alert-info" role="alert"><strong>Aviso!</strong> Aún no tienes registradas mascotas en el sistema.</div>
	<?php
	}
	mysqli_close($con);
	?>
	</div>
</div>
