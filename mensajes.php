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
	<section class="momo" id="usuModal2"></section>
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
	<div ng-repeat="x in msj" class="galmsj" ng-if="x.emisor == txtUsuMsj">
	<figure ><img ng-src="{{x.foto}}"></figure>
	<p >{{x.nom}}</p>
	<p >{{x.msj}}</p>
	<p >recibido el {{x.fecha}}</p>
	</div>
	<div ng-repeat="x in msj" class="galmsj" ng-if="0 == txtUsuMsj">
	<figure ><img ng-src="{{x.foto}}"></figure>
	<p >{{x.nom}}</p>
	<p >{{x.msj}}</p>
	<p >recibido el {{x.fecha}}</p>
	</div>
	</section>
	<!-- Mi perfil -->
	<section>
	</section>
</main>
<section ng-controller="ella" ng-init="listaMisFiltros()" id="id_filtroModal" class="momo">
		<form action="on/editaFiltro.php" method="post">
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
			<div><input type="number" value="{{x.edadMin}}" name="eMin"/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.edadMax}}" name="eMax"/></div>
			
			<h3>Que mida(cm) entre</h3>
			<div><input type="number" value="{{x.alturaMin}}" name="aMin"/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.alturaMax}}" name="aMax"/></div>
			<h3>( {{x.nomdis}} ) Lugar en el que quiero conocer a mi Media naranja. <div ng-init="listaDistrito()">
				  Cambiar de lugar? <select name="distrito">
				<option  ng-repeat="d in distri" value="{{d.id}}">{{d.nom}}
				</select>
				</div></h3>
		<div><button type="button"  id="btnCancelar" ng-click="ocultarFiltros()">Cancelar</button>
		<button type="submit"  id="btnGuardar">Guardar</button></div>
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
	document.querySelector("#usuModal2").style.display="none";
	/*$scope.cargarSugeridos = function(){
		location.reload();
	}*/
});
</script>
<script type="text/javascript" src="js/mmmlst.js"></script>
</html>




