<?php
$id = '0';
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado
	
	require('cat/_connect.php');
	$querystr="SELECT * FROM equipamiento WHERE id='$id'";
	$stmt=$dbh->query($querystr);
	$info=$stmt->fetch(PDO::FETCH_ASSOC);
	?>
	<table>
	<tr><th>ID</th><td><?php echo $info['id'];?></td></tr>
	<tr><th>Tipo</th><td><?php echo $info['tipo']; ?></td></tr>
	<tr><th>Periodicidad Mantenimiento</th><td><?php echo $info['periodicidad_mantemiento']; ?></td></tr>
	<tr><th>Fecha Compra</th><td><?php echo $info['fecha_compra']; ?></td></tr>
	
	
	<?php
	}
	echo '</table>';
	}
	catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

	
	
	
	
	
	
}

else{
		Debugger::notice('id Equipamiento "' .$id. '" no reconocido.');
		
	}
?>