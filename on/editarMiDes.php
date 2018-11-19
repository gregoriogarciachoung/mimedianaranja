<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$des = $rq->txtDesR;

$per=new usuario();
$datos=$per->editar_descripcion(utf8_decode($des),$pass);
?>