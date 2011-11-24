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
	if($action == 'index')
	{
		require($folder.'/index.php');
		
	}
	else{
		Debugger::notice('Acci&oacute;n "' . $action . '" no reconocida.');
		
	}
	
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>