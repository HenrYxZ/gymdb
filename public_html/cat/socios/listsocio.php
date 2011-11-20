
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
	$sql="SELECT * from socio";
	foreach($dbh->query($sql) as $socio)
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

<!-- Vinculo para crear un nuevo socio -->
<p><a href='index.php?cat=socios&action=addsocio'>Agregar nuevo socio</a></p>