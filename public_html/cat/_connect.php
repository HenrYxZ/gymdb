<?php
$host = 'localhost';
$db = 'grupo19';
$usr = 'grupo19';
$pwd = 'deter.minado3.db';

try{
	$dbh = new PDO("pgsql:host=$host; dbname=$db", $usr, $pwd);
	Debugger::notice('Conectado');
}
catch(PDOException $e){
	Debugger::notice($e->getMessage());
}
?>