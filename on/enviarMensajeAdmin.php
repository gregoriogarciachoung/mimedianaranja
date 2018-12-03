<?php
require_once("../modelo/administrador.php");

session_start();
$pass = $_SESSION['usu'];
$adm = 'goyo@gmail.com';
$msj = $_POST['txtReporte'];
//echo $msj." ".$pass." ".$adm;

$per=new administrador();
$per->envia_mensaje($adm,$pass,utf8_decode($msj));

header("location:../miPerfil.php");
 ?>
