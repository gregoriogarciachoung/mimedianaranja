<?php
include('conexion.php');
class lista{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=getConexion();
        $this->personas=array();
    }
    public function get_personas(){
        $consulta=$this->db->query("select * from usuariodatos");
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }
}
?>
