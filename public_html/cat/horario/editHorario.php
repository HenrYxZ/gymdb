<h2>Editando horario para <?php echo $trainer->apellidoPaterno . ' ' . $trainer->apellidoMaterno . ', ' .$trainer->nombre; ?></h2>

		<form action="index.php" method="get">
			<!-- Seleccionar una fecha -->
			<label for="fecha_inicio">
				Fecha y hora de inicio:
			</label>
			<input type="text" name="fecha_inicio" id="fecha_inicio" value ="<?php echo $horario->fechaInicio; ?>" onchange="resetEndDatetimePicker();" />
			
			<label for="fecha_termino">
				Fecha y hora de t&eacute;rmino:
			</label>
			<input type="text" name="fecha_termino" id="fecha_termino" value ="<?php echo $horario->fechaTermino; ?>" />
			<div class="helper">El m&oacute;dulo de horario debe durar al menos 15 minutos y m&aacute;ximo 4 horas.</div>
			
			<!-- Escoger un tipo de actividad a realizarse en el m�dulo horario -->
			<label for="tipo_actividad">
				Tipo de actividad:
			</label>
			<select name="tipo_actividad" id="tipo_actividad">
				<option value="">-- Tipo de actividad --</option>
				<option <?php if( $horario->tipoActividad == 'Entrenamiento' ) echo 'selected="selected"'; ?> value="Entrenamiento">Entrenamiento</option>
				<option <?php if( $horario->tipoActividad == 'Evaluaci�n' ) echo 'selected="selected"'; ?> value="Evaluacion">Evaluaci&oacute;n</option>
				<option <?php if( $horario->tipoActividad === 'Karate' ) echo 'selected="selected"'; ?> value="Karate">Karate</option>
				<option <?php if( $horario->tipoActividad == null ||  $horario->tipoActividad === '') echo 'selected="selected"'; ?> value="">Otro</option>
			</select>
			
			<!-- Rut del entrenador -->
			<input type="hidden" name="trainerId" value="<?php echo $trainerId; ?>">
			<!-- Info de categor�a y acci�n -->
			<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" value="updateHorario" />
			
			<input type="hidden" name="fecha_inicio_original" value="<?php echo $horario->fechaInicio; ?>" />
			
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