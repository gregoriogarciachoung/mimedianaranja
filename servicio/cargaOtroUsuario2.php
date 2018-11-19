<?php
require_once("../modelo/cargaOtroUsuario.php");
$pass = $_GET['idU'];
$per2=new cargaOtroUsuario();
$datos=$per2->get_usuarios2($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
	$data[$cont]['idUsu'] = $dato['idUsu'];
	$data[$cont]['foto'] = utf8_encode($dato['foto']);
	$data[$cont]['nom'] = utf8_encode($dato['nom']);
	$data[$cont]['edad'] = $dato['edad'];
	$data[$cont]['sexo'] = $dato['sexo'];
	$data[$cont]['altura'] = $dato['altura'];
	$data[$cont]['ocu'] = utf8_encode($dato['ocu']);
	$data[$cont]['des'] = utf8_encode($dato['des']);
	$data[$cont]['est'] = utf8_encode($dato['est']);
	$data[$cont]['quebusco'] = utf8_encode($dato['quebusco']);
	$data[$cont]['vivoen'] = utf8_encode($dato['vivoen']);
	$data[$cont]['pasiones'] = utf8_encode($dato['pasiones']);
	$data[$cont]['tmplibres'] = utf8_encode($dato['tmplibres']);
	$data[$cont]['pelis'] = utf8_encode($dato['pelis']);
	$data[$cont]['musi'] = utf8_encode($dato['musi']);
	$data[$cont]['lbrs'] = utf8_encode($dato['lbrs']);
					$cont++;
            }
$fjson = json_encode($data);
echo '{"lstCargaDatosOtroUsuario":'.$fjson."}";  

?>
