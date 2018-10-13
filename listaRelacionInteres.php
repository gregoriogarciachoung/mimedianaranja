<?php
include('conexion.php');

$datos = array();
$query = getConexion()->prepare('select * from interes');
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	$datos[$cont]['id'] = $res['id'];
	$datos[$cont]['nom'] = $res['nom'];
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstRelacionInteres":'.$fjson."}";
?>