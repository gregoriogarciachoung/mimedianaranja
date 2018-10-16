<?php

include('conexion.php');

// obtiene filtros del usuario que acaba de ingresar
session_start();
$pass = $_SESSION['usu'];
//echo $pass;
//$pass = 'nina@gmail.com';
$query2 = getConexion()->prepare('call ps_consultaMisFiltros(?)');
$query2->bindParam(1,$pass);
$query2->execute();

$mf = $query2->fetch(PDO::FETCH_ASSOC);
$mf1 = $mf['Sexo'];
$mf2 = $mf['EdadMin'];
$mf3 = $mf['EdadMax'];
$mf4 = $mf['relacion'];
/*$mf1 = 1;
$mf2 = 15;
$mf3 = 21;*/
//echo $mf1 ." ". $mf2." ".$mf3;

// listaOtroUsuario en json
$datos = array();
$query = getConexion()->prepare('call ps_buscaOtroUsuario(?,?,?,?)');
$query->bindParam(1,$mf1);
$query->bindParam(2,$mf2);
$query->bindParam(3,$mf3);
$query->bindParam(4,$mf4);
$cont = 0;
$query->execute();
while($res = $query->fetch(PDO::FETCH_ASSOC)){
	
	$datos[$cont]['id'] = $res['id'];
	$datos[$cont]['nom'] = utf8_encode($res['Nombre']);
	$datos[$cont]['edad'] = $res['Edad'];
	$datos[$cont]['ocu'] = utf8_encode($res['Ocupacion']);
	//echo json_encode($res);
$cont++;
}

$fjson = json_encode($datos);
echo '{"lstOtroUsuario":'.$fjson."}";
?>