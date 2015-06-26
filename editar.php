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
					<h3 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Editar Perfil</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="return false" onsubmit="return false">
						<fieldset>
							<label for="user" >Usuario</label>
							<input type="text" id="user2" class="form-control" placeholder="fulanito"  autofocus>
							<label for="pass">Contraseña</label>
							<input type="password" id="pass2" class="form-control" placeholder="contraseña" >
							<label for="user" >Nombre</label>
							<input type="text" id="nombre" class="form-control" placeholder="fulanito perez">
							<label for="pass">Teléfono</label>
							<input type="text" id="telefono" class="form-control" placeholder="3000000" onkeypress="return SoloNumero(event);"><br>
							<button class="btn btn-success btn-block" onclick="ActualizarUsuario()"><i class="glyphicon glyphicon-floppy-disk"></i> Actualizar</button>
							<div id="resultado2"></div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Mi Perfil</h3>
				</div>
				<div class="panel-body">
					<a class="btn btn-block btn-success" href="perfil.php"><i class="glyphicon glyphicon-eye-open"></i> Ver Perfil</a>
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
