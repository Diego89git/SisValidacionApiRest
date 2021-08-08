<?php
class Respuestas {

	public $respuesta=[
		"status"=>"ok",
		"result"=> array()
	];

	public function error_405(){
		$this->respuesta["status"]="error";
		$this->respuesta["result"]= array(
			"error_id"=>"405",
			"error_msg"=>"Metodo no permitido"
		);
		return $this->respuesta;
	}
	public function error_200($str="Datos incorrectos"){
		$this->respuesta["status"]="error";
		$this->respuesta["result"]= array(
			"error_id"=>"200",
			"error_msg"=>$str
		);
		return $this->respuesta;
	}
	public function errors_200($str="Datos incorrectos"){
		$this->respuesta["status"]="error";
		$this->respuesta["result"]= array(
			"error_id"=>"200",
			"error_msg"=>$str
		);
		return $this->respuesta;
	}
	public function error_400(){
		$this->respuesta["status"]="error";
		$this->respuesta["result"]= array(
			"error_id"=>"400",
			"error_msg"=>"Datos enviados incompletos o con formato incorrecto"
		);
		return $this->respuesta;
	}
	public function test(){
		$this->respuesta["status"]="ok";
		$this->respuesta["result"]= array(
			"cod"=>"200",
			"msg"=>"Se obtuvo una"
		);
		return $this->respuesta;
	}






}


?>