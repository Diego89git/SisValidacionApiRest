<?php 
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/Activo.class.php';

$_respuestas= new Respuestas;
$_activos= new Activo;

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['activosByUser'])){
		$usuario=$_GET['activosByUser'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_activos->getActivosByUsuario($usuario);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['activoByCodigo'])){
		$codigo=$_GET['activoByCodigo'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_activos->getActivosByCodigo($codigo);
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