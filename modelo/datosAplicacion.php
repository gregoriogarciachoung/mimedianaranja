<?php
require_once('../util/conexion.php');
class datosAplicacion{
    private $db;
    private $relaciones;
 
    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
        $this->relaciones=array();
    }
	public function get_relaciones(){
        $consulta=$this->db->prepare("select * from interes");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->relaciones[]=$filas;
        }
        return $this->relaciones;
		$consulta = null;
		$this->db = null; 
    }
}
?>
