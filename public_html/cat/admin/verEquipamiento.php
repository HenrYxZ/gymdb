<script>
function validar()
{
if (document.getElementById("fecha_compra").value.length==0){ 
      	 alert("Tiene ingresar fecha de compra") 
      	 document.getElementById("fecha_compra").focus() 
      	 return 0; 
   	} 	
if (document.getElementById("tipo_equipo").value.length==0){ 
      	 alert("Tiene ingresar tipo de equipo") 
      	 document.getElementById("tipo_equipo").focus() 
      	 return 0; 
   	} 	
	
document.getElementById("formequip").submit(); 	
}
</script>

<?php
$q1="select id, tipo, suma as tiempo_total_de_uso from
(select id, coalesce(sum(tiempo_de_uso),'0 days') as suma from socio_usa_equipo right outer join equipamiento on equipamiento.id=socio_usa_equipo.id_equipamiento group by equipamiento.id) as t natural join equipamiento";
try{
require_once('cat/_connect.php');
echo "<h2>Equipamiento Actual</h2><table><tr><th>ID</th><th>Tipo</th><th>Tiempo de Uso</th></tr>";
foreach($dbh->query($q1) as $row){
	
	
	?>
	<tr>
		<td><a href='index.php?cat=admin&action=detalleEquipo&id=<?php echo $row['id']?>'><?php echo $row['id']?></a></td>
		<td><?php echo $row['tipo']?></td>
		<td><?php echo $row['tiempo_total_de_uso']?></td>
	</tr>
	<?php
	}
	?>
	</table>
	<h2>Agregar Equipamiento</h2>
	<form id="formequip" action="index.php" method="get">
			<label for="cantidad">
				Cantidad
			</label>
			<input type="number" name="cantidad" id="cantidad" value ="1" />
			<label for="period">
				Period. Mantenimiento (dias)
			</label>
			<input type="number" name="period" id="period" value ="1" />
			<label for="fecha_compra">
				Fecha de compra
			</label>
			<input type="text" name="fecha_compra" id="fecha_compra" value ="" />
			

			<label for="tipo_equipo">
				Tipo de Equipamiento
			</label>
			<select name="tipo_equipo" id="tipo_equipo">
				<option selected="selected" value="">-- Tipo --</option>
				<option value="trotadora">Trotadora</option>
				<option value="bicicleta">Bicicleta</option>
				<option value="eliptica">Eliptica</option>
				<option value="mancuerna">Mancuerna</option>
				<option value="maquina">Maquina</option>
			</select>

			<!-- Info de categoría y acción -->
			<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
			<input type="hidden" name="action" value="addEquipo" />
			
			<!-- Enviar -->
			<input type="button" value="Agregar" onclick="validar()" />
		</form>
<script type="text/javascript">

	

	$(function() {
	$('#fecha_compra').datetimepicker({	});
});
</script>
	<?php
	
}

catch(PDOException $e){
	Debugger::notice($e->getMessage());
}

?>