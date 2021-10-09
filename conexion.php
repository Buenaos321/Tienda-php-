<?php
	$servidor="localhost";
	$base_datos="maderas";
	$usuario="administrador_maderas";
	$password="6ALrK9m8cArNGXnE";


	$conexion=mysqli_connect($servidor,$usuario,$password,$base_datos);
	mysqli_set_charset($conexion,"utf8mb4");
?>