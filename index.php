<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html lang="esS" >
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- 

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.js"></script>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrapValidator.css"/>

 -->
<title>Mi Media Naranja</title>
</head>
<body class="regBody">
<header>
<h1>Mi Media Naranja</h1>
<nav>
<ul>
<li id="reg">REG�STRATE
<li id="log">INGRESE AQU�</a>
</ul>
</nav>
</header>
<main>
<section>
<h3>Busca y encuentra tu pareja aqu�</h3>
<p>Si lo que buscas es una relaci�n sincera,
est�s en el lugar correcto: m�s de 90% 
de nuestros usuarios solteros 
buscan una relaci�n duradera</p>
</section>
</main>
<section class="regS1">
<p class="cerrar" id="cerrar">x</p>
<form id="freg" action="on/vreg.php" method="post">
<h4>No publicaremos nada en tu muro y tu informaci�n es privada</h4>
<input type="email" name="usu" placeholder="Ingresa tu correo" id="txtUsu" required>
<button type="submit"  id="btnRegistrar">Registrar</button>
<span id="msj2"></span>
<div class="ella"><input type="checkbox" required>Acepto los t�rminos y condiciones del portal</div>
</form>
<form  action="on/login.php" id="flog" method="post">
<h4>Iniciar sesi�n para chatear con sus contactos</h4>
<input type="email" name="usu" placeholder="Correo electr�nico" required>
<input type="password" name="pass" placeholder="Contrase�a" required>
<input type="submit" value="INICIAR SESI�N" id="flog"/>
<span id="msj1"></span>
<!--<a class="ella" href="#">Olvid� mi clave</a>-->
</form>
</section>
</body>
<style>
* {
margin: 0px;
padding: 0px;
font: menu; font-size: 15px;
}
html {
background:#ca213f;
  background-image: url(image/fondoinicio.jpg) repeat center center;
}
.regBody{
}
.regBody header{
width:calc(100% - 3.6em);
height:99px;
display:flex;
justify-content:space-between;
padding:1.8em;
color:#fff;
}
.regBody nav ul{
display:flex;
}
.regBody nav li{
list-style: none;
border-radius:6px;
margin:0.3em;
}
.regBody nav li:nth-child(1){
background:#000;
padding:0.6em;
}
.regBody  nav li:nth-child(2){
padding:0.6em;
border:1px #fff solid;
}
.regBody main{
width:490px;
margin: 0 auto;
text-align:center;
color:#fff;
}
.regBody main p{
margin-top:9px;
font-size:27px;
}
.regS1{
width:100%;
height:100%;
/*background: rgba(0,0,0,0.6);  */
background:#e6e6e6;
position:fixed;
top:0; 
left:0;
display: flex;
min-height: 100vh;
}
.regBody .regS1 form{
display:flex;
flex-direction:column;
align-items: center;
margin:auto;
}
.regBody .regS1 form input[type="text"],
.regBody .regS1 form input[type="email"],
.regBody .regS1 form input[type="password"]{
border-radius:9px;
padding:0.6em;
width:390px;
border:1px solid #ccc;
margin-top:2em;
}
.regBody .regS1 form input[type="submit"],
.regBody .regS1 form button{
border-radius:9px;
padding:0.6em;

border:1px solid #ccc;
margin-top:2em;
}
.ella{
display:inline;
padding-top:2em;
}
.regBody .regS1 >.cerrar{
font-size:30px;
}
span{color:red}
</style>
<script>

$(document).ready(function(){
	
	$("#btnRegistrar").click(function(){
		
		var usu = $("#txtUsu").val();
		
		if(usu == ""){
			
		}else{
			$("#freg").submit();
		}
		
	});
	
	
});

$(document).ready(function(){
	$(".regS1 ").hide();
	$("#cerrar").click(function(){
        $(".regS1").hide();
    });
	$("#log").click(function(){
		$(".regS1 ").show();
        $("#flog").show();
		$("#freg").hide();
    });
	$("#reg").click(function(){
		$(".regS1 ").show();
        $("#flog").hide();
		$("#freg").show();
    });
});
</script>
<script>
var query = window.location.search.substring(1);
       // var vars = query.split("&");
        var vars2 = query.split("=");
		var mensaje = vars2[1].replace(/_/g," ");
		
		if(query == ""){
			 document.getElementById("msj1").innerHTML ="";
		}else{
			if(vars2[0] == "existe"){
				document.getElementById("flog").style.display="none";
				document.getElementById("msj2").innerHTML = mensaje;
				alert(mensaje);
			}
			if(vars2[0] == "msj"){
				document.getElementById("freg").style.display="none";
				document.getElementById("msj1").innerHTML = mensaje;
				alert(mensaje);
			}
			 
		}
</script>
</html>




