<?php

require_once 'coneccion.php';
require_once 'Respuestas.class.php';

class auth extends Coneccion{

	public function login ($json){

		$_respuestas = new Respuestas;
		$datos= json_decode($json, true);
		if(!isset($datos['usuario']) || !isset($datos['pass']) ){
			return $_respuestas->error_400();
		}else{
			$usuario=$datos['usuario'];
			$pass=$datos['pass'];
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

	}

	private function verificarUsuario($usuario){
		$consulta= "SELECT CED_USU FROM usuario Where CED_USU='$usuario'";
		$datos= parent:: obtenerDatos($consulta);
		if(isset($datos[0]['CED_USU'])){
			return true;
		}else{
			return false;
		}

	}

	private function obtenerUsuario($usuario, $pass){
		$consulta= "SELECT CED_USU, NOM_USU, APE_USU FROM usuario Where CED_USU='$usuario' and PAS_USU=SHA1('$pass')";
		$datos= parent:: obtenerDatos($consulta);
		if(isset($datos[0]['CED_USU'])){
			return $datos;
		}else{
			return 0;
		}

	}



}

?>