<?php
include('conexion.php');
/*
$pd = file_get_contents("php://input");
$rq = json_decode($pd);
$pass = $rq->idU;
*/
$pass = $_GET['idU'];
//$pass = 1;

$datos = array();
$query = getConexion()->prepare('call sp_cargaOtroUsuario(?)');
$query->bindParam(1,$pass);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['nom'] = $res['nom'];
	$datos[$cont]['ocu'] = $res['ocu'];
	$datos[$cont]['des'] = $res['des'];
	$datos[$cont]['est'] = $res['est'];
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstCargaDatosOtroUsuario":'.$fjson."}";
?>