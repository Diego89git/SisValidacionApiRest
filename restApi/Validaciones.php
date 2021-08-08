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
		$_validaciones->desconectar();
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
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['validacionById'])){
		$id=$_GET['validacionById'];
		$datosArray = $_validaciones->getValidacionById($id);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['EmpleadoValidacionById'])){
		$id=$_GET['EmpleadoValidacionById'];
		$datosArray = $_validaciones->getEmpleadoValidacionById($id);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['ActivoValidacionById'])){
		$id=$_GET['ActivoValidacionById'];
		$datosArray = $_validaciones->getActivoValidacionById($id);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
		}
		echo json_encode($datosArray);
	}
	if(isset($_GET['DetalleValidacionById'])){
		$id_val=$_GET['ID_VAL_DET'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->getDetalleValidacionById($id_val);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['EmpleadosValidacionByIdVal'])){
		$id_val=$_GET['ID_VAL'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->getEmpleadosValidacionByIdVal($id_val);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['ActivosValidacionByIdEmpVal'])){
		$idEmpVal=$_GET['ActivosValidacionByIdEmpVal'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->getActivosValidacionByIdEmpVal($idEmpVal);
		$_validaciones->desconectar();
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
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['eliminarValidacionById'])){
		$id=$_GET['eliminarValidacionById'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->eliminarValidacion($id);
		$_validaciones->desconectar();
		header('Content-Type: aplication/json');
		if(isset($datosArray['result']['error_id'])){
			$codRes=$datosArray['result']['error_id'];
			http_response_code($codRes);
		}else{
			http_response_code(200);
			echo json_encode($datosArray);
		}
		
	}
	if(isset($_GET['eliminarEmpValById'])){
		$id=$_GET['eliminarEmpValById'];
		$postBody= file_get_contents("php://input");
		$datosArray = $_validaciones->eliminarEmpVal($id);
		$_validaciones->desconectar();
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
		$_validaciones->desconectar();
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
		$_usuarios->desconectar();
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