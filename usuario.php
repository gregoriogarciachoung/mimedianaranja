<?php
include('conexion.php');
    //session_start();
	//$pass = $_SESSION['usu'];
	$pass = 'nina@gmail.com';
	$query2 = getConexion()->prepare('call ps_consultaMisFiltros(?)');
	$query2->bindParam(1,$pass);
	$query2->execute();

	$mf = $query2->fetch(PDO::FETCH_ASSOC);
    echo $mf['Sexo'];
?>
