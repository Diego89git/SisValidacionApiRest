<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class Activo extends Coneccion
{
	
public function getActivosByUsuario($usuario){
	$_respuestas = new Respuestas;
	$consulta= "SELECT COD_ACT, NOM_ACT, CED_EMP_ACT, IFNULL(OBS_ACT,'') OBS_ACT FROM activos WHERE CED_EMP_ACT='$usuario'";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['COD_ACT'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}
public function getActivosByCedula($cedula){
	$_respuestas = new Respuestas;
	$consulta= "SELECT COD_ACT, NOM_ACT, CED_EMP_ACT, IFNULL(OBS_ACT,'') OBS_ACT FROM activos WHERE CED_EMP_ACT='$cedula'";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['COD_ACT'])){
		return $datos;
	}else{
		return 0;
	}
}
public function getActivosByCodigo($codigo){
	$_respuestas = new Respuestas;
	$consulta= "SELECT COD_ACT, NOM_ACT, CED_EMP_ACT, IFNULL(OBS_ACT,'') OBS_ACT FROM activos WHERE COD_ACT='$codigo'";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['COD_ACT'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return 0;
	}
}
public function desconectar(){
		parent:: desconectar();
	}




}


?>