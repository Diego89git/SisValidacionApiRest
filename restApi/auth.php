<?php
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/auth.class.php';

$_auth = new auth;

$_respuestas= new Respuestas;

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['u']) && isset($_GET['p'])){
		$usuario=$_GET['u'];
		$pass=$_GET['p'];
		$datosArray = $_auth->login($usuario, $pass);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['userById'])){
		$id=$_GET['id'];
		$datosArray = $_auth->userById($id);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
}else{
	header('Content-Type: aplication/json');
	$datosArray= $_respuestas->error_405();
	echo json_encode($datosArray);
}


?>