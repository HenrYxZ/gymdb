<?php

require('../../class/Debugger.php');
try{
require('../_connect.php');

$fechanacimiento = $_POST['anio'] . "-" . $_POST['mes'] . "-" . $_POST['dia'];
Debugger::notice($fechanacimiento);
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


$sql=
"INSERT INTO socio VALUES ('$rut', '$email', '$nombre', '$apellido_paterno', '$apellido_materno', '$sexo',
'$comuna', '$direccion', localtimestamp(0), '$fechanacimiento', '$telefono1', '$telefono2')";
Debugger::notice($sql);
$dbh->exec($sql);
$dbh=null;
echo "Se ha ingresado un nuevo socio de nombre $nombre";
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>	

<p><a href="../../index.php?cat=socios&action=addsocio"> Volver a agregar otro socio</a></p>
<p><a href="../../index.php"> Volver a la página principal</a></p>
