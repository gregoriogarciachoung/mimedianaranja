<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
$per=new usuario();
$datos=$per->me_gusta($pass
$pass,
$_POST['idMiPareja']
);
header("location:../mmm.php");
 ?>
