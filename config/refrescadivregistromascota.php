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
				require("conexion.php");
				$consulta = mysqli_query($con, "SELECT * FROM tipomascota");
				while($res = mysqli_fetch_array($consulta, MYSQL_ASSOC))
				{
				?>
					<option value="<?php echo $res["id_tipomascota"]; ?>"><?php echo $res["nombre"]; ?></option>
				<?php
				}
				mysqli_close($con);
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
