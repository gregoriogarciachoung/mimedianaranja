<?php
require_once('../util/conexion.php');
class cargaUsuario{
    private $db;
	private $datos;
	private $filtros;
	private $otrosIntereses;
	private $meGustan;
	private $misMensajes;
	private $liges;
 
    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
		$this->datos=array();
		$this->filtros=array();
		$this->otrosIntereses=array();
		$this->meGustan=array();
		$this->misMensajes=array();
		$this->liges=array();
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
	public function get_meGustan($a){
        $consulta=$this->db->prepare("call sp_listaMegustan(?)");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->meGustan[]=$filas;
        }
        return $this->meGustan;
		$consulta = null;
		$this->db = null; 
    }
	public function get_misMensajes($a){
        $consulta=$this->db->prepare("select * from mensajes m join usuarioDatos ud on m.emisor = ud.idUsu where m.receptor = (select id from usuario where mail = ?) order by m.fecha, m.id desc");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->misMensajes[]=$filas;
        }
        return $this->misMensajes;
		$consulta = null;
		$this->db = null; 
    }
	public function get_liges($a){
        $consulta=$this->db->prepare("call sp_listaParejas(?)");
		$consulta->bindParam(1,$a);
		$consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->liges[]=$filas;
        }
        return $this->liges;
		$consulta = null;
		$this->db = null; 
    }
}
?>
