<?php
$q1="SELECT nombre_mes, ingresos_mes FROM(SELECT mes, COUNT(ingresa) AS ingresos_mes FROM (SELECT DISTINCT rut_socio, date_trunc('DAY', fecha) AS ingresa,extract(month FROM fecha) AS mes FROM socio NATURAL JOIN socio_usa_equipo WHERE fecha> now()::date-INTERVAL '1 year') AS T1 GROUP BY mes ORDER BY mes ASC) AS T2 INNER JOIN meses_del_ano ON numero_mes=mes";
$q2="SELECT COUNT(rut_socio) FROM matriculas WHERE fecha_inicio<now()::date AND fecha_termino>now()::date";
try{
require_once('cat/_connect.php');
	$stmt2=$dbh->query($q2);
	$totalSocios=$stmt2->fetch(PDO::FETCH_ASSOC);
	$totalSocios=$totalSocios['count'];
	echo '<h2>Asistencia Mensual Socios</h2>';
	echo '<table><th>Mes</th><th>Ingresos</th>';
	$total=0;
	foreach($dbh->query($q1) as $row){
	
	
	?>
	<tr>
		<td><?php echo $row['nombre_mes']?></td>
		<td><?php echo $row['ingresos_mes']?></td>
	</tr>
	<?php $total+=$row['ingresos_mes'];
	}
	echo "<tr><th>Total</th><td>".$total."</td></tr>";
	echo "</table><br>";
	echo "<p>Numero actual de socios matriculados:".$totalSocios."<p>";
	
	}
	
	catch(PDOException $e){
	Debugger::notice($e->getMessage());
}
?>