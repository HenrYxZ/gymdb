<?php
$rutsocio = '0';
if(isset($_GET['rutsocio']))
{
	$rutsocio = $_GET['rutsocio'];
	try{
	// Intentar crear una variable dbh que contiene el objeto PDO inicializado
	
	require('cat/_connect.php');
	$querystr="SELECT * FROM socio WHERE rut_socio='$rutsocio'";
	$stmt=$dbh->query($querystr);
	$info=$stmt->fetch(PDO::FETCH_ASSOC);
	?>
	<table>
	<tr><th colspan="2"><?php echo $info['nombre'].' '.$info['apellido_paterno'].' '.$info['apellido_materno']; ?></th></tr>
	<tr><td>E-mail:</td><td><?php echo $info['email']; ?></td></tr>
	<tr><td>Rut:</td><td><?php echo $info['rut_socio']; ?></td></tr>
	<tr><td>Sexo:</td><td><?php echo $info['sexo']; ?></td></tr>
	<tr><td>Direccion:</td><td><?php echo $info['direccion'].', '.$info['comuna']; ?></td></tr>
	<tr><td>Fecha Nacimiento:</td><td><?php echo $info['fecha_nacimiento']; ?></td></tr>
	<tr><td>Telefono:</td><td><?php echo $info['telefono1'].', '.$info['telefono2']; ?></td></tr>
	
	<?php
	$q="SELECT fecha_termino FROM mensualidad WHERE fecha_pago IS NULL AND fecha_termino<now()::date AND rut_socio='$rutsocio'";
	$stmtt=$dbh->query($q);
	$cuotasVencidas=-1;
	$cuotasVencidas=$stmtt->RowCount();
	if($cuotasVencidas>0){
	?>
	<tr><td>Estado Financiero: </td><td>Moroso</td></tr>
	<?php
	$i=0;
	foreach($stmtt as $cuota)
	{
	$i++;?>
	<tr><td><?php echo 'Cuota vencida #'.$i;?></td><td><?php echo $cuota['fecha_termino']; ?></td></tr>
	<?php
	}
	
	
	
	
	}
	else
	{
	?>
	<tr><td>Estado Financiero: </td><td>Cuotas al Dia</td></tr>
	<?php
	}
	echo '</table>';
	}
	catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

	
	
	
	
	
	
}

else{
		Debugger::notice('Rut socio "' .$rutsocio. '" no reconocido.');
		
	}
?>