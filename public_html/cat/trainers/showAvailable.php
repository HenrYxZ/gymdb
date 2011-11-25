<h2>Fechas disponibles para <?php echo $trainer->apellidoPaterno . ' ' . $trainer->apellidoMaterno . ', ' .$trainer->nombre; ?></h2>
<p>Se muestran las horas disponibles (sin un socio asignado) a partir de hoy en adelante.</p>
<table>
	<tr>
		<th>Fecha inicio</th>
		<th>Fecha t&eacute;rmino</th>
		<th>Tipo actividad</th>
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