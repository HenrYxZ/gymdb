<?php
	// Intentar mostrar lo que se pide (porque la DB podr�a fallar)
	try{
		// Intentar crear una variable dbh que contiene el objeto PDO inicializado
		/* require('_connect.php');
		*/
		
		$q = 	'SELECT *
				FROM Socio
				ORDER BY apellido_paterno ASC';
		?>
		<!-- Atributo action de tag form es el index.php en el directorio ra�z de ~grupo19. -->
		<form action="index.php" method="get" class="selectUser">
			<h2>Escoger un socio</h2>
		
			<input type="hidden" name="cat" id="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" id="action" value="<?php echo $action; ?>" />
			
			<?php
			if(isset($_GET['trainerId']))
			{?>
			<input type="hidden" name="trainerId" id="trainerId" value="<?php echo $_GET['trainerId']; ?>" />
			<?php
			}?>
			
			
			<label for="socioId">Socio:</label>
			<select name="socioId" id="socioId">
				<option value="">--- Elegir ---</option>
				<?php
				foreach($dbh->query($q) as $row){
				?>
					<option value="<?php echo htmlspecialchars($row['rut_socio']); ?>">
						<?php
							echo htmlspecialchars($row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ', ' . $row['nombre']);
						?>
					</option>
					<?php
				}
				?>
			</select>
			<input type="submit" value="Aceptar" />
		</form>
	
		<?php
	}
	catch(PDOException $e){
		Debugger::notice($e->getMessage());
	}
?>