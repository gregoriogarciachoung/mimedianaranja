<?php
/*
try{
include('conexion.php');
$usu = $_POST['usu'];
$pass = $_POST['pass'];
$query = getConexion()->prepare('call sp_login(?,?)');
$query->bindParam(1,$usu);
$query->bindParam(2,$pass);
$query->execute();
$res = $query->fetch(PDO::FETCH_ASSOC);
if($res['id'] == '1'){
	session_start();
	$_SESSION['ax']=1;
	$_SESSION['usu']=$usu;
	//header("Location:mmm.php");
}else{
	header("Location:index.php?msj=Error de autentificaciión");
	echo "Error de autentificaciión";//header("Location:login.php");
}
}catch(Exception $e){
	header("Location:index.php?msj=Error");
	echo "Error";
}
*/
try{
require_once("../modelo/administrador.php");
$usu = $_POST['txtCorreo'];
$pass = $_POST['txtPass'];
$per=new administrador();
$resultado = $per->login($usu, $pass);

$permiso = $resultado[0]["permiso"];

if($permiso == 1){
	session_start();
	$_SESSION['axa']=1;
	header("Location:../controlAdmin.php");
}else{
	header("Location:../adm.html");
}

}catch(Exception $e){
	header("Location:../adm.html");
}
?>