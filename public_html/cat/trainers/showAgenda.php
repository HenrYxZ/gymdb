<?php
$row = $dbh->query($q2)->fetch(PDO::FETCH_ASSOC);
?>
<h2>Agenda para <?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ', ' .$row['nombre']; ?></h2>
<p>A continuaci&oacute;n se muestran tanto las horas disponibles como los eventos asignados para el entrenador (aquellos que tienen un rut de socio asignado). Se muestran solamente los definidos a partir de hoy en adelante.</p>
<table>
	<tr>
		<th>Fecha inicio</th>
		<th>Fecha t&eacute;rmino</th>
		<th>Tipo actividad</th>
		<th>RUT socio</th>
	</tr>
<?php
foreach($dbh->query($q) as $row){
	?>
	<tr>
		<td><?php echo htmlspecialchars($row['fecha_inicio']); ?></td>
		<td><?php echo htmlspecialchars($row['fecha_termino']); ?></td>
		<td><?php echo htmlspecialchars($row['tipo_actividad']); ?></td>
		<td><?php echo htmlspecialchars($row['rut_socio']); ?></td>
	</tr> 
	<?php
}
?>
</table>