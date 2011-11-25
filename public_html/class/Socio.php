<?php
	class Socio implements iUser
	{
		private static $notNullProperties = array('rut', 'email', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'sexo', 'comuna', 'direccion', 'fechaRegistro', 'fechaNacimiento', 'telefono1');
		
		private $rut;
		private $email;
		private $nombre;
		private $apellidoPaterno;
		private $apellidoMaterno;
		private $sexo;
		private $comuna;
		private $direccion;
		private $fechaRegistro;
		private $fechaNacimiento;
		private $telefono1;
		private $telefono2;
		
		private $dbh;
		
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
			$this->dbh = &PDOFactory::getPDOObject();
			
			if($rut !== '')
			{
				// Intentar recuperar con valores de la DB
				try{
					// Intentar crear una variable dbh que contiene el objeto PDO inicializado
					/* require('_connect.php');
					*/
					
					// Preparar el statement sql
					$stmt =	$this->dbh->prepare('
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
					
					
					// Assign values
					$this->rut = $result['rut_socio'];
					
					$this->email = $result['email'];
					$this->nombre = $result['nombre'];
					$this->apellidoPaterno = $result['apellido_paterno'];
					$this->apellidoMaterno = $result['apellido_materno'];
					$this->sexo = $result['sexo'];
					
					$this->comuna = $result['comuna'];
					$this->direccion = $result['direccion'];
					$this->fechaRegistro = $result['fecha_registro'];
					$this->fechaNacimiento = $result['fecha_nacimiento'];
					$this->telefono1 = $result['telefono1'];
					$this->telefono2 = $result['telefono2'];
					
					
						
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
					/* require('_connect.php');
					*/
					
					// Preparar el statement sql
					$stmt =	$this->dbh->prepare('
						INSERT INTO socio(rut_socio, email, nombre, apellido_paterno, apellido_materno, sexo, comuna, direccion, fecha_registro, fecha_nacimiento, telefono1, telefono2)
						VALUES (:rut_socio, :email, :nombre, :apellido_paterno, :apellido_materno, :sexo, :comuna, :direccion, :fecha_registro, :fecha_nacimiento, :telefono1, :telefono2)
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_socio', $this->rut, PDO::PARAM_STR);
					
					$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
					$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_paterno', $this->apellidoPaterno, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_materno', $this->apellidoMaterno, PDO::PARAM_STR);
					$stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
					
					$stmt->bindParam(':comuna', $this->comuna, PDO::PARAM_STR);
					$stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_registro', $this->fechaRegistro, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_nacimiento', $this->fechaNacimiento, PDO::PARAM_STR);
					$stmt->bindParam(':telefono1', $this->telefono1, PDO::PARAM_STR);
					$stmt->bindParam(':telefono2', $this->telefono2, PDO::PARAM_STR);
					
					
					
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
					/* require('_connect.php');
					*/
					
					// Preparar el statement sql
					$stmt =	$this->dbh->prepare('
						UPDATE socio
						SET rut_socio=:rut_socio, email=:email, nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, sexo=:sexo, comuna=:comuna, direccion=:direccion, fecha_registro=:fecha_registro, fecha_nacimiento=:fecha_nacimiento, telefono1=:telefono1, telefono2=:telefono2
						WHERE rut_socio=:rut_socio
						');
					
					// Bind the parameters
					$stmt->bindParam(':rut_socio', $this->rut, PDO::PARAM_STR);
					
					$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
					$stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_paterno', $this->apellidoPaterno, PDO::PARAM_STR);
					$stmt->bindParam(':apellido_materno', $this->apellidoMaterno, PDO::PARAM_STR);
					$stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
					
					$stmt->bindParam(':comuna', $this->comuna, PDO::PARAM_STR);
					$stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_registro', $this->fechaRegistro, PDO::PARAM_STR);
					$stmt->bindParam(':fecha_nacimiento', $this->fechaNacimiento, PDO::PARAM_STR);
					$stmt->bindParam(':telefono1', $this->telefono1, PDO::PARAM_STR);
					$stmt->bindParam(':telefono2', $this->telefono2, PDO::PARAM_STR);
					
					
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