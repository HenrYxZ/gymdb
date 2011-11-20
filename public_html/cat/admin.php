<?php
// Definir las variables
$action = 'index';
if(isset($_GET['action']))
{
	$action = $_GET['action'];
}

if($action=='vermorosos')
{
require_once('admin/morosos.php');
}
elseif($action=='asistencia')
{
require_once('admin/asistencia.php');
}
elseif($action=='verEquipamiento')
{
require_once('admin/verEquipamiento.php');
}
elseif($action=='detalleEquipo')
{
require_once('admin/detalleEquipo.php');
}
elseif($action=='detalleEquipo')
{
require_once('admin/insertEquipo.php');
}
elseif($action=='eliminarEquipo')
{
require_once('admin/eliminarEquipo.php');
}
?>