<?php
require_once('../util/conexion.php');
class administrador{
    private $db;
	private $res; //guarda el resultado al cambiar la contraseña
	private $loginn;

    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
		$this->res=array();
		$this->loginn=array();
    }
	public function bloqueo($a,$b){
        $consulta=$this->db->prepare("update usuario set estado = ? where mail = ?");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function login($a,$b){
        $consulta=$this->db->prepare("select count(*) as 'permiso' from admin where correo = ? and pass = ?");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		//obtener respuesta al cambio de contraseña, la validación está en la bd
		while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->loginn[]=$filas;
        }
		return $this->loginn;
		$consulta = null;
		$this->db = null; 
    }
	public function envia_mensaje($a,$b,$c){
        $consulta=$this->db->prepare("call sp_enviarMensajeAdmin(?,?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
}
?>
