<?php
	class PDOFactory
	{
		private static $config = array('host' => 'kegan.ing.puc.cl', 'db' => 'grupo19', 'usr' => 'grupo19', 'pwd' => 'deter.minado3.db');
		
		public static function &getPDOObject()
		{
			try{
				$dbh = new PDO("pgsql:host=" .self::$config['host']. "; dbname=" .self::$config['db'], self::$config['usr'], self::$config['pwd']);
				Debugger::notice('Conectado');
				return $dbh;
			}
			catch(PDOException $e){
				Debugger::notice($e->getMessage());
				return null;
			}
		}
	}
	
?>