<?php
require_once('../util/conexion.php');
class usuario{
    private $db;

    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
    }
	public function set_filtros($a,$b,$c,$d,$e,$f,$g){
        $consulta=$this->db->prepare("update filtros set buscoSexo = ?, edadMax = ?, edadMin = ?, alturaMax = ?, alturaMin = ?, idInteres = ? where idUsu = (select id from usuario where mail = ?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->bindParam(4,$d);
		$consulta->bindParam(5,$e);
		$consulta->bindParam(6,$f);
		$consulta->bindParam(7,$g);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function envia_mensaje($a,$b,$c){
        $consulta=$this->db->prepare("insert into mensajes(emisor, receptor, fecha, msj) values ((select id from usuario where mail = ?),?,curdate(),?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function editar_interes($a,$b,$c){
        $consulta=$this->db->prepare("call ps_editarResOtrosIntereses(?,?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function me_gusta($a,$b,$c){
        $consulta=$this->db->prepare("call sp_meGusta(?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
}
?>
