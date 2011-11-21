
<!-- lista socios -->

<h1>Listado de socios</h1>

<p>Estos son todos los socios:<p>

<table border='1' cellpadding='15'>
	<tr>
		<th>Rut</th>
		<th>Email</th>
		<th>Nombre</th>
		<th>Apellido Paterno</th>
		<th>Apellido Materno</th>
		<th>Sexo</th>
		<th>Comuna</th>
		<th>Dirección</th>
		<th>Fecha de Registro</th>
		<th>Fecha de Nacimiento</th>
		<th>Telefono1</th>
		<th>Telefono2</th>
		
		
	</tr>

<?php 
	//Para cada socio
	
	foreach($dbh->query($q) as $socio)
	{
		//Creamos una fila de la tabla
?>
	
	<tr>
		<td><a href='index.php?cat=socios&action=infosocio&rutsocio=<?php echo $socio['rut_socio']?>'><?php echo $socio['rut_socio']?></a></td>
		<td><?php echo $socio['email']?></td>
		<td><?php echo $socio['nombre']?></td>
		<td><?php echo $socio['apellido_paterno']?></td>
		<td><?php echo $socio['apellido_materno']?></td>
		<td><?php echo $socio['sexo']?></td>
		<td><?php echo $socio['comuna']?></td>
		<td><?php echo $socio['direccion']?></td>
		<td><?php echo $socio['fecha_registro']?></td>
		<td><?php echo $socio['fecha_nacimiento']?></td>
		<td><?php echo $socio['telefono1']?></td>
		<td><?php echo $socio['telefono2']?></td>
	</tr>

<?php
	}
?>
</table>

<form method="get" action="index.php">
			 <input type="hidden" name="cat" id="cat" value="<?php echo $cat; ?>" />
			 <input type="hidden" name="action" id="action" value="<?php echo $action; ?>" />
	 	 	 <p>RUT:<input type="text" name="rut_entrenador"></p>
			 <p>e-mail: <input type="text" name="email"></p>
			 <p>Nombre:<input type="text" name="nombre"></p>
			 <p>Apellido Paterno:<input type="text" name="apellido_paterno"></p>
			 <p>Apelllido Materno:<input type="text" name="apellido_materno"></p>
			 
			<p>Sexo:
			<input type="radio" name="sexo" value="mujer">Femenino
			<input type="radio" name="sexo" value="hombre">Masculino</p>
			<p>Comuna: <input type="text" name="comuna"></p>
			<p>direccion: <input type="text" name="direccion"></p>
			<p>Fecha de Registro: <input type="text" name="fecha_registro"></p>
			<p>Fecha de Nacimiento: <input type="text" name="fecha_nacimiento"></p>
			<p>Telefono 1: <input type="text" name="telefono1"></p>
			<p>Telefono 2: <input type="text" name="telefono2"></p>
			<input type="submit" name="Submit" value="Filtrar">
</form>

<!-- Vinculo para crear un nuevo socio -->
<p><a href='index.php?cat=socios&action=addsocio'>Agregar nuevo socio</a></p>