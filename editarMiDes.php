<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];

$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$des = $rq->txtDesR;

$query3 = getConexion()->prepare('update usuarioDatos set autodes = ? where idUsu = (select id from usuario where mail = ?)');
$query3->execute(array(
utf8_decode($des),
$pass
));
?>