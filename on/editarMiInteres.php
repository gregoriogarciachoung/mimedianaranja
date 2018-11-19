<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$res = $rq->txtInteresR;
$pre = $rq->preR;

$per=new usuario();
$datos=$per->editar_interes(
$pass,
$pre,
utf8_decode($res)
);
?>