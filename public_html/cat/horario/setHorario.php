<?php
$rowS = $dbh->query($qS)->fetch(PDO::FETCH_ASSOC);
$rowE = $dbh->query($qE)->fetch(PDO::FETCH_ASSOC);
?>
<h2>Fijar horario con el entrenador <?php echo $rowE['apellido_paterno'] . ' ' . $rowE['apellido_materno'] . ', ' .$rowE['nombre']; ?></h2>
<h3>Socio <?php echo $rowS['apellido_paterno'] . ' ' . $rowS['apellido_materno'] . ', ' .$rowS['nombre']; ?></h3>

		<form action="index.php" method="get">
			<p>Seleccionar una fecha disponible:</p>
			<!-- Seleccionar una fecha -->
			<?php
			foreach ($dbh->query($qH) as $i => $row)
			{
				?><input type="radio" name="fecha_inicio" value="<?php echo $row['fecha_inicio']; ?>"<?php if( $i == 0 ){ ?> checked="checked"<?php } ?>>
				<strong>Desde:</strong>
				<?php echo $row['fecha_inicio']; ?>
				<strong>hasta:</strong>
				<?php echo $row['fecha_termino'];
				
				if (strlen($row['tipo_actividad']) > 0)
				{
				?>
				&mdash; <strong>Actividad:</strong> <?php echo $row['tipo_actividad'];
				}				
				?>
				<br />
			<?php
			}
			?>
			
			<!-- Ruts -->
			<input type="hidden" name="socioId" value="<?php echo $socioId; ?>">
			<input type="hidden" name="trainerId" value="<?php echo $trainerId; ?>">
			<!-- Info de categoría y acción -->
			<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" value="insertSetHorario" />
			
			<!-- Enviar -->
			<input type="submit" value="Reservar horario" />
		</form>