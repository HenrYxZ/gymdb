<?php
// Definir las variables
$action = 'index';
if(isset($_GET['action']))
{
	$action = $_GET['action'];
}



// Intentar mostrar lo que se pide (porque la DB podría fallar)
try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado
	require('_connect.php');

	
	// *****************************************
	// *** Aquí van los ifs para cada action ***
	// *****************************************
	if($action == 'index')
	{
		require('horario/index.php');
		
	}
	elseif($action == 'newHorario')
	{
		if(isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0))
		{	
			$trainerId = $_GET['trainerId'];
		}
		elseif( isset( $_SESSION['user'] ) )
		{
			if( get_class( $_SESSION['user'] ) === 'Entrenador' )
				$trainerId = $_SESSION['user']->rut;
		}
		
		if(isset($trainerId))
		{
			$trainer = new Entrenador($trainerId);
			
			require('horario/newHorario.php');
		}
		else{
			Debugger::notice('No se defini&oacute; una id de entrenador.');
			
			// Mostrar formulario para seleccionar un trainer. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectTrainer.php');
			
		}
	}
	elseif($action == 'editHorario')
	{
		if(isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0))
		{
			$trainerId = $_GET['trainerId'];
		}
		
		if(isset($trainerId))
		{
			$trainer = new Entrenador($trainerId);
			
			if( isset($_GET['fecha_inicio_original']) && (strlen($_GET['fecha_inicio_original']) > 0) )
			{
				$horario = new Horario($trainerId, $_GET['fecha_inicio_original']);
				
				require('horario/editHorario.php');
			}
			else
			{
				Debugger::notice('No se defini&oacute; una fecha de inicio para el horario. No se puede identificar el horario a editar.');
			
				require('default.php');
			}
		}
		else{
			Debugger::notice('No se defini&oacute; una id de entrenador. No se puede identificar el horario a editar.');
			
			require('default.php');
		}
	}
	elseif($action == 'insertHorario' || $action == 'updateHorario')
	{
		if
			(
				isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0) &&
				isset($_GET['fecha_inicio']) && (strlen($_GET['fecha_inicio']) > 0) &&
				isset($_GET['fecha_termino']) && (strlen($_GET['fecha_termino']) > 0) &&
				isset($_GET['tipo_actividad'])
			)
		{	
			// Variable que tendrá al objeto Horario
			$horario;
			
			if($action == 'insertHorario')
				$horario = new Horario();
			elseif ($action == 'updateHorario')
			{
				$horario = new Horario($_GET['trainerId'], $_GET['fecha_inicio_original']); // -------------------OJO LA FECHA DE INICIO PUEDE SER DIFERENTE. DEBE TOMARSE LA ORIGINAL
			}
			
			$horario->fechaInicio = $_GET['fecha_inicio'];
			$horario->fechaTermino = $_GET['fecha_termino'];
			$horario->rutEntrenador = $_GET['trainerId'];
			
			$horario->tipoActividad = $_GET['tipo_actividad'];
			
			$opOK;
			if($action == 'insertHorario')
				$opOK = $horario->insert();
			elseif ($action == 'updateHorario')
				$opOK = $horario->update();
				
			if($opOK)
			{
			?>
			
			<h2>Se ha <?php if($action == 'insertHorario') echo 'creado'; elseif($action == 'updateHorario') echo 'actualizado'  ?> un horario</h2>
			<p>Puede consultarlo desde la <a href="index.php?cat=trainers&action=showAgenda&trainerId=<?php echo $_GET['trainerId']; ?>">agenda para el entrenador</a>.</p>
			
			<?php
			}
			else
			{?>
				<h2>No es posible crear o modificar el horario</h2>
			
				<p>Hubo un problema en la ejecuci&oacute;n de la consulta por parte del objeto PDO. Puede <a href="index.php?cat=horario&action=<?php echo $action; ?>">volver a intentarlo</a></p>
			<?php
			}
			
		}
		elseif ($action == 'deleteHorario')
		{
			if( isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0) &&
				isset($_GET['fecha_inicio']) && (strlen($_GET['fecha_inicio']) > 0) )
			{
				$horario = new Horario($_GET['trainerId'], $_GET['fecha_inicio']);
				$horario->delete();
				$horario = null;
			}
			else
			{
				Debugger::notice('No se cuenta con los campos requeridos.');
				require('default.php');
			}
		}
		else
		{
			Debugger::notice('No se cuenta con los campos requeridos.');
			?>
			
			<h2>No es posible crear el nuevo horario</h2>
			
			<p>No se cuenta con todos los campos requeridos. Puede <a href="index.php?cat=horario&action=<?php echo $action; ?>">volver a intentarlo</a> desde el formulario.</p>
			
			<?php
		}
	}
	elseif($action == 'setHorario')
	{
		if(isset($_GET['socioId']) && (strlen($_GET['socioId']) > 0))
		{	
			$socioId = $_GET['socioId'];
		}
		elseif( isset( $_SESSION['user'] ) )
		{
			if( get_class( $_SESSION['user'] ) === 'Socio' )
				$socioId = $_SESSION['user']->rut;
		}
		
		if(isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0))
		{	
			$trainerId = $_GET['trainerId'];
		}
		
		if(isset($socioId))
		{
			if(isset($trainerId))
			{
				$qS =	'SELECT *
					FROM Socio
					WHERE rut_socio = \'' . $socioId . '\'';
				
				$qE =	'SELECT *
					FROM Entrenador
					WHERE rut_entrenador = \'' . $trainerId . '\'';
				
				$qH = 'SELECT *
					FROM horario
					WHERE rut_entrenador = \'' . $trainerId . '\'
					AND rut_socio ISNULL
					AND fecha_inicio > CURRENT_TIMESTAMP
					ORDER BY fecha_inicio ASC';
				
				require('horario/setHorario.php');
			}
			else
			{
				Debugger::notice('No se defini&oacute; una id de entrenador.');
			
				// Mostrar formulario para seleccionar un trainer. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectTrainer.php');
			}
		}
		else
		{
			Debugger::notice('No se defini&oacute; una id de socio.');
			
			// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectSocio.php');
		}		
	}
	elseif($action == 'insertSetHorario')
	{
		if
			(
				isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0) &&
				isset($_GET['fecha_inicio']) && (strlen($_GET['fecha_inicio']) > 0) &&
				isset($_GET['socioId']) && (strlen($_GET['socioId']) > 0)
			)
		{	
			$trainerId = $_GET['trainerId'];
			$fecha_inicio = $_GET['fecha_inicio'];
			$socioId = $_GET['socioId'];
			
			$q = "UPDATE horario
					SET rut_socio = '" .$socioId. "'
					WHERE fecha_inicio = '" . $fecha_inicio . "'
					AND rut_entrenador = '" .$trainerId. "'";
			
			$dbh->exec($q);
			
			Debugger::notice('Consulta ejecutada.');
			?>
			
			<h2>Se reservado el horario</h2>
			<p>Puede consultarlo desde la <a href="index.php?cat=trainers&action=showAgenda&trainerId=<?php echo $trainerId; ?>">agenda para el entrenador</a>.</p>
			
			<?php
			
		}
		else
		{
			Debugger::notice('No se cuenta con los campos requeridos.');
			?>
			
			<h2>No es posible reservar el horario</h2>
			
			<p>No se cuenta con todos los campos requeridos. Puede <a href="index.php?cat=horario&action=setHorario">volver a intentarlo</a>.</p>
			
			<?php
		}
	}
	else{
		Debugger::notice('Acci&oacute;n "' . $action . '" no reconocida.');
		
	}
	
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>