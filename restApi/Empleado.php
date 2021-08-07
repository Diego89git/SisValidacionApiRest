<?php 
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/Empleado.class.php';

$_respuestas= new Respuestas;
$_empleados= new Empleado;

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['empleados'])){
		$postBody= file_get_contents("php://input");
		$datosArray = $_empleados->allEmpleados();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['empleadoss'])){
		$postBody= file_get_contents("php://input");
		$datosArray = $_empleados->allEmpleadoss();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['empleado'])){
		$cedula=$_GET['empleado'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_empleados->ObtenerEmpleado($cedula);
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