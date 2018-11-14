<?php
include('conexion.php');
session_start();
$pass = $_SESSION['usu'];
$datos = array();
$query = getConexion()->prepare('select * from mensajes m join usuarioDatos ud on m.emisor = ud.idUsu where m.receptor = (select id from usuario where mail = ?) order by m.fecha, m.id desc');
$query->bindParam(1,$pass);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	$datos[$cont]['emisor'] = $res['emisor'];
	$datos[$cont]['foto'] = $res['foto'];
	$datos[$cont]['fecha'] = $res['fecha'];
	$datos[$cont]['nom'] = utf8_encode($res['nom']);
	$datos[$cont]['msj'] = utf8_encode($res['msj']);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstMensajes":'.$fjson."}";
?>