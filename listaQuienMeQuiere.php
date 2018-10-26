<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];
$datos = array();
$query = getConexion()->prepare('call sp_listaQuienMeQuiere(?)');
$query->bindParam(1,$pass);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['id'] = $res['id'];
	$datos[$cont]['yo'] = $res['yo'];
	$datos[$cont]['mipareja'] = $res['mipareja'];
	$datos[$cont]['nom'] = utf8_encode($res['nom']);
	//echo json_encode($res);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstQuienMeQuiere":'.$fjson."}";
?>