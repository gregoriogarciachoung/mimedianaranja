<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
$estado;
try{
	$per=new usuario();
	
	$resultado = $per->bloqueo($_POST['chkblo'], $pass);	
	$estado="Cambiado";
	
}catch(Exception $e){
	$estado = "Error";
}finally{
	header("location:../miperfil.php?estado=".$estado);	
}
 ?>
