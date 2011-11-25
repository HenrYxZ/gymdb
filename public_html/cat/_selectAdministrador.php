<?php
	// Intentar mostrar lo que se pide (porque la DB podría fallar)
	try{
		// Intentar crear una variable dbh que contiene el objeto PDO inicializado
		/* require('_connect.php');
		*/
		
		$q = 	'SELECT *
				FROM Administrador
				ORDER BY apellido_paterno ASC';
		?>
		<!-- Atributo action de tag form es el index.php en el directorio raíz de ~grupo19. -->
		<form action="index.php" method="get" class="selectUser">
			<h2>Escoger un administrador</h2>
		
			<input type="hidden" name="cat" id="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" id="action" value="<?php echo $action; ?>" />
			
			<input type="hidden" name="socioId" id="socioId" value="<?php if(isset($_GET['socioId'])) { echo $_GET['socioId']; }?>" />
			
			<label for="administradorId">Administrador:</label>
			<select name="administradorId" id="administradorId">
				<option value="">--- Elegir ---</option>
				<?php
				foreach($dbh->query($q) as $row){
				?>
					<option value="<?php echo htmlspecialchars($row['rut_admin']); ?>">
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