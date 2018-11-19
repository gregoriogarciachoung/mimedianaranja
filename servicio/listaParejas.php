<?php
require_once("../modelo/cargaUsuario.php");
$per=new cargaUsuario();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_liges($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['edad'] = $dato['edad'];
	$data[$cont]['sexo'] = $dato['sexo'];
	$data[$cont]['fecNac'] = $dato['fecNac'];
	$data[$cont]['altura'] = $dato['altura'];
	$data[$cont]['ocupacion'] = $dato['ocupacion'];
	$data[$cont]['autodes'] = $dato['autodes'];
	$data[$cont]['foto'] = $dato['foto'];
	$data[$cont]['id'] = $dato['id'];
	$data[$cont]['yo'] = $dato['yo'];
	$data[$cont]['mipareja'] = $dato['mipareja'];
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstParejas":'.$fjson."}";  

?>
