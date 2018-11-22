<?php
session_start();
if ($_SESSION['axr']!="1"){
header("location:index.php");
}
?>
<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html lang="esS" >
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/angular.min.js"></script>
<!-- 
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.js"></script>
<script type="text/javascript" src="js/angular.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrapValidator.css"/>
 -->
<title>Mi Media Naranja</title>
</head>
<body ng-app="goyo" ng-controller="frmRegistro" >

	<form action="on/registrar.php" id="id_form" name="mimi" enctype="multipart/form-data" method="post">
	 
	 <!-- sera un gusto conocerte -->
	 <div>
	 <h3>Sera un gusto conocerte</h3>
	 <h4>Estos datos nos ayudarán a darte sugerencia de solteros interesentes para ti</h4>
	 <h5>Mi nombre</h5>
	<input type="text" name="nom" placeholder="Mi nombre" id="txtNom"/>
	<span id="mtxtNom"></span>
	
	<h5>Soy</h5>
	<nav ng-init="listaSexo()">
		<ul ng-repeat="x in sexos">
			<li ng-if="x.id == 1"><input type="radio"checked="checked" name="sexos" value="{{x.id}}"/> {{x.nom}}
			<li ng-if="x.id != 1"><input type="radio"  name="sexos" value="{{x.id}}"/> {{x.nom}}
		</ul>
	</nav>
	
	<h5>Fecha de nacimiento</h5>
	 <input type="date" name="fecNac"  id="txtFecha"/>
	 <span id="mtxtFecha"></span>
	 </div>
	
	  <div ng-init="listaDistrito()">
	 <!-- conoce solteros cerca de ti -->
	  <h3>Conoce solteros cerca de ti</h3>
	 <h4>Te recomendamos personas según la ubicación que elijas</h4>
	 <h5>¿En que distrito vives?</h5>
	
	 <!-- combo distrito -->
	 <!-- hacer sql dentro de jsp jslt(creo que así se llama)--> 
	 <!-- <input list="distritos" class="listadistrito" name="distrito" id="txtDistrito"/>
	  <datalist id="distritos" ng-repeat="x in dist">
		<option value="{{x.nom}}">
	  </datalist> -->
	  <select name="distrito">
	<option  ng-repeat="x in datos" value="{{x.id}}">{{x.nom}}
	</select>
	<span id="mtxtDistrito"></span>
	 </div>
	 
	 <!-- personaliza tu perfil -->
	 <div>
	 <h3>Conoce solteros cerca de ti</h3>
	 <h4>Te recomendamos personas según la ubicación que elijas</h4>
	 <h5>Tengo hijos</h5>
	 
	<input name="hijos" type="radio" checked="checked" value="1" value="{{x.id}}"/>Si
	<input name="hijos" type="radio" value="2" value="{{x.id}}"/>No
	 
	 <!-- radiobutton de estado civl -->
	 <h5>Estado civl</h5>
	<nav ng-init="listaEstado()">
		<ul ng-repeat="x in estados">
			<li ng-if="x.id == 1"><input type="radio"checked="checked" name="estCivil" value="{{x.id}}"/> {{x.nom}}
			<li ng-if="x.id != 1"><input type="radio"  name="estCivil" value="{{x.id}}"/> {{x.nom}}
		</ul>
	</nav>	 
	 <h5>Máximo nivel alcanzado</h5>
	 <!-- radiobutton -->
	<nav ng-init="listaEducacion()">
		<ul ng-repeat="x in edus">
			<li ng-if="x.id == 1"><input type="radio"checked="checked" name="nivelA" value="{{x.id}}"/> {{x.nom}}
			<li ng-if="x.id != 1"><input type="radio"  name="nivelA" value="{{x.id}}"/> {{x.nom}}
		</ul>
	</nav>	
	 
	 <h5>Mi altura (cm)</h5>
	 <!-- comobox con una lista de numeros -->
	 <!-- 
	 <s:combobox label="Mi altura (cm)" 
		headerKey="-1" headerValue="--- Select ---"
		list="{160,170,180,190,200}" 
		name="miAltura" />
	  -->
	  
