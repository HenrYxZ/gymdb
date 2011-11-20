<?php
// Cargar debugger
require('class/Debugger.php');

// Obtener categoría.
// Por defecto es default
$cat = 'default';
if(isset($_GET["cat"]) && strlen($_GET["cat"]) > 0)
	$cat = $_GET["cat"];

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Gym</title>
		<link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
		<link href="css/menu.css" type="text/css" rel="stylesheet" media="screen" />
		<link href="css/debug.css" type="text/css" rel="stylesheet" media="screen" />
		<link href="css/jquery-ui-1.8.16.custom.css" type="text/css" rel="stylesheet" media="screen" />
		<link href="css/jquery-ui-timepicker-addon.css" type="text/css" rel="stylesheet" media="screen" />
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/menu.js"></script>
		
		<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="js/jquery-ui-timepicker-es.js"></script>
		
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0" />
	</head>
	<body>
		<div id="container">
			<header class="ma-class-es-css">
				<h1 id="logo"><a href="index.php">Gym19</a></h1>
			</header>
			<div id="main_menu">
				<ul class="topnav">  
					<li><a href="index.php">Inicio</a></li>
					<li><a href="#">Reg&iacute;strese en el gimnasio</a></li>
					<li>
						<a href="#">Socio</a>  
						<ul class="subnav">
							<li><a href="index.php?cat=horario&action=setHorario">Agendar hora con un trainer</a></li>
							<li><a href="#">Renovar matr&iacute;cula</a></li>
							<li><a href="#">Pagar mensualidad</a></li>
						</ul>
					</li>
					<li>  
						<a href="#">Recepcionista</a>  
						<ul class="subnav">  
							<li><a href="index.php?cat=trainers&action=showTrainers">Ver todos los trainers</a></li>
							<li><a href="index.php?cat=trainers&action=addTrainers">Registrar nuevo trainer</a></li>
							<li><a href="index.php?cat=trainers&action=showAgenda">Ver agenda para un trainer</a></li>
							
							<li><a href="index.php?cat=socios&action=listsocios">Ver todos los socios</a></li>
							<li><a href="index.php?cat=socios&action=addsocio">Registrar nuevo socio</a></li>
							<li><a href="#">Renovar matr&iacute;cula de un socio</a></li>
							<li><a href="#">Pagar mensualidad de un socio</a></li>
							
						</ul>  
					</li>
					<li>  
						<a href="#">Administrador</a>  
						<ul class="subnav">  
							<li><a href="index.php?cat=trainers&action=showTrainers">Ver todos los trainers</a></li>
							<li><a href="index.php?cat=trainers&action=addTrainers">Registrar nuevo trainer</a></li>
							<li><a href="index.php?cat=trainers&action=showAgenda">Ver agenda para un trainer</a></li>
							
							<li><a href="index.php?cat=admin&action=verEquipamiento">Ver equipamiento actual y estad&iacute;sticas de uso</a></li>
							
							<li><a href="#">Agregar equipamiento</a></li>
							<li><a href="#">Eliminar equipamiento</a></li>
							
							<li><a href="index.php?cat=socios&action=listsocios">Ver todos los socios</a></li>
							<li><a href="index.php?cat=socios&action=addsocio">Registrar nuevo socio</a></li>
							<li><a href="index.php?cat=admin&action=asistencia">Estad&iacute;sticas de socios</a></li>
							<li><a href="#">Renovar matr&iacute;cula de un socio</a></li>
							<li><a href="#">Pagar mensualidad de un socio</a></li>
							<li><a href="index.php?cat=admin&action=vermorosos">Ver informaci&oacute;n de pagos</a></li>
							
						</ul>  
					</li>
					<li>  
						<a href="#">Trainer</a>  
						<ul class="subnav">
							<li><a href="index.php?cat=trainers&action=showAgenda">Ver agenda</a></li>
							<li><a href="index.php?cat=horario&action=newHorario">Agregar horario disponible</a></li>
							<li><a href="index.php?cat=horario&action=newHorario">Actualizar programa de un socio</a></li>
						</ul>  
					</li>  
				</ul>
			</div>
			<div id="content">
			<?php
				require('cat/' . $cat . '.php');
			?>
			</div>
			<footer>
				&copy; 2011 Grupo 19 Bases de Datos
			</footer>
		</div>
	</body>
</html>