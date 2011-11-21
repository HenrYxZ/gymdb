<script language="javascript" type="text/javascript">
     <!--
     window.setTimeout('window.location="index.php?cat=admin&action=verEquipamiento"; ',2100);
     // -->
</script>

<?php

if(isset($_GET['cantidad'])&&isset($_GET['fecha_compra'])&&isset($_GET['tipo_equipo']))
{
	$cantidad = $_GET['cantidad'];
	$fecha = $_GET['fecha_compra'];
	$tipo = $_GET['tipo_equipo'];
	$period = $_GET['period'];
	try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado

	require('cat/_connect.php');
	$insertstr="INSERT INTO equipamiento VALUES (nextval('equipamiento_id_seq'), '$tipo', '$period days', '$fecha')";
	for ($i = 1; $i <= $cantidad; $i++) {
    $count = $dbh->exec($insertstr);
}
	if($count>0){
	?>
	<h2>Se han agregado <?php echo $cantidad?> nuevos equipos<h2>
	<?php
	}
	else{
	?>
	<h2>Error, no se han agregado nuevos equipos.<h2>
	<br>
	
	
	
	
	
	<?php
	}
	}
	
	 
	
	
	catch(PDOException $e){
	Debugger::notice($e->getMessage());
}
}

else{
		Debugger::notice('id Equipamiento "' .$id. '" no reconocido.');
		
	}
?>