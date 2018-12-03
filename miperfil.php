<?php
session_start();
if ($_SESSION['ax']!="1"){
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
<link rel="stylesheet" href="css/mmmstruc.css"/>
<link rel="stylesheet" href="css/mmmali.css"/>
<link rel="stylesheet" href="css/mmmboni.css"/>
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
<body  ng-app="goyo" ng-controller="mehizoclick">

<form action="on/sesion.php" method="post" id="frmSalir">
</form>

<header>
	<hgroup>
		<h1>OH!</h1>
	</hgroup>
	<section ng-controller="ella" ng-init="listaMisDatos()">
		<nav>
			<ul>
				<li ng-click="mostrarFiltros()">Filtro
				<li  ng-repeat="x in datos"><a target="_blank" href="chat.php?usuario={{x.nom}}">Chat</a>
				<li ng-click="cerrarSesion()">Salir
			</ul>
		</nav>
		<div>
			<li style="list-style:none" ng-repeat="x in datos">{{x.nom}}
		</div>
	</section>
</header>
<main>
	<aside>
		<nav>
			<ul>
				<li><a href="mmm.php">Sugeridos<!-- <li ng-click="cargarSugeridos()">Sugeridos -->
				<li><a href="invitaciones.php">Invitaciones</a>
				<li><a href="mensajes.php">Mensajes</a>
				<li>Mi Perfil
			</ul>
		</nav>
	</aside>

	<!-- Sugeridos -->
	<section>
	<h2>Sugeridos</h2>
	<section class="momo" id="usuModal"></section>
	</section>

	<!-- Invitaciones -->
	<section id="invi">
	<section class="momo" id="usuModal2"></section>
	</section>
	<!-- Mensajes -->
	<section>
	</section>
	<!-- Mi perfil -->
	<section ng-controller="ella" id="id_perfil">
	
	<h2>Mi perfil</h2>
	
		<div ng-controller="ella" ng-init="listaMisDatos()" style="text-align:center">
		<div ng-repeat="x in datos">
			<img class="fotoperfil" src="{{x.foto}}"/>
			<p>{{x.nom}} ({{x.edad}})</p>
		</div>
	</div>
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aquí los datos y filtros con lo que otras personas podrán conocerte en OH!</h2>
		</div>
		<h2 class="t2">Datos Básicos</h2>
		<div ng-controller="ella" ng-init="listaMisDatos()">
			<div class="marcotres" ng-repeat="x in datos">
			<p>Autodescripción</p>
			<!-- <input type="text" value="{{x.des}}" id="txtDes" placeholder="Escribe aquí"/> -->
			<textarea id="txtDes" name="txtDes" placeholder="Escribe aquí" maxlength="250">{{x.des}}</textarea>
			<h3 ng-click="editarMiDes()"><a href="#" onclick="return false;">GRABAR</a></h3>
			<p>Ocupación</p>
			<input type="text" value="{{x.ocu}}" name="txtOcu" id="txtOcu" placeholder="Escribe aquí"/>
			<h3 ng-click="editarMiOcu()"><a href="#" onclick="return false;">GRABAR</a></h3>
			
			<p>Distrito</p>
			<div ng-init="listaDistrito()" id="txtdisdiv">		
				<input  list="testList" type="text" placeholder="Escribe distrito (solo lima)" name="distrito" id="txtdis2" value="{{x.nomdis}}"/>
    <datalist id="testList">
        <option ng-repeat="d in distri" value="{{d.nom}}">
    </datalist>
				
				</div>
			<h3 ng-click="editarMiDistrito()"><a href="#" onclick="return false;">GRABAR</a></h3>
		<p>Altura (cm)</p>
			<input type="number" name="txtAlt" id="txtAlt" placeholder="Escribe aquí" value="{{x.altura}}"/>
			<h3 ng-click="editarMiAltura()"><a href="#" onclick="return false;">GRABAR</a></h3>
			</div>
		</div>
		<h2 class="t2">Mis Intereses</h2>
		<div  ng-init="listaMisOtrosIntereses()">
			<div ng-repeat="x in datos" class="marcodos" id="tampocomehacecaso">
			<p>{{x.pre}}</p>
			<!--<input type="text" value="{{x.res}}" id="txtInteres" placeholder="Escribe aquí"/>-->
			<textarea type="text" id="txtInteres" placeholder="Escribe aquí" maxlength="250">{{x.res}}</textarea>
			<h3 ng-click="editarMiInteres(x.idPre)"><a href="#" onclick="return false;">GRABAR</a></h3>
			</div>
		</div>
		<div class="t1" id="tampocomehacecaso">
		<h1>Configuración</h1>
		<h2>Cambia contraseña o bloquea u desbloquea tu cuenta</h2>
		</div>
		<h2 class="t2 configcuenta">Seguridad</h2>
		<div ng-controller="ella" ng-init="listaMisDatos()">
			<div class="marcotres">
			<form  action="on/cc.php" method="post">
			<p>Actual contraseña</p>
			<input type="password" placeholder="Actual contraseña" name="pass1" id="txtpass1" required/>
			<p>Nueva contraseña</p>
			<input type="password"  placeholder="Nueva contraseña" name="pass2" id="txtPass2" required/>
			<p>Repite contraseña</p>
			<input type="password"  placeholder="Repite contraseña" name="pass3" id="txtPass3" required/>
			<button type="submit"  id="btnCambioC">Enviar</button>
			<span id="msj1"></span>
			</form>
			</div>
			<div class="marcotres">
			<form action="on/bloqueo.php" method="post">
			<p>No aparecerás en la lista de sugeridos de otros usuarios.</p>

			<div ng-init="listaMisDatos()">
			<ul ng-repeat="y in datos">
			<li ng-if="1 == y.estado"><input type="radio"checked="checked" name="chkblo" value="1"/> Desbloquear
			<li ng-if="0 != y.estado"><input type="radio" name="chkblo" value="0"/> Bloquear
			
			<li ng-if="1 != y.estado"><input type="radio" name="chkblo" value="1"/> Desbloquear
			<li ng-if="0 == y.estado"><input type="radio" checked="checked" name="chkblo" value="0"/> Bloquear
			</ul>

		</div>
			
			<button type="submit"  id="btnCambioB">Enviar</button>
			<span id="msj2"></span>
			</form>
			</div>
		</div>
		<h2 class="t2">Reporta a otro usuario</h2>
		<div class="marcodos">
		<p>Escribe el correo del usuario a reportar y un mensaje del porque</p>
		<form action="on/reportaUsu.php" action="post">
			<textarea id="txtReporte" name="txtReporte" placeholder="Escribe aquí" maxlength="250"></textarea>
			<button type="submit">Enviar</button>
			</form>
			</div>
	</section>
</main>
<section ng-controller="ella" ng-init="listaMisFiltros()" id="id_filtroModal" class="momo">
		<form action="on/editaFiltro.php" method="post" id="myF">
		<div ng-repeat="x in datos">
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aquí los filtros de las personas soletras que conocerás y te podrán conocer en OH!</h2>
		</div>
		<h3>Tipo de relación</h3>
		<div ng-init="listaRelacionInteres2()">
			<ul ng-repeat="y in adatos">
			<li ng-if="x.relacion == y.id"><input type="radio"checked="checked" name="chkr" value="{{y.id}}"/> {{y.nom}}
			<li ng-if="x.relacion != y.id"><input type="radio" name="chkr" value="{{y.id}}"/> {{y.nom}}
			</ul>

		</div>
		<h3>Busco</h3>
			<div ng-init="listaSexo2()">
				<ul ng-repeat="s in sexos">
					<li ng-if="x.sexo == s.id"><input type="radio"checked="checked" name="chks" value="{{s.id}}"/> {{s.nom}}
					<li ng-if="x.sexo != s.id"><input type="radio"  name="chks" value="{{s.id}}"/> {{s.nom}}
				</ul>
			</div>
			<h3>Que tenga entre</h3>
			<div><input type="number" value="{{x.edadMin}}" name="eMin" id="eMin"  placeholder="Edad mínima" required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.edadMax}}" name="eMax" id="eMax"  placeholder="Edad máxima" required/></div>
			
			<h3>Que mida(cm) entre</h3>
			<div><input type="number" value="{{x.alturaMin}}" name="aMin" id="aMin"  placeholder="Altura mínima" required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.alturaMax}}" name="aMax" id="aMax"  placeholder="Altura máxima" required/></div>
			<div ng-init="listaDistrito()">		
			Busca en:	<input  list="testList" type="text" name="distrito" id="txtdis" value="{{x.nomdis}}" placeholder="Distrito de lima" required/>
    <datalist id="testList">
        <option ng-repeat="d in distri" value="{{d.nom}}">
    </datalist>
				
				</div>
				<span id="msj3" style="margin-left:1em"></span>
		<div><button type="button"  id="btnCancelar" ng-click="ocultarFiltros()">Cancelar</button>
		<button type="button"  id="btnGuardar" ng-click="guardaFiltros()">Guardar</button></div>
		</div>
		</form>
