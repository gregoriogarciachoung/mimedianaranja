<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];
$query3 = getConexion()->prepare('update filtros set buscoSexo = ?, edadMax = ?, edadMin = ?, alturaMax = ?, alturaMin = ?, idInteres = ? where idUsu = (select id from usuario where mail = ?)');
$query3->execute(array(
$_POST['chks'],
$_POST['eMax'],
$_POST['eMin'],
$_POST['aMax'],
$_POST['aMin'],
$_POST['chkr'],
$pass
));
header("location:mmm.php");
 ?>
