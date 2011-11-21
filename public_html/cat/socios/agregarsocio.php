<?php

require('../../class/Debugger.php');
try{
require('../_connect.php');

$fechanacimiento =$_POST['fecha_nacimiento'];
$rut=$_POST['rut'];
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$apellido_paterno=$_POST['apellido_paterno'];
$apellido_materno=$_POST['apellido_materno'];
$sexo=$_POST['sexo'];
$comuna=$_POST['comuna'];
$direccion=$_POST['direccion'];
$telefono1=$_POST['telefono1'];
$telefono2=$_POST['telefono2'];


$tabla="socio";
$qrut="SELECT * from $tabla where rut_$tabla = $rut";
$contador=$dbh->query($qrut);

if($dbh->query($qrut))
	$repetido=false;
else
	$repetido=true;

$sql=
"INSERT INTO socio VALUES ('$rut', '$email', '$nombre', '$apellido_paterno', '$apellido_materno', '$sexo',
'$comuna', '$direccion', localtimestamp(0), '$fechanacimiento', '$telefono1', '$telefono2')";
Debugger::notice($sql);
$dbh->exec($sql);
$dbh=null;

if($repetido)
echo "No se ha ingresado el nuevo socio, porque ese rut ya existe";
else
echo "Se ha ingresado un nuevo socio de nombre $nombre";
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>	

<p><a href="../../index.php?cat=socios&action=addsocio"> Volver a agregar otro socio</a></p>
<p><a href="../../index.php"> Volver a la p�gina principal</a></p>