<?php
if( isset ($_POST['rut_socio']) )
$rut=$_POST['rut_socio'];
if( isset ($_POST['cobro']))
$cobro=$_POST['cobro'];

/*Faltaría ver si es necesario hacer una excepcion cuando fecha de pago no es null*/
//$fecha_inicio="SELECT FIRST(fecha_inicio) WHERE rut_socio='$rut' AND now() < fecha_termino"; 
//$monto=
$sql= "UPDATE mensualidad SET monto = monto + $cobro WHERE rut_socio='$rut' AND fecha_inicio <= now() AND
fecha_termino > now()";


Debugger::notice($sql);
$dbh->exec($sql);
echo "Se ha ingresado un cobro de $cobro pesos al socio de rut $rut";
$dbh = null;

?>
<p><a href="../../index.php?cat=socios&action=addcobro"> Volver a agregar otro cobro</a></p>
<p><a href="../../index.php"> Volver a la p&aacute;gina principal</a></p>