<?php
	class Debugger
	{
		public static $count = 1;
		
		public static function notice($msg = null){
			 $msg = (string)$msg;
			echo '<div class="notice">' . self::$count . '. ' . $msg . '</div>';
			self::$count++; 
		}
	}
?>