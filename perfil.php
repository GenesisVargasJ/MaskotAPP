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
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Mi Perfil</h3>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						<?php
						require("config/conexion.php");
						$user = $_SESSION["usuario"];
						$consulta = mysqli_query($con, "SELECT * FROM usuario WHERE usuario = '$user'");
						$res = mysqli_fetch_array($consulta, MYSQL_ASSOC);
						?>
						<li class="list-group-item"><i class="glyphicon glyphicon-user"></i> <?php echo $res["nombre"]; ?></li>
						<li class="list-group-item"><i class="glyphicon glyphicon-phone-alt"></i> <?php echo $res["telefono"]; ?></li>
						<li class="list-group-item"><i class="glyphicon glyphicon-user"></i> <?php echo $res["usuario"]; ?></li>
						<li class="list-group-item"><i class="glyphicon glyphicon-lock"></i> <?php echo $res["contrasena"]; ?></li>
						<?php
						mysqli_close($con);
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Actualizar Información</h3>
				</div>
				<div class="panel-body">
					<a class="btn btn-block btn-success" href="editar.php"><i class="glyphicon glyphicon-edit"></i> Editar Perfil</a>
				</div>
			</div>
		</div>
	</div>
	<div id="div"></div>
</div>
<?php
}
else
{
	header('Location: index.php');
}
include("config/footer.php");
?>
