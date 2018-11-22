<?php
require_once("../modelo/usuario.php");
$usu = $_POST["usu"];
try{
$per=new usuario();
$resultado = $per->valida_existencia($usu);
	if($resultado == "1"){
		session_start();
		$_SESSION['axr']=1;
		header("Location:../registro.php");
		
	}else{
		header("Location:../index.php?existe=Usuario_existe");
	}
}catch(Exception $e){
	header("Location:../index.php");
	echo "Error";
}
?>