<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$receptor = $rq->txtReceptorR;
$msj = $rq->txtMensajeR;

$per=new usuario();
$datos=$per->envia_mensaje($pass,$receptor,utf8_decode($msj));

//header("location:mmm.php");
 ?>
