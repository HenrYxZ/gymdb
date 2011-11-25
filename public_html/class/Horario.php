<?php
	class Horario
	{
		private static $tipos = array('Entrenamiento','Evaluación','Karate');
		
		private static $notNullProperties = array('fechaInicio', 'fechaTermino', 'rutEntrenador');
		
		private $fechaInicio;
		private $fechaTermino;
		private $rutEntrenador;
		private $rutSocio;
		private $tipoActividad;
				
		public function __get($property) {
			if(array_key_exists($property,get_class_vars(__CLASS__)))
				return $this->$property;
			else
				throw new Exception ('Método getter inexistente en la clase '.__CLASS__);
		}
		
		public function __set($property, $value) {
			if (array_key_exists($property, get_class_vars(__CLASS__)))
				$this->$property = $value;
			else
				throw new Exception ('Método setter inexistente en la clase '.__CLASS__);
		}
		
		public function __construct($rutEntrenador = '', $fechaInicio = '')
		{
			// Intentar crear una variable dbh que contiene el objeto PDO inicializado
			try{
				$dbh = &PDOFactory::getPDOObject();
			}
			catch(PDOException $e)
			{
				Debugger::notice($e->getMessage());
			}
			
			if($rutEntrenador !== '' && $fechaInicio !== '')
			{
				// Intentar recuperar con valores de la DB
				try{					
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						SELECT *
						FROM horario
						WHERE rut_entrenador = :rut_entrenador
						AND fecha_inicio = :fecha_inicio
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_entrenador', $rutEntrenador, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
					
					// Execute the prepared statement
					$stmt->execute();
					
					// Fetch the results
					$results = $stmt->fetchAll();
					
					// Get first row
					$result = $results[0];
					
					
					// Assign values
					$this->fechaInicio = $result['fecha_inicio'];
					$this->fechaTermino = $result['fecha_termino'];
					$this->rutEntrenador = $result['rut_entrenador'];
					$this->rutSocio = $result['rut_socio'];
					$this->tipoActividad = $result['tipo_actividad'];
						
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
				}
			}
		}
		
		public function insert()
		{
			if ( !in_array(null, $this->getNotNullClassVarsValues(), true) )
			{
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					try{
						$dbh = &PDOFactory::getPDOObject();
					}
					catch(PDOException $e)
					{
						Debugger::notice($e->getMessage());
					}
					
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						INSERT INTO horario(fecha_inicio, fecha_termino, rut_entrenador, rut_socio, tipo_actividad)
						VALUES (:fecha_inicio, :fecha_termino, :rut_entrenador, :rut_socio, :tipo_actividad)
						');
					
					// Bind the parameters
					$stmt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_termino', $fechaTermino, PDO::PARAM_STR);
					$stmt->bindParam(':rut_entrenador', $rutEntrenador, PDO::PARAM_STR);
					$stmt->bindParam(':rut_socio', $rutSocio, PDO::PARAM_STR);
					$stmt->bindParam(':tipo_actividad', $tipoActividad, PDO::PARAM_STR);
					
					// Execute the prepared statement. Return TRUE on success or FALSE on failure
					return $stmt->execute();
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
				}
			}
			else
			{
				Debugger::notice('Existe un campo nulo en el objeto de la clase ' . __CLASS__);
			}
		}
		
		public function update()
		{
			if ( !in_array(null, $this->getNotNullClassVarsValues(), true) )
			{
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					try{
						$dbh = &PDOFactory::getPDOObject();
					}
					catch(PDOException $e)
					{
						Debugger::notice($e->getMessage());
					}
					
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						UPDATE socio
						SET rut_socio=:rut_socio, email=:email, nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, sexo=:sexo, comuna=:comuna, direccion=:direccion, fecha_registro=:fecha_registro, fecha_nacimiento=:fecha_nacimiento, telefono1=:telefono1, telefono2=:telefono2
						WHERE rut_socio=:rut_socio
						');
					
					// Bind the parameters
					$stmt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_termino', $fechaTermino, PDO::PARAM_STR);
					$stmt->bindParam(':rut_entrenador', $rutEntrenador, PDO::PARAM_STR);
					$stmt->bindParam(':rut_socio', $rutSocio, PDO::PARAM_STR);
					$stmt->bindParam(':tipo_actividad', $tipoActividad, PDO::PARAM_STR);
					
					
					// Execute the prepared statement. Return TRUE on success or FALSE on failure
					return $stmt->execute();
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
				}
			}
			else
			{
				Debugger::notice('Existe un campo nulo en el objeto de la clase ' . __CLASS__);
			}
		}
		
		public function delete()
		{
			try{
				// Intentar crear una variable dbh que contiene el objeto PDO inicializado
				try
				{
					$dbh = &PDOFactory::getPDOObject();
				}
				catch(PDOException $e)
				{
					Debugger::notice($e->getMessage());
				}
				
				// Preparar el statement sql
				$stmt =	$dbh->prepare('
						DELETE FROM horario
						WHERE rut_entrenador = :rut_entrenador
						AND fecha_inicio = :fecha_inicio
						');
					
				// Bind the parameters
				$stmt->bindParam(':rut_entrenador', $rutEntrenador, PDO::PARAM_STR);
				$stmt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
						
						
				// Execute the prepared statement. Return TRUE on success or FALSE on failure
				return $stmt->execute();
			}
			catch(PDOException $e)
			{
				Debugger::notice($e->getMessage());
			}	
		}
	
		
		/**
		  * Retorna un arreglo que contiene todas las propiedades de la clase que no pueden ser nulas,
		  * junto con sus valores (que podrían ser nulos en este arreglo). Se usa para verificar si
		  * alguno de ellos es o no nulo.
		  *
		  * @return array
		  */
		private function getNotNullClassVarsValues()
		{
			$result = array();
			
			foreach(get_class_vars(__CLASS__) as $name => $value)
			{
				if( in_array( $name, self::$notNullProperties ) )
				{
					$result[$name] = $value;
				}
			}
			
			return $result;
		}
	}
	
?>