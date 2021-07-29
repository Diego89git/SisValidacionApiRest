<?php 
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/Usuario.class.php';

$_respuestas= new Respuestas;
$_usuarios= new Usuario;

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['usuarios'])){
		$postBody= file_get_contents("php://input");
		$datosArray = $_usuarios->allUsuarios();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['usuarioss'])){
		$postBody= file_get_contents("php://input");
		$datosArray = $_usuarios->allUsuarioss();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['usuario'])){
		$cedula=$_GET['usuario'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_usuarios->ObtenerUsuario($cedula);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}

} else if($_SERVER['REQUEST_METHOD']=="POST"){

} else if($_SERVER['REQUEST_METHOD']=="PUT"){

} else if($_SERVER['REQUEST_METHOD']=="DELETE"){

} else {
	header('Content-Type: aplication/json');
	$datosArray= $_respuestas->error_405();
	echo json_encode($datosArray);
}




?>