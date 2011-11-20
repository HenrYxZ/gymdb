<?php
	class Token
	{
		public static function create_token($nm = "_token")
		{
			$_SESSION[$nm] = time();
			echo '<input type="hidden" name="'.$nm.'" value="'.$_SESSION[$nm].'"​ />';
		}
		
		
		public static function validToken($nm = "_token")
		{
			if($_SESSION[$nm]==$_POST[​$nm])
			{
				unset($_SESSION[$nm]);
				return true; 
			}
			else
			{
				return false;
			}
		}


		/*
		// Agradecimientos a Keshav Verma, http://www.facebook.com/keshavmix por el comentario en
		// http://www.bjw.co.nz/developer/general/75-how-to-prevent-form-resubmission
		//
		
		En alguna parte del form que generará un update o insert,
		escribir	<?php Token::create_token(); ?> .
		
		Luego, en el script que manejará la actualización de la DB, poner lo siguiente:
		
		
			if (isset($_POST['data']) && Token::validToken())
			{
				// for example, insert into table.
			}
		
		
		//
		// en donde $_POST['data'] representa algún dato del formulario recibido.
		//
		*/
	}
?>