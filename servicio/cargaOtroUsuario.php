<?php
require_once("../modelo/cargaUsuario.php");
require_once("../modelo/cargaOtroUsuario.php");
session_start();
$pass = $_SESSION['usu'];
$per=new cargaUsuario();
$per2=new cargaOtroUsuario();
$filtro=$per->get_filtros($pass);
$datos=$per2->get_usuarios($filtro[0]['Sexo'],$filtro[0]['EdadMin'],$filtro[0]['EdadMax'],$filtro[0]['alturaMin'],$filtro[0]['alturaMax'],$filtro[0]['relacion'],$pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
						$data[$cont]['id'] = $dato['id'];
						$data[$cont]['foto'] = $dato['foto'];
						$data[$cont]['nom'] = utf8_encode($dato['Nombre']);
						$data[$cont]['edad'] = $dato['Edad'];
						$data[$cont]['ocu'] = utf8_encode($dato['Ocupacion']);
					$cont++;
            }
$fjson = json_encode($data);
echo '{"lstOtroUsuario":'.$fjson."}";  

?>
