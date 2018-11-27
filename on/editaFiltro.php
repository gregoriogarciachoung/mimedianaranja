<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
$per=new usuario();
$datos=$per->set_filtros(
$_POST['chks'],
$_POST['eMax'],
$_POST['eMin'],
$_POST['aMax'],
$_POST['aMin'],
$_POST['chkr'],
$_POST['distrito'],
$pass
);
header("location:../mmm.php");
 ?>
