<?php
session_start();
include("config/header.php");
if(isset($_SESSION["usuario"]))
{
?>
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">
				<img alt="Brand" src="img/logo.png" style="max-height:30px">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido: <?php echo $_SESSION["usuario"]; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" onclick="Salir()">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Regresar al menú</a></li>
			</ol>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-map-marker"></i> Localizar Mascota</h3>
				</div>
				<div class="panel-body">
					
					<?php
					require("config/conexion.php");
					$sesion = $_SESSION["usuario"];
					$consulta = mysqli_query($con, "SELECT id_usuario FROM usuario WHERE usuario='$sesion'");
					$res = mysqli_fetch_array($consulta, MYSQL_ASSOC);
					$id = $res["id_usuario"];
					$consulta2 = mysqli_query($con, "SELECT * FROM mascota WHERE id_usuario = '$id'");
					$numero = mysqli_num_rows($consulta2);
					if($numero > 0)
					{
						?>
					<label for="mascota">Mascota a localizar:</label>
					<select class="form-control" id="mascota">
						<?php
						$lat = array();
						$long = array();
						$id = array();
						for($i = 0; $i <= $numero-1; $i++)
						{
							$res = mysqli_fetch_array($consulta2, MYSQL_ASSOC);
							$lat[$i] = $res["latitud"];
							$long[$i] = $res["longitud"];
							$id[$i] = $res["id_mascota"];
						?>
							<option value="<?php echo $res["id_mascota"]; ?>"><?php echo $res["nombre"]; ?></option>
						<?php
						}
						?>
					</select><br>
					<button class="btn btn-success btn-block" onclick="LocalizarMascota()"><i class="glyphicon glyphicon-search"></i> Encontrar</button><br>
						<?php
						for($i = 0; $i <= $numero-1; $i++)
						{
						?>
							<input type="hidden" value="<?php echo $lat[$i]; ?>" id="latitud-<?php echo $id[$i]; ?>">
							<input type="hidden" value="<?php echo $long[$i]; ?>" id="longitud-<?php echo $id[$i]; ?>">
						<?php
						}
					}
					else
					{
						?>
						<div class="alert alert-info" role="alert"><strong>Aviso!</strong> Aún no tienes registradas mascotas en el sistema.</div>
						<a class="btn btn-block btn-success" href="mascota.php"><i class="glyphicon glyphicon-plus"></i> Regístrar Mascota</a><br>
						<?php
					}
					mysqli_close($con);
					?>
					<div id="mapa" style="width:100%; height:300px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="div"></div>
</div>
<script>
$(document).ready(function() {
    CargarMapa();
});
</script>
<?php
}
else
{
	header('Location: index.php');
}
include("config/footer.php");
?>