</section>
</body>
<script>
var ellanomehacecaso = angular.module('goyo', []);
</script>
<script>

$(document).ready(function(){
	
	$("#btnCancelar").click(function(){
		$("#id_filtroModal").css("display","none");
	});

	//ocultar secciones > main >section
	var ts = document.querySelectorAll("main section");
	function ocultarSecciones(){

		for(var i = 0; i < ts.length; i++){
			ts[i].style.display="none";
		}
	}

	ocultarSecciones();
	$("main>section").eq(3).show();

		/*$("main>aside>nav li").click(function(){
		var j = $("main>aside>nav li").index(this);
		ocultarSecciones();
		$("main>section").eq(j).show();
	});*/
/*
	$("#btnCambioC").click(function(){
		var p1 = $("#txtPass1").val();
		var p2 = $("#txtPass2").val();
		var p3 = $("#txtPass3").val();
		if(p1 =="" || p2 == "" || p3 == ""){}
		else if(p2 != p3){
			alert("Error en datos");
		}else{
			alert("Cambio guardado");
		}
	});*/
});




ellanomehacecaso.controller('mehizoclick', function($scope, $http) {
	$scope.cerrarSesion = function(){
		document.querySelector("#frmSalir").submit();
	}

	document.querySelector("#id_filtroModal").style.display="none";
	$scope.mostrarFiltros = function(){
		document.querySelector("#id_filtroModal").style.display="block";
	}



	$scope.ocultarFiltros = function(){
		document.querySelector("#id_filtroModal").style.display="none";
	}
	

	$scope.editarMiDes = function(){
		var txtDes = document.querySelector("#txtDes");
		$http({
			method: 'POST',
			url: 'on/editarMiDes.php', 
			data: { txtDesR: txtDes.value }
			}).then(function (response) {
		}, function (error) {
		});
			cambiaColorGrabar("#txtDes");
	}
	
	$scope.editarMiOcu = function(){
		var txtOcu = document.querySelector("#txtOcu");
		$http({
			method: 'POST',
			url: 'on/editarMiOcu.php', 
			data: { txtOcuR: txtOcu.value }
			}).then(function (response) {
		}, function (error) {
		});
			cambiaColorGrabar("#txtOcu");
		
	}
	$scope.editarMiAltura = function(){
		var txtOcu = document.querySelector("#txtAlt");
		$http({
			method: 'POST',
			url: 'on/editarMiAltura.php', 
			data: { txtOcuR: txtOcu.value }
			}).then(function (response) {
		}, function (error) {
		});
			cambiaColorGrabar("#txtAlt");
		
	}
	$scope.editarMiDistrito = function(){
		var txtOcu = document.querySelector("#txtdis2");
		$http({
			method: 'POST',
			url: 'on/editarDistrito.php', 
			data: { txtOcuR: txtOcu.value }
			}).then(function (response) {
		}, function (error) {
		});
			cambiaColorGrabar("#txtdisdiv");
		
	}
	var contColor = 0;
	$scope.editarMiInteres = function(i){
		var txtInteres = document.querySelectorAll("#txtInteres");
		$http({
			method: 'POST',
			url: 'on/editarMiInteres.php', 
			data: { txtInteresR: txtInteres[i-1].value, preR: i }
			}).then(function (response) {
		}, function (error) {
		});
		var colores = ["#1aa3ff","#e600e6"];
			//var x = Math.floor((Math.random() * 6) + 1);
			
			var m = parseInt(i) + parseInt((i-1));
			var txtInteres2 = document.querySelectorAll("#txtInteres + h3 a");
			txtInteres2[i-1].style.color = colores[contColor];
			contColor = contColor + 1;
			if(contColor == 2){
				contColor = 0;
			}
	}
	var contColor2 = 0;
	function cambiaColorGrabar(s){
		var colores = ["#1aa3ff","#e600e6"];
			//var x = Math.floor((Math.random() * 6) + 1);
	
			var txtInteres2 = document.querySelector(s+" + h3 a");
			txtInteres2.style.color = colores[contColor2];
			contColor2 = contColor2 + 1;
			if(contColor2 == 2){
				contColor2 = 0;
			}
	}
	$scope.guardaFiltros = function(){

		var msj3 = $("#msj3");
		
		function borrarMsj(){
	
		msj3.text("");
		}
		
		if($("#eMin").val().length < 1){
		borrarMsj();
		msj3.text("Error en campo edad mínima");
		return;
		}
		if($("#eMax").val().length < 1){
		borrarMsj();
		msj3.text("Error en campo edad máxima");
		return;
		}
		if(parseInt($("#eMin").val()) > parseInt($("#eMax").val()) ){
		borrarMsj();
		msj3.text("edad mínima debe ser menor o igual que edad máxima");
		return;
		}
		
		if($("#aMin").val().length < 1){
		borrarMsj();
		msj3.text("Error en campo altura mínima");
		return;
		}
		if($("#aMax").val().length < 1){
		borrarMsj();
		msj3.text("Error en campo altura máxima");
		return;
		}
		if(parseInt($("#aMin").val()) > parseInt($("#aMax").val()) ){
		borrarMsj();
		msj3.text("altura mínima debe ser menor o igual que altura máxima");
		return;
		}
		if($("#txtdis").val().length < 1){
		borrarMsj();
		msj3.text("distrito vacio");
		return;
		}
		if(parseInt($("#eMin").val()) < 18 ){
		borrarMsj();
		msj3.text("la edad máxima es de 18 años");
		return;
		}
		if(parseInt($("#aMin").val()) < 150 ){
		borrarMsj();
		msj3.text("altura máxima de las personas es de 150 cm");
		return;
		}
		
		$("#myF").submit();
	}
	/*$scope.cargarSugeridos = function(){
		location.reload();
	}*/
});
</script>
<script type="text/javascript" src="js/mmmlst.js"></script>
<script>

function iniciar(){
	
	var query = window.location.search.substring(1);
       // var vars = query.split("&");
        var vars2 = query.split("=");
		
		if(query == ""){
			 document.getElementById("msj1").innerHTML ="";
		}else{
			if(vars2[0] == "msj1"){
				document.getElementById("msj1").innerHTML = vars2[1];
			}
			if(vars2[0] == "estado"){
				document.getElementById("msj2").innerHTML = vars2[1];
			}
			 
		}
               

   
 txtpass2=document.getElementById("txtPass2");
 txtpass3=document.getElementById("txtPass3");
 txtpass2.addEventListener("input", validacion, false);
 txtpass3.addEventListener("input", validacion, false);
 validacion();
 }
 function validacion(){
 if(txtpass2.value!=txtpass3.value){
 txtpass3.setCustomValidity('Contraseña no coincide con la anterior');
 }else{
 txtpass3.setCustomValidity('');
 }
 }
 window.addEventListener("load", iniciar, false);
 
</script>

</html>




