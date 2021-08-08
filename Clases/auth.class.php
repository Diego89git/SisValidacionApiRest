<?php

require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';

class auth extends Coneccion{

	public function login ($usuario, $pass){

		$_respuestas = new Respuestas;
		if($this->verificarUsuario($usuario)){
			$datos= $this->obtenerUsuario($usuario, $pass);
			if($datos){
				$result= $_respuestas->respuesta;
				$result['result']=$datos;
				return $result;
			}else{
				return $_respuestas->error_200("Clave incorrecta");	
			}
		}else{
			return $_respuestas->error_200("Usuario no existe");
		}

	}

	private function verificarUsuario($usuario){
		$consulta= "SELECT NOM_USU FROM usuario Where NOM_USU='$usuario'";
		$datos= parent:: obtenerDatos($consulta);
		if(isset($datos[0]['NOM_USU'])){
			return true;
		}else{
			return false;
		}

	}

	private function obtenerUsuario($usuario, $pass){
		$consulta= "SELECT Id, NOM_USU, COR_USU, PAS_USU FROM usuario Where NOM_USU='$usuario' and PAS_USU=SHA1('$pass')";
		$datos= parent:: obtenerDatos($consulta);
		if(isset($datos[0]['NOM_USU'])){
			return $datos;
		}else{
			return 0;
		}

	}
	public function userById($id){
		$consulta= "SELECT Id, NOM_USU, COR_USU, PAS_USU FROM usuario Where Id='$id'";
		$datos= parent:: obtenerDatos($consulta);
		if(isset($datos[0]['NOM_USU'])){
			return $datos;
		}else{
			return 0;
		}

	}

	public function desconectar(){
		parent:: desconectar();
	}



}

?>