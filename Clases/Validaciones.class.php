<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class Validaciones extends Coneccion
{
	
public function allValidacionesByEstado($estado){
	$_respuestas = new Respuestas;
	$consulta= "SELECT ID_VAL, IFNULL(OBS_VAL,'') AS OBS_VAL, FEC_VAL, EST_VAL FROM validaciones WHERE EST_VAL='$estado' ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['ID_VAL'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $datos;
	}else{
		return $_respuestas->error_200("No existen VALIDACIONES EN ESTADO: ".$estado);
	}
}

public function insertarValidacion(){
	$_respuestas = new Respuestas;
	$consulta= "INSERT INTO validaciones (OBS_VAL, FEC_VAL, EST_VAL) VALUES ( NULL, current_timestamp(), 'PENDIENTE')";
	$datos= parent:: nonConsultaId($consulta);
	if($datos>0){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No se grabo");
	}
}

public function insertarValidacionDetalle($idValidacion, $idActivo){
	$_respuestas = new Respuestas;
	$consulta= "INSERT INTO detalle_validacion (ID_VAL_DET, EST_CON_DET, ID_ACT_VAL) VALUES ('$idValidacion', '0', '$idActivo')";
	$datos= parent:: nonConsulta($consulta);
	if($datos>0){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No se grabo");
	}
}


public function allProcesosValidacionPorEstado($estado){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_USU, NOM_USU, APE_USU FROM usuario ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_USU'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function procesoValidacionPorId($id){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_USU, NOM_USU, APE_USU FROM usuario WHERE CED_USU='$cedula' ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_USU'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}


}


?>