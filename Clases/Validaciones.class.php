<?php
require_once '../Conecciones/coneccion.php';
require_once 'Respuestas.class.php';
require_once 'Activo.class.php';

class Validaciones extends Coneccion
{
	
public function allValidacionesByEstado($estado){
	$_respuestas = new Respuestas;
	$consulta= "SELECT Id, NOM_VAL, DES_VAL, FEC_CRE_VAL, IFNULL(FEC_ACT_VAL,0) FEC_ACT_VAL, ID_USU_CVAL, IFNULL(ID_USU_AVAL,0) ID_USU_AVAL , EST_VAL,IFNULL(OBS_VAL,'') AS OBS_VAL FROM validaciones WHERE EST_VAL='$estado' ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['NOM_VAL'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $datos;
	}else{
		return $_respuestas->error_200("No existen VALIDACIONES EN ESTADO: ".$estado);
	}
}
public function allValidacionesByEstados($estado){
	$_respuestas = new Respuestas;
	$consulta= "SELECT Id, NOM_VAL, DES_VAL, FEC_CRE_VAL,FEC_ACT_VAL, ID_USU_CVAL, ID_USU_AVAL, EST_VAL,IFNULL(OBS_VAL,'') AS OBS_VAL FROM validaciones WHERE EST_VAL='$estado' ";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['NOM_VAL'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No existen VALIDACIONES EN ESTADO: ".$estado);
	}
}

public function getDetalleValidacionById($id_val){
	$_respuestas = new Respuestas;
	$consulta= "    SELECT
				    dv.ID_VAL_DET , act.ID_ACT, act.NOM_ACT , act.CED_USU_PER , ifnull(act.OBS_ACT,'') as OBS_ACT, us.NOM_USU, us.APE_USU
				    FROM 
				      detalle_validacion dv 
				    , activos act
				    , usuario us
				    WHERE 
				        dv.ID_ACT_VAL=act.ID_ACT
				    and act.CED_USU_PER=us.CED_USU
				    and dv.ID_VAL_DET='$id_val'";
	$datos= parent:: obtenerDatos($consulta);
	if(isset($datos[0]['ID_VAL_DET'])){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $datos;
	}else{
		return $_respuestas->errors_200("No existen VALIDACIONES EN ESTADO: ".$estado);
	}
}

public function insertarValidacion($Nombre, $Descripcion, $idUsuario){
	$_respuestas = new Respuestas;
	$consulta= "INSERT INTO validaciones (NOM_VAL, DES_VAL, FEC_CRE_VAL, FEC_ACT_VAL, ID_USU_CVAL, ID_USU_AVAL, EST_VAL, OBS_VAL) VALUES ( '$Nombre', '$Descripcion', current_timestamp(), null, '$idUsuario', null, 'PENDIENTE', NULl)";
	$datos= parent:: nonConsultaId($consulta);
	if($datos>0){
		$result= $_respuestas->respuesta;
		$result['result']=$datos;
		return $result;
	}else{
		return $_respuestas->error_200("No se grabo");
	}
}

public function insertarValidacionDetalle($idValidacion, $idEmpleado){
	$_respuestas = new Respuestas;
	$idEmpVal=$this->insertarDetalleEmpleadosValidacion($idValidacion, $idEmpleado);
	$contador=0;
	if($idEmpVal>0){
		$_activos= new Activo;
		$datos=$_activos->getActivosByCedula($idEmpleado);
		foreach ($datos as $dato) {
			$this->insertarDetalleActivosValidacion($idEmpVal, $dato['COD_ACT']);
			$contador++;
		}
		if($contador>0){
		$result= $_respuestas->respuesta;
		$result['result']=$contador;
		return $result;
	}else{
		return $_respuestas->error_200("No se grabo");
	}

	}
	
}
public function insertarDetalleActivosValidacion($idEmpVal,$idActivo){
	$consulta= "INSERT INTO activosvalidacion (ID_EMPV_ACTV, ID_ACT_ACTV, EST_ACTV, OBS_ACTV) VALUES ('$idEmpVal', '$idActivo', 0, null)";
	$datos= parent:: nonConsultaId($consulta);
	if($datos>0){
		
		return $datos;
	}else{
		return 0;
	}

}

public function insertarDetalleEmpleadosValidacion($idValidacion, $idEmpleado){
	$consulta= "INSERT INTO empleadosvalidacion (ID_VAL_EMPV, CED_EMP_EMPV, OBS_EMPV) VALUES ('$idValidacion', '$idEmpleado', null)";
	$datos= parent:: nonConsultaId($consulta);
	if($datos>0){
		
		return $datos;
	}else{
		return 0;
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