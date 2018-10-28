<?php
include('conexion.php');

session_start();
$pass = $_SESSION['usu'];

$datos = array();
$query = getConexion()->prepare('call ps_consultaMisFiltros(?)');
$query->bindParam(1,$pass);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['sexo'] = $res['Sexo'];
	$datos[$cont]['edadMin'] = $res['EdadMin'];
	$datos[$cont]['edadMax'] = $res['EdadMax'];
	$datos[$cont]['alturaMin'] = $res['alturaMin'];
	$datos[$cont]['alturaMax'] = $res['alturaMax'];
	$datos[$cont]['relacion'] = $res['relacion'];
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstMisFiltros":'.$fjson."}";
?>