<input type="number" name="miAltura" id="txtAltura"/>
<span id="mtxtAltura"></span>
	 
	<h5>Mi ocupación</h5>
	 <input type="text" placeholder="Completar" name="ocu" id="txtOcu"/>
	 <span id="mtxtOcu"></span>
	</div>
	<div>
	<!--  -->
	<h3>Elige el tipo de relación que desea encontrar</h3>
	 <h4>Se encontrará con personas que buscan lo mismo</h4>
	 <h5>Tipo de relación</h5>
	
	<nav ng-init="listaRelacionInteres()">
		<ul ng-repeat="x in relaciones">
			<li ng-if="x.id == 1"><input type="radio"checked="checked" name="rela" value="{{x.id}}"/> {{x.nom}}
			<li ng-if="x.id != 1"><input type="radio"  name="rela" value="{{x.id}}"/> {{x.nom}}
		</ul>
	</nav>	
	</div>
	
	<div>
	<!--  -->
	<h3>Selecciona una fota</h3>
	 <h4>La primera impresión es importante</h4>
	 <h5>Foto</h5>
	
	<input id="imagen" name="imagen" size="30" type="file" />
	</div>
	
	<div>
	<!-- ¡Falta poco! -->
	<h3>¡Falta Poco!</h3>
	 <h4>Con los siguientes datos podrás acceder a tu cuenta de OH!</h4>
	 <h5>Mi correo</h5>
	<input type="email" placeholder="Correo" name="correo" value= "<?php $cor = $_SESSION['axu']; echo $cor; ?>"/>
	<h5>Crea contraseña</h5>
	<input type="password" placeholder="contraseña" name="clave" id="txtPass" required/>
	<span id="mtxtPass"></span>
	<h5>Repite contraseña</h5>
	<input type="password" placeholder="confirma contraseña" name="confirmaClave" id="txtPass2" required/>
	<span id="mtxtPass2"></span>
	
	</div>
	
	<button type="submit" id="btnEnviar">Enviar</button>
	<button type="button" id="btnNext">Continuar</button>
	</form>

</body>
<style>
*{font:menu;}
form{
display:flex;
flex-direction:column;
align-items: center;
}
h3, h4{
text-align: center;
}
form{
width:600px;
margin: 0 auto;
}
input, button, select{
padding: 1em;
}
button{
margin-top: 2em;
}
input[type="date"],input[type="text"],input[type="password"], select,input[type="file"],input[type="number"], .listadistrito{
width:600px;
}
input[type="email"]{
	padding:0;
	border:0;
}
form>div>nav>ul{
	padding:0;
}
form>div>nav>ul>li{
	list-style:none;
}
span{color:red}
</style>
<script>
var ellanomehacecaso = angular.module('goyo', []);
</script>
<script>
var size = document.querySelectorAll("form > div").length;
function ocultar(){
	for(var i = 0; i<size; i++){
		$("form >  div:eq("+i+")").hide();
	}
}
$(document).ready(function(){
ocultar();
$("#btnEnviar").hide();
$("form >  div:eq(0)").show();
	var cont = 0;
	$("#txtNom").keyup(function(){
         $("#mtxtNom").text("");
    });
	$("#txtFecha").keyup(function(){
         $("#mtxtFecha").text("");
    });
	$("#txtDistrito").keyup(function(){
         $("#mtxtDistrito").text("");
    });
	$("#txtDistrito").keyup(function(){
         $("#mtxtDistrito").text("");
    });
	$("#txtAltura").keyup(function(){
         $("#mtxtAltura").text("");
    });
	$("#txtOcu").keyup(function(){
         $("#mtxtOcu").text("");
    });
	$("#btnNext").click(function(){
		
		var txtNom = $("#txtNom").val();
		var txtFecha = $("#txtFecha").val();
		var txtDistrito = $("#txtDistrito").val();
		var txtAltura = $("#txtAltura").val();
		var txtOcu = $("#txtOcu").val();
		
		if(cont == 0 && txtNom == ""){
			 $("#mtxtNom").text("Error en dato.");
		}
		else if(cont == 0 && txtFecha == ""){
			 $("#mtxtFecha").text("Error en dato.");
		}
		else if(cont == 1 && txtDistrito == ""){
			 $("#mtxtDistrito").text("Error en dato.");
		}
		else if(cont == 2 && txtAltura == "" || parseInt(txtAltura) < 150){
			 $("#mtxtAltura").text("Error en dato.");
		}
		else if(cont == 2 && txtOcu == ""){
			 $("#mtxtOcu").text("Error en dato.");
		}
		
		else{
			cont = cont + 1;
		ocultar();
		$("form >  div:eq("+cont+")").show();
		
		if(cont == size-1){
		$("#btnEnviar").show();
		$("#btnNext").hide();
		}
	}
	});
});

function iniciar(){
 nombre1=document.getElementById("txtPass");
 nombre2=document.getElementById("txtPass2");
 nombre1.addEventListener("input", validacion, false);
 nombre2.addEventListener("input", validacion, false);
 validacion();
 }
 function validacion(){
 if(nombre1.value!=nombre2.value){
 nombre2.setCustomValidity('Contraseña no coincide con la anterior');
 }else{
 nombre2.setCustomValidity('');
 }
 }
 window.addEventListener("load", iniciar, false);
</script>
<script type="text/javascript" src="js/registrolst.js"></script>
</html>