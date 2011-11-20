<?php
$q1="SELECT id, tipo, suma AS tiempo_total_de_uso FROM equipamiento NATURAL JOIN (SELECT SUM(tiempo_de_uso) AS suma,id FROM equipamiento NATURAL JOIN socio_usa_equipo GROUP BY id) AS T ORDER BY id";
try{
require_once('cat/_connect.php');
echo "<table><tr><th>ID</th><th>Tipo</th><th>Tiempo de Uso</th></tr>";
foreach($dbh->query($q1) as $row){
	
	
	?>
	<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['tipo']?></td>
		<td><?php echo $row['tiempo_total_de_uso']?></td>
	</tr>
	<?php
	}
echo '</table>';
}

catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>