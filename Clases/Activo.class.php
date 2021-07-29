<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class Activo extends Coneccion
{
	
public function getActivosByUsuario($usuario){
	$_respuestas = new Respuestas;
	$consulta= "SELECT ID_ACT, CED_USU_PER, NOM_ACT, IFNULL(OBS_ACT,'') OBS_ACT FROM activos WHERE CED_USU_PER='$usuario'";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['ID_ACT'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen usuarios");
	}
}



}


?>