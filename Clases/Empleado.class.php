<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class Empleado extends Coneccion
{
	
public function allEmpleados(){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_EMP, NOM_EMP, APE_EMP 
				FROM empleados 
				WHERE CED_EMP NOT IN (
					SELECT CED_EMP_EMPV 
                  	FROM empleadosvalidacion
                  	WHERE ID_VAL_EMPV IN (SELECT Id 
                    	FROM validaciones 
                       	WHERE EST_VAL='PENDIENTE'))";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_EMP'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $datos;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function allEmpleadoss(){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_EMP, NOM_EMP, APE_EMP 
				FROM empleados 
				WHERE CED_EMP NOT IN (
					SELECT CED_EMP_EMPV 
                  	FROM empleadosvalidacion
                  	WHERE ID_VAL_EMPV IN (SELECT Id 
                    	FROM validaciones 
                       	WHERE EST_VAL='PENDIENTE'))";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_EMP'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function obtenerEmpleado($cedula){
	$_respuestas = new Respuestas;
	$consulta= "SELECT CED_EMP, NOM_EMP, APE_EMP FROM empleados WHERE CED_EMP='$cedula' ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['CED_EMP'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function desconectar(){
		parent:: desconectar();
	}



}


?>