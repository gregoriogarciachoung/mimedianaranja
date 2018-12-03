<?php
require_once("../modelo/administrador.php");

$cor = $_POST['txtCorreo'];

$estado;
try{
	$per=new administrador();
	
	$resultado = $per->bloqueo(2, $cor);	
	$estado="Cambiado";
	
}catch(Exception $e){
	$estado = "Error";
}finally{
	header("location:../controlAdmin.php");	
}
 ?>
