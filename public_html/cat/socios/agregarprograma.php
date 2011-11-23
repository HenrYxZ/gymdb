<?php
require('../../class/Debugger.php');
try
{
    require('../_connect.php');
    
    $rut=$_POST['rut'];
    $nombre_ejercicio=$_POST['nombre_ejercicio'];
    $series=$_POST['series'];
    $repeticiones=$_POST['repeticiones'];
    $carga=$_POST['carga'];
    
    if($nombre_ejercicio == 'Bicicleta' || $nombre_ejercicio == 'Eliptica' || $nombre_ejercicio == 'Trotadora')
        $unidad="Minutos";
    elseif($nombre_ejercicio == 'Abdominales')
        $unidad="Ninguna";
    else
        $unidad="Kilos";
    
	$tabla="socio";
	$qrut="SELECT * from $tabla where rut_$tabla = '$rut'";
	Debugger::notice($qrut);
	
if($dbh->query($qrut))	
	$repetido=true;
else
	$repetido=false;
	
	if($repetido)
	{
    $sql= "INSERT INTO ejercicio_programa VALUES ('$rut','$nombre_ejercicio' ,
    '$series' , '$repeticiones' , '$carga' , '$unidad' )";
    Debugger::notice($sql);
    $dbh->exec($sql);
	echo "Se ha ingresado el ejercicio: $nombre_ejercicio para el socio de rut $rut";
    }
	else
	echo "No se ha ingresado el programa porque no se encontro socio con tal rut";
	
    $dbh=null;
    
    
    ?> 

    <p><a href="../../index.php?cat=socios&action=addsocio"> Volver a agregar otro programa de ejercicio</a></p>
    <p><a href="../../index.php"> Volver a la p&aacute;gina principal</a></p>

    <?php
    
}

catch(PDOException $e){
	print($e->getMessage());
	
}
?>
