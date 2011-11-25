<?php

require('../../class/Debugger.php');
require('../../class/PDOFactory.php');
require('../../class/iUser.php');
require('../../class/Administrador.php');

$_SESSION['showUser'] = new Administrador('18201665-9');
?>

<?php
if( isset($_SESSION['showUser']) )
{
$showUser = $_SESSION['showUser'];
?>
<h2>Detalle para <?php echo $showUser->apellidoPaterno . $showUser->apellidoMaterno .$showUser->nombre; ?></h2>
<?php print_r ( get_class_vars( get_class($showUser) ) ) ; ?>
<table>
	<tr>
		<?php
			foreach(get_class_vars( get_class($showUser) ) as $property)
			{
				echo '<th>'. $property .'</th>';
			}
		?>
	</tr>
	<tr>
		<?php
			foreach(get_class_vars( get_class($showUser) ) as $property)
			{
				echo '<td>'. $showUser->$property .'</td>';
			}
		?>
	</tr>
</table>
<?php	
}
else
{?>
	<h2>No se encontró la variable showUser.</h2>
<?php
}?>