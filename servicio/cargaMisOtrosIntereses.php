<?php
require_once("../modelo/cargaUsuario.php");
$per=new cargaUsuario();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_otrosIntereses($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['idPre'] = utf8_encode($dato['idPre']);
	$data[$cont]['pre'] = utf8_encode($dato['pre']);
	$data[$cont]['res'] = utf8_encode($dato['res']);
					$cont++;
            }
$fjson = json_encode($data);
echo '{"lstMisOtrosIntereses":'.$fjson."}";
?>