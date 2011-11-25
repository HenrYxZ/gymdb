
<!-- lista evaluaciones -->

<h1>Listado de evaluaciones para <?php echo $socio->nombre ?></h1>

<table border='1' cellpadding='15'>
	<tr>
            <th>Fecha de evaluaci&oacute;n</th>
		<th>Rut</th>
		<th>Rut de entrenador</th>
		<th>Peso (kgs)</th>
		<th>Estatura (cms)</th>
		<th>IMC</th>	
	</tr>

<?php 
	//Para cada socio
	
	foreach($dbh->query($q) as $socio)
	{
		//Creamos una fila de la tabla
?>
	
	<tr>
		
		<td><?php echo $socio['fecha_evaluacion']?></td>
		<td><a href='index.php?cat=socios&action=infosocio&rutsocio=<?php echo $socio['rut_socio']?>'><?php echo $socio['rut_socio']?></a></td>
		<td><?php echo $socio['rut_entrenador']?></td>
		<td><?php echo $socio['peso_en_kg']?></td>
		<td><?php echo $socio['estatura_en_cm']?></td>
		<td><?php echo $socio['porcentaje_grasa']?></td>
	</tr>

<?php
	}
?>
</table>
