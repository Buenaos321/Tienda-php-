<?php
	//inicia una nueva sesion
	session_start();

	// destruye toda la infornacion registrada de sesion
	session_destroy();
	//redirecciona a la pagina de login
	
	header('location: login.php');


?>