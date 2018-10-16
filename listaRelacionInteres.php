<?php
include('conexion.php');
header("Content-Type: text/html; charset=iso-8859-1"); 
$datos = array();
$query = getConexion()->prepare('select * from interes');
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	$datos[$cont]['id'] = $res['id'];
	$datos[$cont]['nom'] = utf8_encode($res['nom']);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstRelacionInteres":'.$fjson."}";
?>