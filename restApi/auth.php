<?php
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/auth.class.php';

$_auth = new auth;

$_respuestas= new Respuestas;

if($_SERVER['REQUEST_METHOD']=="POST"){
	$postBody= file_get_contents("php://input");
	$datosArray = $_auth->login($postBody);
	header('Content-Type: aplication/json');
	if(isset($datosArray['result']['error_id'])){
		$codRes=$datosArray['result']['error_id'];
		http_response_code($codRes);
	}else{
		http_response_code(200);
	}
	echo json_encode($datosArray);
}else{
	header('Content-Type: aplication/json');
	$datosArray= $_respuestas->error_405();
	echo json_encode($datosArray);
}


?>