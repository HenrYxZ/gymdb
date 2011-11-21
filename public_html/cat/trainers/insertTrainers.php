<?php
require('../../class/Debugger.php');
try{
require('../_connect.php');

$nombre=null;
if(isset($_POST['nombre']))
	$nombre = $_POST['nombre'];
Debugger::notice($nombre);
$email=null;
if(isset($_POST['email']))
	$email = $_POST['email'];
Debugger::notice($email);		
$ap_paterno = null;
if(isset($_POST['ap_paterno']))
	$ap_paterno = $_POST['ap_paterno'];
Debugger::notice($ap_paterno);		
$ap_materno = null;
if(isset($_POST['ap_materno']))
	$ap_materno = $_POST['ap_materno'];
Debugger::notice($ap_materno);	
$rut = null;	
if(isset($_POST['rut_entrenador']))
	$rut = $_POST['rut_entrenador'];
Debugger::notice($rut);	
$sexo = null;	
if(isset($_POST['sexo']))
	$sexo = $_POST['sexo'];
Debugger::notice($sexo);		
$tipo = null;	
if(isset($_POST['tipo_entrenador']))
	$tipo = $_POST['tipo_entrenador'];
Debugger::notice($rut);	


$querystr="SELECT 1 FROM entrenador WHERE rut_entrenador='$rut'";
	
$stmt=$dbh->query($querystr);
$contador=$stmt->RowCount();
if($contador>0){

?>
<script language="javascript" type="text/javascript">
     <!--
     window.setTimeout('window.location="../../index.php?cat=trainers&action=addTrainers"; ',2100);
     // -->
</script>
<h2>ERROR: Ya existe un trainer con ese RUT<h2>
<?php
}
else{
$q = "INSERT INTO entrenador VALUES ('$rut', '$email','$nombre','$ap_paterno', '$ap_materno', '$sexo', '$tipo')";
Debugger::notice($q);
$count = $dbh->exec($q);
Debugger::notice($count);
echo($count);
$dbh=null;
header('Location: ../../index.php?cat=trainers&action=showTrainers');
}
}
catch(PDOException $e){
	print($e->getMessage());
	
}







?>