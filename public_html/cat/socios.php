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
	
	elseif($action == 'listsocios'){
		
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
		
		
		require('socios/listsocio.php');
			
	}
	
	elseif($action == 'addsocio'){
	Debugger::notice('Se ha seleccionado addsocio');
	require('socios/addsocio.php');
	//require('trainers/addTrainers.php')
	}
	elseif($action == 'infosocio')
	{
	Debugger::notice('Se ha seleccionado infosocio');
	require('socios/infosocio.php');
	}
	else{
		Debugger::notice('Acci&oacute;n "' . $action . '" no reconocida.');
		
	}
	
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>