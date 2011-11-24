<?php
	interface iUser
	{
		public function __get($property);
		public function __set($property, $value);
		
		public function update();
		public function insert();
	}
?>