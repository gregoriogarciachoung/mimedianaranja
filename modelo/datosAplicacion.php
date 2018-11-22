<?php
require_once('../util/conexion.php');
class datosAplicacion{
    private $db;
    private $relaciones;
	private $distritos;
	private $nivelEducacion;
 
    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
        $this->relaciones=array();
		$this->distritos=array();
		$this->nivelEducacion=array();
    }
	public function get_relaciones(){
        $consulta=$this->db->prepare("select * from interes");
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->relaciones[]=$filas;
        }
        return $this->relaciones;
		$consulta = null;
		$this->db = null; 
    }
	
	public function get_distritos(){
        $consulta=$this->db->prepare("select * from distritos order by nom asc");
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->distritos[]=$filas;
        }
        return $this->distritos;
		$consulta = null;
		$this->db = null; 
    }
	public function get_nivelEducacion(){
        $consulta=$this->db->prepare("select * from nivelEducacion");
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->nivelEducacion[]=$filas;
        }
        return $this->nivelEducacion;
		$consulta = null;
		$this->db = null; 
    }
}
?>
