<?php
require_once("../modelo/administrador.php");
$per=new administrador();

$datos=$per->lista_mensaje();
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['id'] = $dato['id'];
	$data[$cont]['idAdmin'] = $dato['idAdmin'];
	$data[$cont]['idUsu'] = $dato['idUsu'];
	$data[$cont]['fecha'] = $dato['fecha'];
	$data[$cont]['msj'] = utf8_encode($dato['msj']);
	$data[$cont]['correo'] = utf8_encode($dato['correo']);
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstMensajesAdmin":'.$fjson."}";  

?>
