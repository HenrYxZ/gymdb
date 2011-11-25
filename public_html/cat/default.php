<h2>Bienvenido al portal de nuestro gimnasio
<?php
	if(isset($_SESSION['user']))
		echo ', ' . $_SESSION['user']->nombre;

?></h2>
<p>Puede elegir una acción a realizar desde el men&uacute; de arriba.</p>

<img src="img/mancuernas_byn.jpg" alt="mancuernas" />

<p></p>