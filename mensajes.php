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
				<li  ng-repeat="x in datos"><a href="chat.php?usuario={{x.nom}}">Chat</a>
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
				<li><a href="mmm.php">Sugeridos</a><!-- <li ng-click="cargarSugeridos()">Sugeridos -->
				<li><a href="invitaciones.php">Invitaciones</a>
				<li>Mensajes
				<li><a href="miperfil.php">Mi Perfil</a>
			</ul>
		</nav>
	</aside>

	<!-- Sugeridos -->
	<section>
	<section></section>
	</section>

	<!-- Invitaciones -->
	<section id="invi">
	<section class="momo" ></section>
	</section>
	<!-- Mensajes -->
	<section ng-controller="ella"  id="galu" >
	<!-- <input type="text" ng-model="txtUsuMsj" placeholder="combo"/> -->
	<h2>Mensajes</h2>
	<div ng-init="listaParejas()">
	<h3 >Seleccione usuario</h3>

	<select ng-init="listaMensajes()" ng-model="txtUsuMsj" >
	<option value="0">Todos
	<option ng-repeat="x in datos" value="{{x.yo}}">{{x.nom}}
	</select>
	
	</div>
	<div ng-repeat="x in msj" class="galmsj" ng-if="x.emisor == txtUsuMsj" ng-click="verUsuEnviarMsj(x.emisor)">
	<figure ><img ng-src="{{x.foto}}"></figure>
	<p >{{x.nom}}</p>
	<p >{{x.msj}}</p>
	<p >recibido el {{x.fecha}}</p>
	</div>
	<div ng-repeat="x in msj" class="galmsj" ng-if="0 == txtUsuMsj" ng-click="verUsuEnviarMsj(x.emisor)">
	<figure ><img ng-src="{{x.foto}}"></figure>
	<p >{{x.nom}}</p>
	<p >{{x.msj}}</p>
	<p >recibido el {{x.fecha}}</p>
	</div>

	</section>
	<section class="momo" id="usuModal2">
	<form>
		<div ng-repeat="y in mdatos">
		<section>
			<figure>
			<!-- {{y.foto}} -->
			</figure>
		</section>
		<section>
			
		
			<textarea placeholder="Escríbeme" id="txtMensaje"></textarea>
			<div>
			<input type="hidden" name="idMiPareja" value="{{y.idUsu}}"/>
			<button type="button" ng-click="cerrarModalUsu2()">Cerrar</button>
			<button type="button" ng-click="enviarMensaje(y.idUsu)">Enviar mensaje</button></div>
		</section>
		</div>
	</form>
		</section>
	<!-- Mi perfil -->
	<section>
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
			<div><input type="number" value="{{x.edadMin}}" name="eMin" id="eMin" min="18"  required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.edadMax}}" name="eMax" id="eMax"  required/></div>
			
			<h3>Que mida(cm) entre</h3>
			<div><input type="number" value="{{x.alturaMin}}" name="aMin" id="aMin" required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.alturaMax}}" name="aMax" id="aMax" min="150" required/></div>

			<div ng-init="listaDistrito()">		
			Busca en:	<input  list="testList" type="text" name="distrito" id="txtdis" value="{{x.nomdis}}" required/>
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
	$("main>section").eq(2).show();

	/*	$("main>aside>nav li").click(function(){
		var j = $("main>aside>nav li").index(this);
		ocultarSecciones();
		$("main>section").eq(j).show();
	});*/

});
var contColor = 0;
function cambiaColorGrabar(abc){
	var colores = ["blue","red"];
			//var x = Math.floor((Math.random() * 6) + 1);
			document.querySelector(" "+abc+" + h3 a").style.color = colores[contColor];
			contColor = contColor + 1;
			if(contColor == 2){
				contColor = 0;
			}
}



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
	$scope.verUsuEnviarMsj = function(i){
		document.querySelector("#usuModal2").style.display="block";
		//alert(i);
		$http({
		method: 'GET',
		url: 'servicio/cargaOtroUsuario2.php?idU='+i,
		}).then(function(response) {
		$scope.mdatos = response.data.lstCargaDatosOtroUsuario;
		});
	}
	$scope.cerrarModalUsu2 = function(){
		document.querySelector("#usuModal2").style.display="none";
	}
	$scope.enviarMensaje = function(i){
		var txtMensaje = document.querySelector("#txtMensaje");
		$http({
			method: 'POST',
			url: 'on/enviarMensaje.php', 
			data: { txtReceptorR: i, txtMensajeR: txtMensaje.value}
			}).then(function (response) {
		}, function (error) {
		});
		txtMensaje.value="";
	}
	
	document.querySelector("#usuModal2").style.display="none";
	
	$scope.guardaFiltros = function(){

		var msj3 = $("#msj3");
		
		function borrarMsj(){
	
		msj3.text("");
		}
		
		if($("#eMin").val().length < 1){
		borrarMsj();
		msj3.text("edad mínima vacio");
		return;
		}
		if($("#eMax").val().length < 1){
		borrarMsj();
		msj3.text("edad máxima vacio");
		return;
		}
		if(parseInt($("#eMin").val()) > parseInt($("#eMax").val()) ){
		borrarMsj();
		msj3.text("edad mínima debe ser menor o igual que edad máxima");
		return;
		}
		
		if($("#aMin").val().length < 1){
		borrarMsj();
		msj3.text("altura mínima vacio");
		return;
		}
		if($("#aMax").val().length < 1){
		borrarMsj();
		msj3.text("altura máxima vacio");
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
</html>




