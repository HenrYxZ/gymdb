<h2>Nuevo horario para <?php echo $trainer->apellidoPaterno . ' ' . $trainer->apellidoMaterno . ', ' .$trainer->nombre; ?></h2>

		<form action="index.php" method="get">
			<!-- Seleccionar una fecha -->
			<label for="fecha_inicio">
				Fecha y hora de inicio:
			</label>
			<input type="text" name="fecha_inicio" id="fecha_inicio" value ="" onchange="resetEndDatetimePicker();" />
			
			<label for="fecha_termino">
				Fecha y hora de t&eacute;rmino:
			</label>
			<input type="text" name="fecha_termino" id="fecha_termino" value ="" />
			<div class="helper">El m&oacute;dulo de horario debe durar al menos 15 minutos y m&aacute;ximo 4 horas.</div>
			
			<!-- Escoger un tipo de actividad a realizarse en el módulo horario -->
			<label for="tipo_actividad">
				Tipo de actividad:
			</label>
			<select name="tipo_actividad" id="tipo_actividad">
				<option selected="selected" value="">-- Tipo de actividad --</option>
				<option value="Entrenamiento">Entrenamiento</option>
				<option value="Evaluacion">Evaluaci&oacute;n</option>
				<option value="Karate">Karate</option>
				<option value="">Otro</option>
			</select>
			
			<!-- Rut del entrenador -->
			<input type="hidden" name="trainerId" value="<?php echo $trainerId; ?>">
			<!-- Info de categoría y acción -->
			<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" value="insertHorario" />
			
			<!-- Enviar -->
			<input type="submit" value="Definir nuevo horario" />
		</form>

<!-- Para poder mostrar los selectores de fecha bonitos -->
<script type="text/javascript">
	var $now = new Date();
	
	$('#fecha_inicio').datetimepicker({
		minDate: $now,
		onClose: function(date) { $('#fecha_termino').val(''); }
	});
	
	$('#fecha_termino').datetimepicker({
		minDate: $now
	});
	
	function resetEndDatetimePicker(){
		$('#fecha_termino').datetimepicker("destroy");
				
		var $minEnd = $('#fecha_inicio').datetimepicker("getDate");
		$minEnd.setMinutes($minEnd.getMinutes()+15);
		
		var $maxEnd = $('#fecha_inicio').datetimepicker("getDate");
		$maxEnd.setHours($maxEnd.getHours()+4);
		
		$('#fecha_termino').datetimepicker({
			minDate: $minEnd,
			maxDate: $maxEnd
		});
	}
	
	function isValidDateObject(objToTest) {
		if (objToTest instanceof Date) return true;
		return false;
	}
</script>