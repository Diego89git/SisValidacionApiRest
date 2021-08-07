<?php 
require_once '../Clases/Respuestas.class.php';
require_once '../Clases/Validaciones.class.php';

$_respuestas= new Respuestas;
$_validaciones= new Validaciones;

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['ValidacionesByEstado'])){
		$estado=$_GET['ValidacionesByEstado'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->allValidacionesByEstado($estado);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['ValidacionesByEstados'])){
		$estado=$_GET['ValidacionesByEstados'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->allValidacionesByEstados($estado);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['DetalleValidacionById'])){
		$id_val=$_GET['ID_VAL_DET'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->getDetalleValidacionById($id_val);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['insertarValidacion'])){
		$Nombre=str_replace("_"," ", $_GET['Nombre']);
		$Descripcion=str_replace("_", " ", $_GET['Descripcion']);
		$idUsuario=$_GET['idUsuario'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->insertarValidacion($Nombre, $Descripcion, $idUsuario);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['idValidacion'])){
		$idValidacion=$_GET['idValidacion'];
		$idEmpleado=$_GET['idEmpleado'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->insertarValidacionDetalle($idValidacion, $idEmpleado);
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
	if(isset($_GET['Test'])){
		$postBody= file_get_contents("php://input");
		$datosArray = $_respuestas->test();
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
	if(isset($_GET['DetalleValidacionById'])){
		$id_val=$_GET['ID_VAL_DET'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->getDetalleValidacionById($id_val);
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}

} else if($_SERVER['REQUEST_METHOD']=="PUT"){

} else if($_SERVER['REQUEST_METHOD']=="DELETE"){

} else {
	header('Content-Type: aplication/json');
	$datosArray= $_respuestas->error_405();
	echo json_encode($datosArray);
}




?>