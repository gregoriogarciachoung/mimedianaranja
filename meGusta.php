<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];
$query3 = getConexion()->prepare('call sp_meGusta(?,?)');
$query3->execute(array(
$pass,
$_POST['idMiPareja']
));
header("location:mmm.php");
 ?>
