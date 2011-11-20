<table>
	<tr>
		<th>Nombre</th>
		<th>Apellido Paterno</th>
		<th>Apellido Materno</th>
		<th>RUT</th>
		<th>e-mail</th>
		<th>Sexo</th>
		<th>Tipo</th>
	</tr>
<?php
foreach($dbh->query($q) as $row){
	?>
	<tr>
		<td><?php echo $row['nombre']; ?></td>
		<td><?php echo $row['apellido_paterno']; ?></td>
		<td><?php echo $row['apellido_materno']; ?></td>
		<td><?php echo $row['rut_entrenador']; ?></td>
		<td><?php echo $row['email']; ?></td>
		<td><?php echo $row['sexo']; ?></td>
		<td><?php echo $row['tipo_entrenador']; ?></td>
	</tr> 
	<?php
}
?>
</table>
<div>
<br>
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
			<p>Tipo: <select name="tipo_entrenador">
<option value="">- Elegir -</option>
<option value="Personal Trainer">Personal Trainer</option>
<option value="Karate">Karate</option>
<option value="Yoga">Yoga</option>
<option value="Baile">Baile</option>
<option value="Gimnasia">Gimnasia</option>
</p>
			<input type="submit" name="Submit" value="Filtrar">
</form>
					 
					 </div>