<?php
require_once("../modelo/cargaUsuario.php");
session_start();
$pass = $_SESSION['usu'];
$per=new cargaUsuario();
$datos=$per->get_datos($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
	$data[$cont]['edad'] = $dato['edad'];
	$data[$cont]['ocu'] = utf8_encode($dato['ocu']);
	$data[$cont]['des'] = utf8_encode($dato['des']);
	$data[$cont]['foto'] = utf8_encode($dato['foto']);
	$data[$cont]['nomdis'] = utf8_encode($dato['nomdis']);
	$data[$cont]['hijos'] = $dato['hijos'];
	$data[$cont]['altura'] = $dato['altura'];
	$data[$cont]['estado'] = $dato['estado'];
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstMisDatos":'.$fjson."}";  

?>
