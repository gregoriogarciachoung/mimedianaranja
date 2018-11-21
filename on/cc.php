<?php
require_once("../modelo/usuario.php");
session_start();
$pass = $_SESSION['usu'];
try{
	$per=new usuario();
	if($_POST['pass2'] == $_POST['pass3']){
		$resultado = $per->editar_pass($pass, $_POST['pass1'], $_POST['pass2']);
		foreach ($resultado as $dato) {
			echo $dato['resultado'];
			if($dato['resultado']== '1'){
				echo "Procesado";
			}else{
				echo "Error";
			}
		}	
	}
	else{
		echo "Error";
	}
}catch(Exception $e){
	echo "Error";
}finally{
	header("location:../miperfil.php");	
}
 ?>
