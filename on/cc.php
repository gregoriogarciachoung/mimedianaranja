<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
$ms1;
try{
	$per=new usuario();
	if($_POST['pass2'] == $_POST['pass3']){
		$resultado = $per->editar_pass($pass, $_POST['pass1'], $_POST['pass2']);
		foreach ($resultado as $dato) {
			echo $dato['resultado'];
			if($dato['resultado']== '1'){
				$msj1 = "Procesado";
				echo "Procesado";
			}else{
				$msj1 = "Error";
				echo "Error";
			}
		}	
	}
	else{
		$msj1 = "Error";
		echo "Error";
	}
}catch(Exception $e){
	echo "Error";
}finally{
	header("location:../miperfil.php?msj1=".$msj1);	
}
 ?>
