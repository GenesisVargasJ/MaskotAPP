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
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-piggy-bank"></i> Mascotas</h3>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						<a href="mascota.php"><li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> Regístrar Mascota</li></a>
						<a href="localizar.php"><li class="list-group-item"><i class="glyphicon glyphicon-map-marker"></i> Localizar Mascota</li></a>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Usuario</h3>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						<a href="perfil.php"><li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> Mi Perfil</li></a>
						<a href="editar.php"><li class="list-group-item"><i class="glyphicon glyphicon-edit"></i> Actualizar Perfil</li></a>
					</ul>
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
?>
<div class="container">
	<form class="form-signin" id="login" method="POST" action="return false" onsubmit="return false">
		<img src="img/logo.png" style="max-width:200px;margin:0 auto;">
		<fieldset>
			<legend>Inicio de sesión</legend>
			<label for="user" >Usuario</label>
			<input type="text" id="user" class="form-control" placeholder="fulanito"  autofocus>
			<label for="pass">Contraseña</label>
			<input type="password" id="pass" class="form-control" placeholder="contraseña" >
			<button class="btn btn-lg btn-success btn-block" onclick="ValidarUsuario()">Entrar</button>
			<a href="#" onclick="Oculta('login','registro')">¿No tiene usuario? Regístrese</a>
			<div id="resultado"></div>
		</fieldset>
	</form>
	<form class="form-signin" id="registro" method="POST" action="return false" onsubmit="return false" style="display:none">
		<img src="img/logo.png" style="max-width:200px;margin:0 auto;">
		<fieldset>
			<legend>Regístro de Usuario</legend>
			<label for="user" >Usuario</label>
			<input type="text" id="user2" class="form-control" placeholder="fulanito"  autofocus>
			<label for="pass">Contraseña</label>
			<input type="password" id="pass2" class="form-control" placeholder="contraseña" >
			<label for="user" >Nombre</label>
			<input type="text" id="nombre" class="form-control" placeholder="fulanito perez">
			<label for="pass">Teléfono</label>
			<input type="text" id="telefono" class="form-control" placeholder="3000000" onkeypress="return SoloNumero(event);">
			<button class="btn btn-lg btn-success btn-block" onclick="RegistrarUsuario()">Regístrar</button>
			<a href="#" onclick="Oculta('registro','login')">¿Ya tiene usuario? Ingrese</a>
			<div id="resultado2"></div>
		</fieldset>
	</form>
</div>
<?php
}
include("config/footer.php");
?>
