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
		<div class="col-lg-6" id="registromascota">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Registrar Mascota</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="return false" onsubmit="return false">
						<fieldset>
							<label for="tipo" >Tipo de Mascota</label>
							<select id="tipo" class="form-control">
							<?php
							require("config/conexion.php");
							$consulta = mysqli_query($con, "SELECT * FROM tipomascota");
							while($res = mysqli_fetch_array($consulta, MYSQL_ASSOC))
							{
							?>
								<option value="<?php echo $res["id_tipomascota"]; ?>"><?php echo $res["nombre"]; ?></option>
							<?php
							}
							?>
							</select>
							<label for="nombre" >Nombre</label>
							<input type="text" id="nombre" class="form-control" placeholder="soffy"  autofocus>
							<label for="raza">Raza</label>
							<input type="text" id="raza" class="form-control" placeholder="labrador, pitbull, etc" >
							<label for="detalles" >Detalles</label>
							<input type="text" id="detalles" class="form-control" placeholder="">
							<label for="edad">Edad</label>
							<input type="number" id="edad" class="form-control" onkeypress="return SoloNumero(event);" >
							<label for="imagen">Imagen</label>
							<input type="file" id="imagen" name="imagen" class="form-control">
							<label for="direccion" >Dirección (Ciudad)</label>
							<input type="text" id="direccion" class="form-control" placeholder="carrera 34 calle 35 barranquilla">
							<input type="hidden" id="latitud" value="">
							<input type="hidden" id="longitud" value=""><br>
							<button class="btn btn-success btn-block" onclick="RegistrarMascota()"><i class="glyphicon glyphicon-floppy-disk"></i> Regístrar</button>
							<div id="resultado2"></div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Registrar Tipo de Mascota</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="return false" onsubmit="return false">
						<fieldset>
							<label for="tipomascota" >Tipo</label>
							<input type="text" id="tipomascota" class="form-control" placeholder="Perro, Gato, Cerdo, etc"><br>
							<button class="btn btn-success btn-block" onclick="RegistrarTipoMascota()"><i class="glyphicon glyphicon-floppy-disk"></i> Regístrar</button>
							<div id="resultado3"></div>
						</fieldset>
					</form>
				</div>
			</div>	
			<div  id="listadomascota">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-piggy-bank"></i> Mis Mascotas</h3>
				</div>
				<div class="panel-body">
					<?php
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
								<th>Edad</th>
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
