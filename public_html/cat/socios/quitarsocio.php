<?php
	// Tenemos un arreglo donde juntamos todos los ruts de los socios que queremos eliminar
	// Para cada uno hacemos la sentencia de borrado
	if(! empty($_POST['eliminados']) )
    {
		$eliminados=$_POST['eliminados'];
		
		foreach ($eliminados as $row)
		{
		
			$sql= "DELETE from socio where rut_socio='$row'";
			
			Debugger::notice($sql);
			$dbh->exec($sql);
			echo "Se ha eliminado el socio de rut $row exitosamente";
		}
		$dbh=null;
	}
 ?>   

<p><a href="index.php?cat=socios&action=removesocio"> Volver a eliminar m&aacute;s socios</a></p>
    <p><a href="index.php"> Volver a la p&aacute;gina principal</a></p>


   
