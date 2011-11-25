<?php
// Definir las variables
$action = 'index';
if(isset($_GET['action']))
{
	$action = $_GET['action'];
}



// Intentar mostrar lo que se pide (porque la DB podr�a fallar)
try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado
	require('_connect.php');

	
	// *****************************************
	// *** Aqu� van los ifs para cada action ***
	// *****************************************
	if($action == 'index')
	{
		require('socios/index.php');
		
	}
	
	
	//***	Aqu� est� lista de socios	***
	elseif($action == 'listsocios'){
		if(isset($_GET['rut_socio'])&&""!==$_GET['rut_socio'])
		{
			$filtros[]= array('rut_socio',$_GET['rut_socio']);
			
		}
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
		if(isset($_GET['comuna'])&&""!==$_GET['comuna'])
		{
			$filtros[]= array('comuna',$_GET['comuna']);
			
		}
		if(isset($_GET['sexo'])&&""!==$_GET['sexo'])
		{
			$filtros[]= array('sexo',$_GET['sexo']);
			
		}
		if(isset($_GET['direccion'])&&""!==$_GET['direccion'])
		{
			$filtros[]= array('direccion',$_GET['direccion']);
			
		}
		if(isset($_GET['fecha_registro'])&&""!==$_GET['fecha_registro'])
		{
			$filtros[]= array('fecha_registro',$_GET['fecha_registro']);
			
		}
		if(isset($_GET['fecha_nacimiento'])&&""!==$_GET['fecha_nacimiento'])
		{
			$filtros[]= array('fecha_nacimiento',$_GET['fecha_nacimiento']);
			
		}
		if(isset($_GET['telefono1'])&&""!==$_GET['telefono1'])
		{
			$filtros[]= array('telefono1',$_GET['telefono1']);
			
		}
		if(isset($_GET['telefono2'])&&""!==$_GET['telefono2'])
		{
			$filtros[]= array('telefono2',$_GET['telefono2']);
			
		}
		
		$q='SELECT * FROM socio NATURAL JOIN matriculas WHERE fecha_inicio <now()::date AND fecha_termino >now()::date';
		$strFiltros ='';
		if(isset($filtros)){ 
		

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
		
		
		require('socios/listsocio.php');
			
	}
	//***	Aqu� est� addsocio	***
	elseif($action == 'addsocio'){
	Debugger::notice('Se ha seleccionado addsocio');
	require('socios/addsocio.php');
	
	}
	//***	Aqu� est� eliminar socios	***
	elseif($action == 'removesocio')
	{
	if(isset($_GET['rut_socio'])&&""!==$_GET['rut_socio'])
		{
			$filtros[]= array('rut_socio',$_GET['rut_socio']);
			
		}
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
		if(isset($_GET['comuna'])&&""!==$_GET['comuna'])
		{
			$filtros[]= array('comuna',$_GET['comuna']);
			
		}
		if(isset($_GET['sexo'])&&""!==$_GET['sexo'])
		{
			$filtros[]= array('sexo',$_GET['sexo']);
			
		}
		if(isset($_GET['direccion'])&&""!==$_GET['direccion'])
		{
			$filtros[]= array('direccion',$_GET['direccion']);
			
		}
		if(isset($_GET['fecha_registro'])&&""!==$_GET['fecha_registro'])
		{
			$filtros[]= array('fecha_registro',$_GET['fecha_registro']);
			
		}
		if(isset($_GET['fecha_nacimiento'])&&""!==$_GET['fecha_nacimiento'])
		{
			$filtros[]= array('fecha_nacimiento',$_GET['fecha_nacimiento']);
			
		}
		if(isset($_GET['telefono1'])&&""!==$_GET['telefono1'])
		{
			$filtros[]= array('telefono1',$_GET['telefono1']);
			
		}
		if(isset($_GET['telefono2'])&&""!==$_GET['telefono2'])
		{
			$filtros[]= array('telefono2',$_GET['telefono2']);
			
		}
		
		$q='SELECT * FROM socio';
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
		
		
	
	
	Debugger::notice('Se ha seleccionado removesocio');
	require('socios/removesocio.php');
	}
	
	//***	Aqu� est� quitar socios	***
	elseif($action == 'quitarsocio')
	{
	Debugger::notice('Se ha seleccionado quitarsocio');
	require('socios/quitarsocio.php');
	}
	//***	Aqu� est� agregarsocio	***
	elseif($action == 'agregarsocio')
	{
	Debugger::notice('Se ha seleccionado agregarsocio');
	require('socios/agregarsocio.php');
	}
	//***	Aqu� est� addprograma	***
	elseif($action == 'addprograma')
	{
	Debugger::notice('Se ha seleccionado addprograma');
	require('socios/addprograma.php');
	}
	//***	Aqu� est� el que recibe el post,agregar programa	***
	elseif($action == 'agregarprograma')
	{
	Debugger::notice('Se ha seleccionado agregarprograma');
	require('socios/agregarprograma.php');
	}
	//***	Aqu� est� la info de socios	***
	elseif($action == 'infosocio')
	{
	Debugger::notice('Se ha seleccionado infosocio');
	require('socios/infosocio.php');
	}
	
	
	//***	Aqu� est� la p�gina para cobrar a socios	***
	elseif($action == 'addcobro')
	{
		if(isset($_GET['socioId']) && (strlen($_GET['socioId']) > 0))
		{	
			$socioId = $_GET['socioId'];
		}
		
		if(isset($socioId))
		{
			
				$qS =	'SELECT *
					FROM Socio
					WHERE rut_socio = \'' . $socioId . '\'';
				
				require('socios/addcobro.php');
		}
		else
		{
			Debugger::notice('No se defini&oacute; una id de socio.');
			
			// Mostrar formulario para seleccionar un socio. Autom�ticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectSocio.php');
		}		
	}
	
	elseif($action == 'agregarcobro')
	{
	Debugger::notice('Se ha seleccionado agregarcobro');
	require('socios/agregarcobro.php');
	}
	
	
	elseif($action === 'addEvaluacion')
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
		
		if(isset($_GET['socioId']) && (strlen($_GET['socioId']) > 0))
		{	
			$trainerId = $_GET['socioId'];
		}
		
		if(isset($trainerId))
		{
			if(isset($socioId))
			{
				$socio = new Socio($socioId);
				$trainer = new Entrenador($trainerId);
				
				$qH = 'SELECT *
					FROM horario
					WHERE rut_entrenador = \'' . $trainerId . '\'
					AND rut_socio ISNULL
					AND fecha_inicio > CURRENT_TIMESTAMP
					ORDER BY fecha_inicio ASC';
				
				require('socio/addEvaluacion.php');
			}
			else
			{
				Debugger::notice('No se defini&oacute; una id de socio.');
			
				// Mostrar formulario para seleccionar un trainer. Autom�ticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectSocio.php');
			}
		}
		else
		{
			Debugger::notice('No se defini&oacute; una id de trainer.');
			
			// Mostrar formulario para seleccionar un socio. Autom�ticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectTrainer.php');
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