<?php
try{
session_start();
$_SESSION['axr']=1;
header("Location:../registro.php");
}catch(Exception $e){
	header("Location:../index.php");
	echo "Error";
}
?>