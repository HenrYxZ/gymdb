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
		require('trainers/index.php');
		
	}
	elseif($action == 'showAgenda' || $action == 'showAppointments')
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
		
			if ( $action == 'showAgenda' )
			{
				$q = 	'SELECT *
						FROM Horario
						WHERE rut_entrenador = \'' . $trainerId . '\'' .
						'AND fecha_inicio >= CURRENT_TIMESTAMP
						ORDER BY fecha_inicio ASC';
				require('trainers/showAgenda.php');
			}
			elseif ( $action == 'showAppointments' )
			{
				$q = 	'SELECT *
						FROM Horario
						WHERE rut_entrenador = \'' . $trainerId . '\'' .
						'AND fecha_inicio >= CURRENT_TIMESTAMP
						AND rut_socio IS NOT NULL
						ORDER BY fecha_inicio ASC';
				require('trainers/showAppointments.php');
			}
			
		}
		else{
			Debugger::notice('No se defini&oacute; una id de entrenador.');
			
			// Mostrar formulario para seleccionar un trainer. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectTrainer.php');
			
		}
	}
	elseif($action == 'showTrainers'){
		
		if(isset($_GET['nombre'])&&""!==$_GET['nombre'])
		{
			$filtros[]= array('nombre',$_GET['nombre']);
			
		}
		if(isset($_GET['email'])&&""!==$_GET['email'])
		{
			$filtros[]= array('email',$_GET['email']);
			
		}
		if(isset($_GET['apellido_paterno'])&&""!==$_GET['apellido_paterno'])
		{
			$filtros[]= array('apellido_paterno',$_GET['apellido_paterno']);
			
		}
		if(isset($_GET['apellido_materno'])&&""!==$_GET['apellido_materno'])
		{
			$filtros[]= array('apellido_materno',$_GET['apellido_materno']);
			
		}
		if(isset($_GET['rut_entrenador'])&&""!==$_GET['rut_entrenador'])
		{
			$filtros[]= array('rut_entrenador',$_GET['rut_entrenador']);
			
		}
		if(isset($_GET['sexo'])&&""!==$_GET['sexo'])
		{
			$filtros[]= array('sexo',$_GET['sexo']);
			
		}
		if(isset($_GET['tipo_entrenador'])&&""!==$_GET['tipo_entrenador'])
		{
			$filtros[]= array('tipo_entrenador',$_GET['tipo_entrenador']);
			
		}
		$q='SELECT * FROM entrenador';
		$strFiltros ='';
		if(isset($filtros)){ 
		
		$strFiltros = ' WHERE ';
		//concatena una sentencia AND por cada filtro guardado en la variable filtros
		$i=0;
		while($i<count($filtros)){
			if($i>0){
				$strFiltros.=' AND '.$filtros[$i][0].' ILIKE '."'%".$filtros[$i][1]."%'";
				}
			else{
				$strFiltros.=$filtros[$i][0]." ILIKE "."'%".$filtros[$i][1]."%'";
				}
				$i++;
				
		}
		}
		$q=$q.$strFiltros.';'; //termina la consulta
		Debugger::notice($q);
		require('trainers/showTrainers.php');
			
	}
	elseif($action == 'addTrainers'){
	Debugger::notice('Se ha seleccionado addTrainers');
	if(isset($_GET['error'])&&""!==$_GET['error'])
		{
			$error= $_GET['error'];	
			echo "Fila Repetida";
		}
	else require('trainers/addTrainers.php');
	//require('trainers/addTrainers.php')
	}
	else{
		Debugger::notice('Acci&oacute;n "' . $action . '" no reconocida.');
		
	}
	
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>