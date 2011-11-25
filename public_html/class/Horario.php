<?php
	class Horario
	{
		private static $tipos = array('Entrenamiento','Evaluacion','Karate');
		
		private static $notNullProperties = array('fechaInicio', 'fechaTermino', 'rutEntrenador');
		
		private $fechaInicio;
		private $fechaTermino;
		private $rutEntrenador;
		private $rutSocio;
		private $tipoActividad;
		
		private $fechaInicioPrev;
		
				
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
						
					$this->fechaInicioPrev = $result['fecha_inicio'];
					
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
				}
			}
		}
		
		public function insert()
		{
			if ( true )
			{
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					try{
						$dbh = &PDOFactory::getPDOObject();
					}
					catch(PDOException $e)
					{
						Debugger::notice($e->getMessage());
						return false;
					}
					
					if(strlen(trim($this->tipoActividad)) > 0) 
					{
						// Preparar el statement sql
						$stmt =	$dbh->prepare('
							INSERT INTO horario(fecha_inicio, fecha_termino, rut_entrenador, rut_socio, tipo_actividad)
							VALUES (:fecha_inicio, :fecha_termino, :rut_entrenador, :rut_socio, :tipo_actividad)
							');
							
						$stmt->bindParam(':tipo_actividad', $this->tipoActividad, PDO::PARAM_STR);
					}
					else
					{
						// Preparar el statement sql
						$stmt =	$dbh->prepare('
							INSERT INTO horario(fecha_inicio, fecha_termino, rut_entrenador, rut_socio)
							VALUES (:fecha_inicio, :fecha_termino, :rut_entrenador, :rut_socio)
							');
					}
					// Bind the parameters
					$stmt->bindParam(':fecha_inicio', $this->fechaInicio, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_termino', $this->fechaTermino, PDO::PARAM_STR);
					$stmt->bindParam(':rut_entrenador', $this->rutEntrenador, PDO::PARAM_STR);
					$stmt->bindParam(':rut_socio', $this->rutSocio, PDO::PARAM_STR);
					
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
				return false;
			}
		}
		
		public function update()
		{
			if ( true )
			{
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					try{
						$dbh = &PDOFactory::getPDOObject();
					}
					catch(PDOException $e)
					{
						Debugger::notice($e->getMessage());
						return false;
					}
					
					if(strlen(trim($this->tipoActividad)) > 0) 
					{
						if(strlen(trim($this->rutSocio) > 0))
						{
							// Preparar el statement sql
							$stmt =	$dbh->prepare('
								UPDATE horario 
								SET fecha_inicio=:fecha_inicio, fecha_termino=:fecha_termino, rut_entrenador=:rut_entrenador, rut_socio=:rut_socio, tipo_actividad=:tipo_actividad 
								WHERE rut_entrenador=:rut_entrenador 
								AND fecha_inicio=:fecha_inicio_original
								');
							$stmt->bindParam(':rut_socio', $this->rutSocio, PDO::PARAM_STR);
						}
						else
						{
							// Preparar el statement sql
							$stmt =	$dbh->prepare('
								UPDATE horario 
								SET fecha_inicio=:fecha_inicio, fecha_termino=:fecha_termino, rut_entrenador=:rut_entrenador, tipo_actividad=:tipo_actividad, rut_socio=DEFAULT 
								WHERE rut_entrenador=:rut_entrenador 
								AND fecha_inicio=:fecha_inicio_original
								');
						}
							
						$stmt->bindParam(':tipo_actividad', $this->tipoActividad, PDO::PARAM_STR);
					}
					else
					{
						if(strlen(trim($this->rutSocio)) > 0)
						{
							// Preparar el statement sql
							$stmt =	$dbh->prepare('
								UPDATE horario 
								SET fecha_inicio=:fecha_inicio, fecha_termino=:fecha_termino, rut_entrenador=:rut_entrenador, rut_socio=:rut_socio, tipo_actividad=DEFAULT 
								WHERE rut_entrenador=:rut_entrenador 
								AND fecha_inicio=:fecha_inicio_original
								');
							
							$stmt->bindParam(':rut_socio', $this->rutSocio, PDO::PARAM_STR);
						}
						else
						{
							$stmt =	$dbh->prepare('
								UPDATE horario 
								SET fecha_inicio=:fecha_inicio, fecha_termino=:fecha_termino, rut_entrenador=:rut_entrenador, tipo_actividad=DEFAULT, rut_socio=DEFAULT 
								WHERE rut_entrenador=:rut_entrenador 
								AND fecha_inicio=:fecha_inicio_original
								');
						}
					}
					// Bind the parameters
					$stmt->bindParam(':fecha_inicio', $this->fechaInicio, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_termino', $this->fechaTermino, PDO::PARAM_STR);
					$stmt->bindParam(':rut_entrenador', $this->rutEntrenador, PDO::PARAM_STR);
					
					$stmt->bindParam(':fecha_inicio_original', $this->fechaInicioPrev, PDO::PARAM_STR);
					
					
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
				return false;
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
					return false;
				}
				
				// Preparar el statement sql
				$stmt =	$dbh->prepare('
						DELETE FROM horario
						WHERE rut_entrenador = :rut_entrenador
						AND fecha_inicio = :fecha_inicio
						');
					
				// Bind the parameters
				$stmt->bindParam(':rut_entrenador', $this->rutEntrenador, PDO::PARAM_STR);
				$stmt->bindParam(':fecha_inicio', $this->fechaInicio, PDO::PARAM_STR);
						
						
				// Execute the prepared statement. Return TRUE on success or FALSE on failure
				return $stmt->execute();
			}
			catch(PDOException $e)
			{
				Debugger::notice($e->getMessage());
				return false;
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