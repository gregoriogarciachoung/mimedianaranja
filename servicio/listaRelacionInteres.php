<?php
require_once("../modelo/datosAplicacion.php");
$per=new datosAplicacion();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_relaciones($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['id'] = $dato['id'];
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstRelacionInteres":'.$fjson."}";  

?>
