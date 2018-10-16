<?php
include('conexion.php');

session_start();
$pass = $_SESSION['usu'];
//$pass = 'nina@gmail.com';
$datos = array();
$query = getConexion()->prepare('call ps_listaRespuestaIntereses(?)');
$query->bindParam(1,$pass);

$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['pre'] = utf8_encode($res['pre']);
	$datos[$cont]['res'] = utf8_encode($res['res']);
	//echo json_encode($res);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstMisOtrosIntereses":'.$fjson."}";
?>