<?php
require_once("../modelo/cargaUsuario.php");
$per=new cargaUsuario();
session_start();
$pass = $_SESSION['usu'];
$datos=$per->get_filtros($pass);
$data = array();
$cont = 0;
            foreach ($datos as $dato) {
					$data[$cont]['sexo'] = $dato['Sexo'];
					$data[$cont]['edadMax'] = $dato['EdadMax'];
					$data[$cont]['edadMin'] = $dato['EdadMin'];
					$data[$cont]['alturaMax'] = $dato['alturaMax'];
					$data[$cont]['alturaMin'] = $dato['alturaMin'];
					$data[$cont]['relacion'] = $dato['relacion'];
					$cont++;
              //  echo $dato["nom"]."<br/>";
            }
$fjson = json_encode($data);
echo '{"lstMisFiltros":'.$fjson."}";  

?>
