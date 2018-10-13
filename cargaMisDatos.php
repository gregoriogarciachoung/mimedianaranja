<?php
include('conexion.php');

session_start();
$pass = $_SESSION['usu'];

$datos = array();
$query = getConexion()->prepare('call ps_consultaMisDatos(?)');
$query->bindParam(1,$pass);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['nom'] = $res['nom'];
	$datos[$cont]['ocu'] = $res['ocu'];
	$datos[$cont]['des'] = $res['des'];
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstMisDatos":'.$fjson."}";
?>