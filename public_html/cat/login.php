<?php
// Definir las variables
$action = 'index';
if(isset($_GET['action']))
{
	$action = $_GET['action'];
}

$folder = 'login';

// Intentar mostrar lo que se pide (porque la DB podría fallar)
try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado
	require('_connect.php');

	
	// *****************************************
	// *** Aquí van los ifs para cada action ***
	// *****************************************
	if($action == 'logout')
	{
		// Borrar todos los datos de sesión
		session_destroy();
		Debugger::notice('session_destroy()');
		require($folder.'/logout.php');
	}
	elseif( isset( $_SESSION['user'] ) )
	{
		// Si ya está logueado, mostrar una página para redirigir
		require($folder.'/redirect.php');
	}
	else
	{
		// Si no está logueado
		if($action == 'index')
		{
			require($folder.'/index.php');
		}
		elseif($action == 'socio')
		{
			if(isset($_GET['socioId']) && (strlen($_GET['socioId']) > 0))
			{	
				$socioId = $_GET['socioId'];
			}
			
			if(isset($socioId))
			{
				// Guardar el objeto socio con todos sus datos en una variable de sesión
				$_SESSION['user'] = new Socio($socioId);
				require($folder.'/redirect.php');
			}
			else{
				Debugger::notice('No se defini&oacute; una id de socio.');
				
				// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectSocio.php');
			}
		}
		elseif($action == 'recepcionista')
		{
			if(isset($_GET['recepcionistaId']) && (strlen($_GET['recepcionistaId']) > 0))
			{	
				$recepcionistaId = $_GET['recepcionistaId'];
			}
			
			if(isset($recepcionistaId))
			{
				// Guardar el objeto recepcionista con todos sus datos en una variable de sesión
				$_SESSION['user'] = new Recepcionista($recepcionistaId);
				require($folder.'/redirect.php');
			}
			else{
				Debugger::notice('No se defini&oacute; una id de recepcionista.');
				
				// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectRecepcionista.php');
			}
		}
		elseif($action == 'administrador')
		{
			if(isset($_GET['administradorId']) && (strlen($_GET['administradorId']) > 0))
			{	
				$administradorId = $_GET['administradorId'];
			}
			
			if(isset($administradorId))
			{
				// Guardar el objeto administrador con todos sus datos en una variable de sesión
				$_SESSION['user'] = new Administrador($administradorId);
				require($folder.'/redirect.php');
			}
			else{
				Debugger::notice('No se defini&oacute; una id de administrador.');
				
				// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectAdministrador.php');
			}
		}
		elseif($action == 'trainer')
		{
			if(isset($_GET['trainerId']) && (strlen($_GET['trainerId']) > 0))
			{	
				$trainerId = $_GET['trainerId'];
			}
			
			if(isset($trainerId))
			{
				// Guardar el objeto trainer con todos sus datos en una variable de sesión
				$_SESSION['user'] = new Entrenador($trainerId);
				require($folder.'/redirect.php');
			}
			else{
				Debugger::notice('No se defini&oacute; una id de trainer.');
				
				// Mostrar formulario para seleccionar un socio. Automáticamente vuelve a
				// estas mismas cat y action, por encontrarse dentro de un require().
				require('_selectTrainer.php');
			}
		}
		else
		{
			Debugger::notice('Acci&oacute;n "' . $action . '" no reconocida.');
			
		}
	}
	
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>