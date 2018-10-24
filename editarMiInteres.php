<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$res = $rq->txtInteresR;
$pre = $rq->preR;

$query3 = getConexion()->prepare('call ps_editarResOtrosIntereses(?,?,?)');
$query3->execute(array(
$pass,
$pre,
utf8_decode($res)
));
?>