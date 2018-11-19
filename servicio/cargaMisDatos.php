<?php
require_once("../modelo/cargaUsuario.php");
$per=new cargaUsuario();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_datos($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
	$data[$cont]['ocu'] = utf8_encode($dato['ocu']);
	$data[$cont]['des'] = utf8_encode($dato['des']);
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstMisDatos":'.$fjson."}";  

?>
