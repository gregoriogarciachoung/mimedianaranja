<?php
require_once("../modelo/cargaUsuario.php");
require_once("../modelo/cargaOtroUsuario.php");
session_start();
$pass = $_SESSION['usu'];
$per=new cargaUsuario();
$per2=new cargaOtroUsuario();
$filtro=$per->get_filtros($pass);

$a = $filtro[0]['Sexo'];
$b = $filtro[0]['EdadMin'];
$c = $filtro[0]['EdadMax'];
$d = $filtro[0]['alturaMin'];
$e = $filtro[0]['alturaMax'];
$f = $filtro[0]['lugar'];
$g = $filtro[0]['relacion'];
$h = $pass;
/*
echo $a."<br>";
echo $b."<br>";
echo $c."<br>";
echo $d."<br>";
echo $e."<br>";
echo $f."<br>";
echo $g."<br>";
echo $h."<br>";
*/
$datos=$per2->get_usuarios($a,$b,$c,$d,$e,$f,$g,$h);
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
