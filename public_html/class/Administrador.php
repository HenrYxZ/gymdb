<?php
	class Administrador implements iUser
	{
		private static $notNullProperties = array('rut', 'email', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'sexo');
		
		private $rut;
		private $email;
		private $nombre;
		private $apellidoPaterno;
		private $apellidoMaterno;
		private $sexo;
		
		
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
		
		public function __construct($rut = '')
		{
			// Intentar crear una variable dbh que contiene el objeto PDO inicializado
			try{
				$dbh = &PDOFactory::getPDOObject();
			}
			catch(PDOException $e)
			{
				Debugger::notice($e->getMessage());
			}
			
			if($rut !== '')
			{
				// Intentar recuperar con valores de la DB
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					/* require('_connect.php');
					*/
					
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						SELECT *
						FROM administrador
						WHERE rut_admin = :rut_administrador
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_administrador', $rut, PDO::PARAM_STR);
					
					// Execute the prepared statement
					$stmt->execute();
					
					// Fetch the results
					$results = $stmt->fetchAll();
					
					// Get first row
					$result = $results[0];
					
					
					// Assign values
					$this->rut = $result['rut_admin'];
					$this->email = $result['email'];
					$this->nombre = $result['nombre'];
					$this->apellidoPaterno = $result['apellido_paterno'];
					$this->apellidoMaterno = $result['apellido_materno'];
					$this->sexo = $result['sexo'];
					
						
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
						return false;
					}
					
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						INSERT INTO administrador(rut_admin, email, nombre, apellido_paterno, apellido_materno, sexo)
						VALUES (:rut_administrador, :email, :nombre, :apellido_paterno, :apellido_materno, :sexo)
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_administrador', $this->rut, PDO::PARAM_STR);
					$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
					$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_paterno', $this->apellidoPaterno, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_materno', $this->apellidoMaterno, PDO::PARAM_STR);
					$stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
					
					// Execute the prepared statement. Return TRUE on success or FALSE on failure
					return $stmt->execute();
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
					return false;
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
						return false;
					}
							
					// Preparar el statement sql
					$stmt =	$dbh->prepare('
						UPDATE administrador
						SET rut_admin=:rut_administrador, email=:email, nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, sexo=:sexo
						WHERE rut_admin=:rut_administrador
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_administrador', $this->rut, PDO::PARAM_STR);
					$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
					$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_paterno', $this->apellidoPaterno, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_materno', $this->apellidoMaterno, PDO::PARAM_STR);
					$stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
					
					// Execute the prepared statement. Return TRUE on success or FALSE on failure
					return $stmt->execute();
				}
				catch(PDOException $e){
					Debugger::notice($e->getMessage());
					return false;
				}
			}
			else
			{
				Debugger::notice('Existe un campo nulo en el objeto de la clase ' . __CLASS__);
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