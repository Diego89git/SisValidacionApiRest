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
		$_auth->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['userl']) && isset($_GET['passl'])){
		$usuario=$_GET['userl'];
		$pass=$_GET['passl'];
		$datosArray = $_auth->loginValida($usuario, $pass);
		//$_auth->desconectar();
		header('Content-Type: aplication/json');
		http_response_code(200);
		echo json_encode($datosArray);
	}

	if(isset($_GET['userById'])){
		$id=$_GET['userById'];
		$datosArray = $_auth->userById($id);
		$_auth->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['userLogin'])){
		$usuario=$_GET['user'];
		$pass=$_GET['pass'];
		$datosArray = $_auth->userByLogin($usuario, $pass);
		//$_auth->desconectar();
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