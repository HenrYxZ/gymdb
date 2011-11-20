<?php
//--Listado de Morosos, numero cuotas vencidas y total deuda por socio
$q1="SELECT apellido_paterno||' '||apellido_materno||', '||nombre AS ncompleto, rut_socio AS rut, cuotas_vencidas, deuda FROM(SELECT rut_socio, COUNT(rut_socio) AS cuotas_vencidas, SUM(monto) as deuda FROM socio NATURAL JOIN mensualidad WHERE fecha_pago IS NULL AND fecha_termino<now()::date GROUP BY rut_socio ) AS t NATURAL JOIN socio ORDER BY ncompleto";
//--Total Morosos
$q2="SELECT COUNT(t.rut_socio) FROM(
SELECT DISTINCT rut_socio FROM socio NATURAL JOIN mensualidad WHERE fecha_pago IS NULL AND fecha_termino<now()::date GROUP BY rut_socio) as t";
//--Monto Total por Cobrar
$q3="SELECT SUM(monto) Total_Adeudado FROM socio NATURAL JOIN mensualidad WHERE fecha_pago IS NULL AND fecha_termino<now()::date";
$q4="SELECT nombre_mes,COALESCE(ingresos,0) AS ingresos FROM (SELECT extract(month from fecha_pago) AS mes, SUM(monto) AS ingresos FROM socio NATURAL JOIN mensualidad WHERE fecha_pago > now()::date-INTERVAL '1 year' GROUP BY extract(MONTH FROM fecha_pago) ORDER BY mes) AS resultado RIGHT OUTER JOIN meses_del_ano AS m ON m.numero_mes=resultado.mes";

$q5="SELECT nombre_mes,COALESCE(ingresos,0) AS ingresos FROM (SELECT extract(month from fecha_inicio) AS mes, SUM(monto) AS ingresos FROM socio NATURAL JOIN matriculas WHERE fecha_inicio > now()::date-INTERVAL '1 year' GROUP BY extract(MONTH FROM fecha_inicio) ORDER BY mes) AS resultado RIGHT OUTER JOIN meses_del_ano AS m ON m.numero_mes=resultado.mes";

$q6="SELECT SUM(monto) suma FROM mensualidad";

$q7="SELECT SUM(monto) suma FROM matriculas";
try{
require_once('cat/_connect.php');
	echo '<h2>Clientes Impagos</h2>';
	echo '<table><th>Socio</th><th>Cuotas Vencidas</th><th>Deuda</th>';
	foreach($dbh->query($q1) as $moroso){
	?>
	
	<tr>
		<td><a href='index.php?cat=socios&action=infosocio&rutsocio=<?php echo $moroso['rut']?>'><?php echo $moroso['ncompleto']?></a></td>
		<td><?php echo $moroso['cuotas_vencidas']?></td>
		<td><?php echo '$ '.$moroso['deuda']?></td>

	</tr>

<?php
	}
	$stmt2=$dbh->query($q2);
	$totMorosos=$stmt2->fetch(PDO::FETCH_ASSOC);
	echo '<tr><th>Num. clientes impagos</th><td colspan="2">'.$totMorosos['count'].'</td></tr>';

	$stmt3=$dbh->query($q3);
	$totDeuda=$stmt3->fetch(PDO::FETCH_ASSOC);
	echo '<tr><th>Deuda Total</th><td colspan="2">$ '.$totDeuda['total_adeudado'].'</td></tr>';
echo '</table>';

echo '<h2>Ingresos por mes</h2>';
echo '<table><th>Mes</th><th>Matricula</th><th>Mensualidad</th><th>Subtotal</th>';
	$stmt4=$dbh->query($q4);
	$mensualidad=$stmt4->fetchAll(PDO::FETCH_ASSOC);
	$j=0;
	foreach($dbh->query($q5) as $mes){
	?>
	
	<tr>
		<td><?php echo $mes['nombre_mes']?></td>
		<td><?php echo '$ '.$mes['ingresos']?></td>
		<td><?php echo '$ '.$mensualidad[$j]['ingresos']?></td>
		<td><?php echo '$ '.($mensualidad[$j]['ingresos']+$mes['ingresos'])?></td>

	</tr>

<?php
	$j++;}
	echo '<br><br>';
	$stmt6=$dbh->query($q6);
	$totMens=$stmt6->fetch(PDO::FETCH_ASSOC);
	$stmt7=$dbh->query($q7);
	$totMatr=$stmt7->fetch(PDO::FETCH_ASSOC);
	?>
	<tr><th>Total</th><td><?php echo '$ '.$totMatr['suma']?></td><td><?php echo '$ '.$totMens['suma']?></td><td><?php echo '$ '.($totMatr['suma']+$totMens['suma'])?></td></tr>
	</table>;
<?php
}
	catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>