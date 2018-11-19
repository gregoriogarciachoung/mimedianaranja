<?php
require_once('../util/conexion.php');
class cargaOtroUsuario{
    private $db;
    private $usuarios;
	private $usuarios2;
 
    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
        $this->usuarios=array();
		$this->usuarios2=array();
    }
    public function get_usuarios($a,$b,$c,$d,$e,$f,$g){
        $consulta=$this->db->prepare("call ps_buscaOtroUsuario(?,?,?,?,?,?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->bindParam(4,$d);
		$consulta->bindParam(5,$e);
		$consulta->bindParam(6,$f);
		$consulta->bindParam(7,$g);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->usuarios[]=$filas;
        }
        return $this->usuarios;
		$consulta = null;
		$this->db = null; 
    }
	public function get_usuarios2($a){
        $consulta=$this->db->prepare("call sp_cargaOtroUsuario(?)");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->usuarios2[]=$filas;
        }
        return $this->usuarios2;
		$consulta = null;
		$this->db = null; 
    }
}
?>
