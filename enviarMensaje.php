<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$receptor = $rq->txtReceptorR;
$msj = $rq->txtMensajeR;

$query3 = getConexion()->prepare('insert into mensajes(emisor, receptor, fecha, msj) values ((select id from usuario where mail = ?),?,curdate(),?)');
$query3->execute(array(
$pass,
$receptor,
utf8_decode($msj)
));
//header("location:mmm.php");
 ?>
