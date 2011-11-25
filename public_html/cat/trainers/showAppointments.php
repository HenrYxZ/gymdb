<h2>Compromisos pr&oacute;ximos para <?php echo $trainer->apellidoPaterno . ' ' . $trainer->apellidoMaterno . ', ' .$trainer->nombre; ?></h2>
<p>A continuaci&oacute;n se muestran s&oacute;lo los eventos asignados para el entrenador (aquellos que tienen un rut de socio asignado). Se muestran solamente los definidos a partir de hoy en adelante.</p>
<table>
	<tr>
		<th>Fecha inicio</th>
		<th>Fecha t&eacute;rmino</th>
		<th>Tipo actividad</th>
		<th>RUT socio</th>
		<?php
		if( isset( $_SESSION['user'] ) )
		{
			if( get_class( $_SESSION['user'] ) === 'Administrador' || get_class( $_SESSION['user'] ) === 'Entrenador' )
			{?>
			<th class="actions">Acciones</th>
		<?php
			}
		}?>
	</tr>
<?php
foreach($dbh->query($q) as $row){
	?>
	<tr>
		<td><?php echo htmlspecialchars($row['fecha_inicio']); ?></td>
		<td><?php echo htmlspecialchars($row['fecha_termino']); ?></td>
		<td><?php echo htmlspecialchars($row['tipo_actividad']); ?></td>
		<td><?php echo htmlspecialchars($row['rut_socio']); ?></td>
		<?php
		if( isset( $_SESSION['user'] ) )
		{
			if( get_class( $_SESSION['user'] ) === 'Administrador' || get_class( $_SESSION['user'] ) === 'Entrenador' )
			{?>
			<td class="actions">
				<ul>
					<li><a href="index.php?cat=horario&action=editHorario&trainerId=<?php echo $row['rut_entrenador']; ?>&fecha_inicio_original=<?php echo $row['fecha_inicio']; ?>">Editar</a></li>
					<li><a href="#">Eliminar</a></li>
				</ul>
			</td>
		<?php
			}
		}?>
	</tr> 
	<?php
}
?>
</table>