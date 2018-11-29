<?php
// Recibo los datos de la imagen
$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];

$usuario = $_POST['correo']."/";
$directorio = $_SERVER['DOCUMENT_ROOT'].'/mimedianaranja/images/';
$subeaca = $directorio.$usuario; 

	  echo $nombre_img."<br>";
	  echo $tipo."<br>";
	  echo $tamano."<br>";
	  echo $usuario."<br>";
	  echo $directorio."<br>";
	  echo $subeaca."<br>";
//Si existe imagen y tiene un tamaño correcto
if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) 
{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      // Ruta donde se guardarán las imágenes que subamos

	  mkdir($directorio.$usuario, 0777, true);
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
	  
      move_uploaded_file($_FILES['imagen']['tmp_name'],$subeaca.$nombre_img);
    } 
    else 
    {
       //si no cumple con el formato
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   //si existe la variable pero se pasa del tamaño permitido
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
}

require_once("../modelo/usuario.php");
$per=new usuario();
$datos=$per->registrar(
$_POST['nom'],
$_POST['correo'],
$_POST['clave'],
$_POST['sexos'],
$_POST['fecNac'],
$_POST['distrito'],
$_POST['hijos'],
$_POST['estCivil'],
$_POST['nivelA'],
$_POST['miAltura'],
$_POST['ocu'],
$_POST['rela'],
'images/'.$usuario.'/'.$nombre_img
);
echo $_POST['nom'];"<br>";
echo $_POST['correo'];"<br>";
echo $_POST['clave'];"<br>";
echo $_POST['sexos'];"<br>";
echo $_POST['fecNac'];"<br>";
echo $_POST['distrito'];"<br>";
echo $_POST['hijos'];"<br>";
echo $_POST['estCivil'];"<br>";
echo $_POST['nivelA'];"<br>";
echo $_POST['miAltura'];"<br>";
echo $_POST['ocu'];"<br>";
echo $_POST['rela'];"<br>";
echo 'images/'.$usuario.'/'.$nombre_img;
//header("location:../index.php");
//-------------------------------------------------
try{
require_once("../modelo/usuario.php");
$usu = $_POST['correo'];
$pass = $_POST['clave'];
$per=new usuario();
$resultado = $per->login($usu, $pass);

		foreach ($resultado as $dato) {
			echo $dato['id'];
			if($dato['id']== '1'){
				session_start();
				$_SESSION['ax']=1;
				$_SESSION['usu']=$usu;
				header("Location:../mmm.php");
			}else{
			//	header("Location:../index.php?msj=".utf8_encode("Error_usuario_o_clave"));
			}
		}
}catch(Exception $e){
	//header("Location:../index.php?msj=Error");
}

?>