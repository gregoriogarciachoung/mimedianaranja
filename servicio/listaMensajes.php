<?php
require_once("../modelo/cargaUsuario.php");
$per=new cargaUsuario();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_misMensajes($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['emisor'] = $dato['emisor'];
	$data[$cont]['foto'] = $dato['foto'];
	$data[$cont]['fecha'] = $dato['fecha'];
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
	$data[$cont]['msj'] = utf8_encode($dato['msj']);
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstMensajes":'.$fjson."}";  

?>
