<?php
// Cargar debugger
require('class/Debugger.php');
require('class/PDOFactory.php');

// Cargar token
//require('class/Token.php');

// Cargar resto de clases
require('class/iUser.php');
require('class/Administrador.php');
require('class/Entrenador.php');
require('class/Recepcionista.php');
require('class/Socio.php');

// Permitir guardar info en sesión
// Debe estar después de la declaración de clases para permitir deserializar los objetos (si es que se guardara alguno en sesión)
session_start(); 

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
					<?php
					if( !isset( $_SESSION['user'] ) )
					{
						echo '<li><a href="#">Reg&iacute;strese en el gimnasio</a></li>';
					}?>
					<?php
					if( isset( $_SESSION['user'] ) )
					{
						echo '<li><a href="index.php?cat=login&action=logout">Logout (';
						echo $_SESSION['user']->nombre;
						echo ')</a></li>';
					}
					else
						echo '<li><a href="index.php?cat=login">Login</a></li>';
					?>
					<?php
					if( isset( $_SESSION['user'] ) )
					{
						if( get_class( $_SESSION['user'] ) === 'Socio' )
						{?>
						<li>
							<a href="#">Socio</a>  
							<ul class="subnav">
								<li><a href="index.php?cat=horario&action=setHorario">Agendar hora con un trainer</a></li>
								<li><a href="#">Renovar matr&iacute;cula</a></li>
								<li><a href="#">Pagar mensualidad</a></li>
							</ul>
						</li>
						<?php
						}
						elseif( get_class( $_SESSION['user'] ) === 'Recepcionista' )
						{?>
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
						<?php
						}
						elseif( get_class( $_SESSION['user'] ) === 'Administrador' )
						{?>
						<li>  
							<a href="#">Administrador</a>  
							<ul class="subnav">  
								<li><a href="index.php?cat=trainers&action=showTrainers">Ver todos los trainers</a></li>
								<li><a href="index.php?cat=trainers&action=addTrainers">Registrar nuevo trainer</a></li>
								<li><a href="index.php?cat=trainers&action=showAgenda">Ver agenda para un trainer</a></li>
								<li><a href="index.php?cat=admin&action=verEquipamiento">Administrar equipamiento</a></li>
								<li><a href="index.php?cat=socios&action=listsocios">Ver todos los socios</a></li>
								<li><a href="index.php?cat=socios&action=addsocio">Registrar nuevo socio</a></li>
								<li><a href="index.php?cat=socios&action=removesocio">Eliminar un socio</a></li>
								<li><a href="index.php?cat=admin&action=asistencia">Estad&iacute;sticas de socios</a></li>
								<li><a href="#">Renovar matr&iacute;cula de un socio</a></li>
								<li><a href="#">Pagar mensualidad de un socio</a></li>
								<li><a href="index.php?cat=admin&action=vermorosos">Ver informaci&oacute;n de pagos</a></li>
								
							</ul>  
						</li>
						<?php
						}
						elseif( get_class( $_SESSION['user'] ) === 'Entrenador' )
						{?>
						<li>  
							<a href="#">Trainer</a>  
							<ul class="subnav">
								<li><a href="index.php?cat=trainers&action=showAgenda">Ver agenda</a></li>
								<li><a href="index.php?cat=horario&action=newHorario">Agregar horario disponible</a></li>
								<li><a href="index.php?cat=horario&action=newHorario">Actualizar programa de un socio</a></li>
								<li><a href="index.php?cat=socios&action=addprograma">Agregar programa de ejercicios para un socio</a></li>
							</ul>  
						</li>
						<?php
						}
					}?>
				</ul>
			</div>
			<div id="content">
			<?php
				try
				{
					require('cat/' . $cat . '.php');
				}
				catch(Exception $e)
				{
					Debugger::notice($e->getMessage());
				}
			?>
			</div>
			<footer>
				&copy; 2011 Grupo 19 Bases de Datos
			</footer>
		</div>
	</body>
</html>