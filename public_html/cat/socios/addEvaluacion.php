<h2>Insertar nueva evaluaci&oacute;n para <?php echo $socio->apellidoPaterno . ' ' . $socio->apellidoMaterno . ', ' .$socio->nombre; ?></h2>

		<form action="index.php" method="get">
			<!-- Seleccionar una fecha -->
			<label for="fecha_evaluacion">
				Fecha (opcionalmente hora) de evaluaci&oacute;n:
			</label>
			<input type="text" name="fecha_evaluacion" id="fecha_evaluacion" value ="" />
			
			<!-- Rellenar datos -->
			<label for="peso_en_kg">
				Peso (en kg):
			</label>
			<input type="text" name="peso_en_kg" id="peso_en_kg" value="" class="txtboxToFilter" />
			
			<label for="estatura_en_cm">
				Estatura (en cm):
			</label>
			<input type="text" name="estatura_en_cm" id="estatura_en_cm" value="" class="txtboxToFilter" />
			
			<label for="porcentaje_grasa">
				Porcentaje de grasa:
			</label>
			<input type="text" name="porcentaje_grasa" id="porcentaje_grasa" value="" class="txtboxToFilter" />
			
			
			
			
			
			<!-- Rut del entrenador y socio -->
			<input type="hidden" name="trainerId" value="<?php echo $trainer->rut; ?>">
			<input type="hidden" name="socioId" value="<?php echo $socio->rut; ?>">
			
			
			
			<!-- Info de categoría y acción -->
			<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" value="insertEvaluacion" />
			
			<!-- Enviar -->
			<input type="submit" value="Ingresar evaluaci&oacute;n" />
		</form>

<!-- Para poder mostrar los selectores de fecha bonitos -->
<script type="text/javascript">
	
	$('#fecha_evaluacion').datetimepicker({	});
	
	
	$(document).ready(function() {
		$(".txtboxToFilter").keydown(function(event) {
			// Allow only backspace and delete
			if ( event.keyCode == 46 || event.keyCode == 8 ) {
				// let it happen, don't do anything
			}
			else {
				// Ensure that it is a number and stop the keypress
				if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
					event.preventDefault(); 
				}   
			}
		});
	});
	
	
</script>