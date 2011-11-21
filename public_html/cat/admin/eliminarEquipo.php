<script language="javascript" type="text/javascript">
     <!--
     window.setTimeout('window.location="index.php?cat=admin&action=verEquipamiento"; ',2500);
     // -->
</script>

<?php
$id = '-1';
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado

	require('cat/_connect.php');
	$deletestr="DELETE FROM equipamiento WHERE id='$id'";
	$count = $dbh->exec($deletestr);
	if($count>0){
	?>
	<h2>El equipo id=<?php echo $id?> fue eliminado satisfactoriamente<h2>
	<?php
	}
	else{
	?>
	<h2>El equipo id=<?php echo $id?>  no identificado, no se ha efectuado ninguna eliminacion.<h2>
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