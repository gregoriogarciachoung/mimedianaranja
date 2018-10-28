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
	
	$datos[$cont]['foto'] = utf8_encode($res['foto']);
	$datos[$cont]['nom'] = utf8_encode($res['nom']);
	$datos[$cont]['edad'] = $res['edad'];
	$datos[$cont]['altura'] = $res['altura'];
	$datos[$cont]['ocu'] = utf8_encode($res['ocu']);
	$datos[$cont]['des'] = utf8_encode($res['des']);
	$datos[$cont]['est'] = utf8_encode($res['est']);
	$datos[$cont]['quebusco'] = utf8_encode($res['quebusco']);
	$datos[$cont]['vivoen'] = utf8_encode($res['vivoen']);
	$datos[$cont]['pasiones'] = utf8_encode($res['pasiones']);
	$datos[$cont]['tmplibres'] = utf8_encode($res['tmplibres']);
	$datos[$cont]['pelis'] = utf8_encode($res['pelis']);
	$datos[$cont]['musi'] = utf8_encode($res['musi']);
	$datos[$cont]['lbrs'] = utf8_encode($res['lbrs']);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstCargaDatosOtroUsuario":'.$fjson."}";
?>