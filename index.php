<?php  
	require_once"Conecciones/coneccion.php";
	$con= new Coneccion();

	$consulta= "SELECT * FROM usuario";
	//print_r($con->obtenerDatos($consulta));
	
?>
hooola