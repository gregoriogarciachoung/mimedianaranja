<?php
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
	header("Location:mmm.php");
}else{
	header("Location:index.html");
}
?>