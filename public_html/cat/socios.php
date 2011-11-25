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
		require('socios/index.php');
		
	}
	
	
	//***	Aquí está lista de socios	***
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
	//***	Aquí está addsocio	***
	elseif($action == 'addsocio'){
	Debugger::notice('Se ha seleccionado addsocio');
	require('socios/addsocio.php');
	
	}
	//***	Aquí está eliminar socios	***
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
	
	//***	Aquí está quitar socios	***
	elseif($action == 'quitarsocio')
	{
	Debugger::notice('Se ha seleccionado quitarsocio');
	require('socios/quitarsocio.php');
	}
	//***	Aquí está agregarsocio	***
	elseif($action == 'agregarsocio')
	{
	Debugger::notice('Se ha seleccionado agregarsocio');
	require('socios/agregarsocio.php');
	}
	//***	Aquí está addprograma	***
	elseif($action == 'addprograma')
	{
	Debugger::notice('Se ha seleccionado addprograma');
	require('socios/addprograma.php');
	}
	//***	Aquí está el que recibe el post,agregar programa	***
	elseif($action == 'agregarprograma')
	{
	Debugger::notice('Se ha seleccionado agregarprograma');
	require('socios/agregarprograma.php');
	}
	//***	Aquí está la info de socios	***
	elseif($action == 'infosocio')
	{
	Debugger::notice('Se ha seleccionado infosocio');
	require('socios/infosocio.php');
	}
	
	
	//***	Aquí está la página para cobrar a socios	***
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
			
			// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectSocio.php');
		}		
	}
	
	elseif($action == 'agregarcobro')
	{
	Debugger::notice('Se ha seleccionado agregarcobro');
	require('socios/agregarcobro.php');
	}
	
	elseif($action == 'listevaluaciones')
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
		
		if(isset($socioId))
		{
			$socio = new Socio($socioId);
		
			if ( $action == 'listevaluaciones' )
			{
				$q = 	"SELECT *
						FROM ficha
						WHERE rut_socio = '$socioId'";
						
				require('socios/listevaluaciones.php');
			}
			
			
		}
		else{
			Debugger::notice('No se defini&oacute; una id de socio.');
			
			// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectSocio.php');
			
		}
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
			
				// Mostrar formulario para seleccionar un trainer. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectSocio.php');
			}
		}
		else
		{
			Debugger::notice('No se defini&oacute; una id de trainer.');
			
			// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
			// estas mismas cat y action, por encontrarse dentro de un require().
			require('_selectTrainer.php');
		}	
		
		
		
		
		
	}	
	
	
	elseif($action === 'insertEvaluacion')
	{
		if(
			isset($_GET['fecha_evaluacion']) && (strlen(trim($_GET['fecha_evaluacion'])) > 0 ) &&
			isset($_GET['peso_en_kg']) && (strlen(trim($_GET['peso_en_kg'])) > 0 ) &&
			isset($_GET['estatura_en_cm']) && (strlen(trim($_GET['estatura_en_cm'])) > 0 ) &&
			isset($_GET['porcentaje_grasa']) && (strlen(trim($_GET['porcentaje_grasa'])) > 0 ) &&
			isset($_GET['trainerId']) && (strlen(trim($_GET['trainerId'])) > 0 ) &&
			isset($_GET['socioId']) && (strlen(trim($_GET['socioId'])) > 0 )
			)
		{
			// Intentar crear una variable dbh que contiene el objeto PDO inicializado
			try{
				$dbh = &PDOFactory::getPDOObject();
			}
			catch(PDOException $e)
			{
				Debugger::notice($e->getMessage());
				return false;
			}
			
			// Preparar el statement sql
			$stmt =	$dbh->prepare('
							INSERT INTO ficha(fecha_evaluacion, peso_en_kg, estatura_en_cm, porcentaje_grasa, rut_entrenador, rut_socio)
							VALUES (:fecha_evaluacion, :peso_en_kg, :estatura_en_cm, :porcentaje_grasa, :rut_entrenador, :rut_socio)
							');
			
			$stmt->bindParam(':fecha_evaluacion', $_GET['fecha_evaluacion'], PDO::PARAM_STR);
			$stmt->bindParam(':peso_en_kg', $_GET['peso_en_kg'], PDO::PARAM_INT);
			$stmt->bindParam(':estatura_en_cm', $_GET['estatura_en_cm'], PDO::PARAM_INT);
			$stmt->bindParam(':porcentaje_grasa', $_GET['porcentaje_grasa'], PDO::PARAM_INT);
			$stmt->bindParam(':rut_entrenador', $_GET['rut_entrenador'], PDO::PARAM_STR);
			$stmt->bindParam(':rut_socio', $_GET['rut_socio'], PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				echo '<h2>Se ha agregado una nueva evaluaci&oacute;n/h2>';
			}
			else
			{
				echo '<h2>Error al agregar una nueva evaluaci&oacute;n/h2>';
			}
			
			
			
		}
		else
		{
			Debugger::notice('No se cuenta con los campos requeridos.');
			?>
			
			<h2>No es posible insertar la evaluaci&oacute;n</h2>
			
			<p>No se cuenta con todos los campos requeridos. Puede <a href="index.php?cat=socios&action=addEvaluacion">volver a intentarlo</a>.</p>
			
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