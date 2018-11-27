<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$des = $rq->txtOcuR;

$per=new usuario();
$datos=$per->editar_distrito(utf8_decode($des),$pass);
?>