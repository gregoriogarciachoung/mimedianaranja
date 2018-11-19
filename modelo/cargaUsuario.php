<?php
require_once('../util/conexion.php');
class cargaUsuario{
    private $db;
	private $datos;
	private $filtros;
	private $otrosIntereses;
 
    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
		$this->datos=array();
		$this->filtros=array();
		$this->otrosIntereses=array();
    }
	public function get_filtros($pass){
        $consulta=$this->db->prepare("call ps_consultaMisFiltros(?)");
		$consulta->bindParam(1,$pass);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->filtros[]=$filas;
        }
        return $this->filtros;
		$consulta = null;
		$this->db = null; 
    }
	public function get_datos($a){
        $consulta=$this->db->prepare("call ps_consultaMisDatos(?)");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->datos[]=$filas;
        }
        return $this->datos;
		$consulta = null;
		$this->db = null; 
    }
	public function get_otrosIntereses($a){
        $consulta=$this->db->prepare("call ps_listaRespuestaIntereses(?)");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->datos[]=$filas;
        }
        return $this->datos;
		$consulta = null;
		$this->db = null; 
    }
}
?>
