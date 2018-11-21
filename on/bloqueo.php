<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
try{
	$per=new usuario();
	
	$resultado = $per->bloqueo($_POST['chkblo'], $pass);	
	
}catch(Exception $e){
	echo "Error";
}finally{
	header("location:../miperfil.php");	
}
 ?>
