<?php
require_once('../util/conexion.php');
class usuario{
    private $db;
	private $res; //guarda el resultado al cambiar la contraseña
	private $loginn;

    public function __construct(){
		$bd = new conexion();
		$this->db= $bd->getConexion();
		$this->res=array();
		$this->loginn=array();
    }
	public function registrar($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m){
        $consulta=$this->db->prepare("call sp_registraUsuario(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->bindParam(4,$d);
		$consulta->bindParam(5,$e);
		$consulta->bindParam(6,$f);
		$consulta->bindParam(7,$g);
		$consulta->bindParam(8,$h);
		$consulta->bindParam(9,$i);
		$consulta->bindParam(10,$j);
		$consulta->bindParam(11,$k);
		$consulta->bindParam(12,$l);
		$consulta->bindParam(13,$m);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function set_filtros($a,$b,$c,$d,$e,$f,$g,$h){
        $consulta=$this->db->prepare("update filtros set buscoSexo = ?, edadMax = ?, edadMin = ?, alturaMax = ?, alturaMin = ?, idInteres = ?, lugar = (select id from distritos where nom = ?) where idUsu = (select id from usuario where mail = ?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->bindParam(4,$d);
		$consulta->bindParam(5,$e);
		$consulta->bindParam(6,$f);
		$consulta->bindParam(7,$g);
		$consulta->bindParam(8,$h);
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
	public function me_gusta($a,$b){
        $consulta=$this->db->prepare("call sp_meGusta(?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function editar_descripcion($a,$b){
        $consulta=$this->db->prepare("update usuarioDatos set autodes = ? where idUsu = (select id from usuario where mail = ?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function editar_ocupacion($a,$b){
        $consulta=$this->db->prepare("update usuarioDatos set ocupacion = ? where idUsu = (select id from usuario where mail = ?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function editar_distrito($a,$b){
        $consulta=$this->db->prepare("update usuarioDatos set idDistrito = (select id from distritos where nom = ?) where idUsu = (select id from usuario where mail = ?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->execute();
		$consulta = null;
		$this->db = null; 
    }
	public function editar_pass($a,$b,$c){
        $consulta=$this->db->prepare("call sp_cc(?,?,?)");
		$consulta->bindParam(1,$a);
		$consulta->bindParam(2,$b);
		$consulta->bindParam(3,$c);
		$consulta->execute();
		//obtener respuesta al cambio de contraseña, la validación está en la bd
		while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->res[]=$filas;
        }
		return $this->res;
		$consulta = null;
		$this->db = null; 
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
        $consulta=$this->db->prepare("call sp_login(?,?)");
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
	public function valida_existencia($a){
        $consulta=$this->db->prepare("select count(*) as val from usuario where mail = ?");
		$consulta->bindParam(1,$a);
		$consulta->execute();
		//obtener respuesta al cambio de contraseña, la validación está en la bd
		$filas=$consulta->fetch(PDO::FETCH_ASSOC);
		return $filas["val"][0];
		$consulta = null;
		$this->db = null; 
    }
}
?>
