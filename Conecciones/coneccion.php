<?php  
class Coneccion 
{
	
	private $servidor;
	private $usuario;
	private $pass;
	private $database;
	private $port;
	private $coneccion;


	function __construct()
	{
		$datcon= $this->datCon();
		foreach ($datcon as $dat) {
			$this->servidor=$dat["servidor"];
			$this->usuario=$dat["usuario"];
			$this->pass=$dat["pass"];
			$this->database=$dat["database"];
			$this->port=$dat["port"];
		}
		$this->coneccion= new mysqli($this->servidor, $this->usuario, $this->pass, $this->database, $this->port);
		if($this->coneccion->connect_error){
			echo "error en la coneccion";
		}

	}


	private function datCon(){
			$ruta= dirname(__FILE__);
			$jsondata= file_get_contents($ruta."/"."config");
			return json_decode($jsondata,true);
	}

	private function convertirUTF8($array){
		array_walk_recursive($array, function(&$item,$key){
			if(!mb_detect_encoding($item,'utf-8', true)){
				$item = utf8_encode($item);
			}
		});
		return $array;
	}
//consulta de datos
	public function obtenerDatos($consulta){
		$datos= $this->coneccion->query($consulta);
		$resultado= array();
		foreach ($datos as $res) {
			$resultado[]=$res;
		}
		return $this->convertirUTF8($resultado);
	}
//insercion de datos
	public function nonConsulta($consulta){
		$datos= $this->coneccion->query($consulta);
		return $this->coneccion->affected_rows;
	}
	public function nonConsultaId($consulta){
		$datos= $this->coneccion->query($consulta);
		$rows= $this->coneccion->affected_rows;
		if($rows>=1){			
			return $this->coneccion->insert_id;
		}else{
			return 0;
		}

	}
	public function desconectar ()
	  {
	    mysqli_close($this->coneccion);
	  }
}

?>