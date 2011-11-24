<?php
	class Entrenador implements iUser
	{
		const tipos = array('Profesor','Personal trainer');
		
		private $rut;
		private $email;
		private $nombre;
		private $apellidoPaterno;
		private $apellidoMaterno;
		private $sexo;
		private $tipoEntrenador;
		
		public function __construct($rut)
		{
			// Intentar mostrar lo que se pide (porque la DB podría fallar)
			try{
				// Intentar crear una variable dbh que contiene el objeto PDO inicializado
				/* require('_connect.php');
				*/
				
				// Preparar el statement sql
				$stmt =	$dbh->prepare('
					SELECT *
					FROM socio
					WHERE rut_socio = :rut_socio
					');
				
				// Bind the parameters
				$stmt->bindParam(':rut_socio', $rut, PDO::PARAM_STR);
				
				// Execute the prepared statement
				$stmt->execute();
				
				// Fetch the results
				$results = $stmt->fetchAll();
				
				// Get first row
				$result = $results[0];
				
				
				
					
			}
			catch(PDOException $e){
				Debugger::notice($e->getMessage());
			}
		}
		
		
		
		
		
		
	}
	
?>