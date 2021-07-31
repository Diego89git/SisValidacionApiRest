<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class Usuario extends Coneccion
{
	
public function allUsuarios(){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_USU, NOM_USU, APE_USU 
				FROM usuario 
				WHERE CED_USU NOT IN (
					SELECT CED_USU_PER 
                  	FROM ACTIVOS 
                  	WHERE ID_ACT IN (SELECT DV.ID_ACT_VAL 
                    	FROM detalle_validacion dv, validaciones vl
                       	WHERE dv.ID_VAL_DET=vl.ID_VAL and vl.EST_VAL='PENDIENTE'))";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_USU'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $datos;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function allUsuarioss(){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_USU, NOM_USU, APE_USU 
				FROM usuario 
				WHERE CED_USU NOT IN (
					SELECT CED_USU_PER 
                  	FROM ACTIVOS 
                  	WHERE ID_ACT IN (SELECT DV.ID_ACT_VAL 
                    	FROM detalle_validacion dv, validaciones vl
                       	WHERE dv.ID_VAL_DET=vl.ID_VAL and vl.EST_VAL='PENDIENTE'))";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_USU'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function obtenerUsuario($cedula){
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