<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php
session_start();
if ($_SESSION['ax']!="1"){
header("location:index.html");
}
?>
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
<title>Registra Computadora</title>
</head>
<body  ng-app="goyo" ng-controller="mehizoclick">

<form action="sesion.php" method="post" id="frmSalir">
</form>

<header>
	<hgroup>
		<h1>OH!</h1>
	</hgroup>
	<section ng-controller="ella" ng-init="listaMisDatos()">
		<nav>
			<ul ng-repeat="x in datos">
				<li ng-click="mostrarFiltros()">Filtro
				<li>Bla
				<li ng-click="cerrarSesion()">Salir
			</ul>
		</nav>
		<div>
			<li style="list-style:none" ng-repeat="x in datos">{{x.nom}}<img/>
		</div>
	</section>
</header>
<main>
	<aside>
		<nav>
			<ul>
				<li ng-click="cargarSugeridos()">Sugeridos
				<li>Invitaciones
				<li>Mensajes
				<li>Mi Perfil
			</ul>
		</nav>
	</aside>

	<!-- Sugeridos -->
	<section ng-controller="ella" ng-init="listaOtroUsuario()" id="galu">
	<h2>Sugeridos</h2>
	<div ng-repeat="x in datos" ng-click="verUsu(x.id)">
	<img ng-src="{{x.foto}}">
	<p>{{x.nom}}</p>
	<p>{{x.edad}} a�os</p>
	<p>{{x.ocu}}</p>
	</div>
	<section class="momo" id="usuModal">
	
	<form action="meGusta.php" method="post" id="meGusta">
		<div ng-repeat="y in mdatos">
		<section>
			<figure>
			<!-- {{y.foto}} -->
			</figure>
		</section>
		<section>
			<figure><img ng-src="{{y.foto}}"></figure>
			<p>{{y.nom}}, {{y.edad}}</p>
			<p>{{y.des}}</p>
			<p>�C�mo es {{y.nom}}?</p>
			<p>Estado Civil: <font>{{y.est}}</font></p>
			<p>Mido: <font>{{y.altura}} cm</font></p>
			<p>Vivo en: <font>{{y.vivoen}}</font></p>
			<p>Ocupacion: <font>{{y.ocu}}</font></p>
			<p>�Qu� busco en mi pr�xima relaci�n?:<br> <font>{{y.quebusco}}</font></p>
			<p>Mis pasiones en la vida:<br> <font>{{y.pasiones}}</font></p>
			<p>�Que hago en mis tiempos libres?:<br> <font>{{y.tmplibres}}</font></p>
			<p>Pel�culas o series favoritas:<br> <font>{{y.pelis}}</font></p>
			<p>Bandas o artistas favoritas:<br> <font>{{y.musi}}</font></p>
			<p>Mis libros o autores favoritos:<br> <font>{{y.lbrs}}</font></p>
			<div>
			<input type="hidden" name="idMiPareja" value="{{y.idUsu}}"/>
			<button type="button" ng-click="cerrarModalUsu()">Cerrar</button>
			<button type="submit" ng-if="y.sexo == 1">Me gusta este chico</button>
			<button type="submit" ng-if="y.sexo == 2">Me gusta esta chica</button></div>
		</section>
		</div>
	</form>
		</section>

	</section>

	<!-- Invitaciones -->
	<section>
	<h2>Invitaciones</h2>
	<div ng-controller="ella"   id="parchelista">
	<h3 ng-click="listaParejas()">Match</h3>
		<div ng-init="listaParejas()">
				<ul ng-repeat="y in datos">
					<li>{{y.nom}}
					
				</ul>
			
		</div>
		<h3>Me gustan</h3>
		<div ng-init="listaMeGustan()">
				<ul ng-repeat="y in datos2">
					<li>{{y.nom}}
					
				</ul>
			
		</div>
	</div>
	</section>
	<!-- Mensajes -->
	<section>
	<h2>Mensajes</h2>
	</section>
	<!-- Mi perfil -->
	<section ng-controller="ella" id="id_perfil">
	<h2>Mi perfil</h2>
		
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aqu� los filtros de las personas soletras que conocer�s y te podr�n conocer en OH!</h2>
		</div>
		<h2 class="t2">Datos B�sicos</h2>
		<div ng-controller="ella" ng-init="listaMisDatos()">
			<div class="marcotres" ng-repeat="x in datos">
			<p>Autodescripci�n</p>
			<!-- <input type="text" value="{{x.des}}" id="txtDes" placeholder="Escribe aqu�"/> -->
			<textarea id="txtDes" name="txtDes" placeholder="Escribe aqu�" maxlength="250">{{x.des}}</textarea>
			<h3 ng-click="editarMiDes()">GRABAR</h3>
			<p>Ocupaci�n</p>
			<input type="text" value="{{x.ocu}}" name="txtOcu" id="txtOcu" placeholder="Escribe aqu�"/>
			<h3 ng-click="editarMiOcu()">GRABAR</h3>
			</div>
		</div>
		<h2 class="t2">Mis Intereses</h2>
		<div  ng-init="listaMisOtrosIntereses()">
			<div ng-repeat="x in datos" class="marcodos" id="tampocomehacecaso">
			<p>{{x.pre}}</p>
			<!--<input type="text" value="{{x.res}}" id="txtInteres" placeholder="Escribe aqu�"/>-->
			<textarea type="text" id="txtInteres" placeholder="Escribe aqu�" maxlength="250">{{x.res}}</textarea>
			<h3 ng-click="editarMiInteres(x.idPre)">GRABAR</h3>
			</div>
		</div>
		
	</section>
</main>
<section ng-controller="ella" ng-init="listaMisFiltros()" id="id_filtroModal" class="momo">
		<form action="editaFiltro.php" method="post">
		<div ng-repeat="x in datos">
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aqu� los filtros de las personas soletras que conocer�s y te podr�n conocer en OH!</h2>
		</div>
		<h3>Tipo de relaci�n</h3>
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
		<div><button type="button"  id="btnCancelar" ng-click="ocultarFiltros()">Cancelar</button>
		<button type="submit"  id="btnGuardar">Guardar</button></div>
		</div>
		</form>
</section>
</body>
<script>
var ellanomehacecaso = angular.module('goyo', []);
var nlista = document.querySelector("#mimi").text;
alert(nlista);
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
	$("main>section").eq(0).show();

		$("main>aside>nav li").click(function(){
		var j = $("main>aside>nav li").index(this);
		ocultarSecciones();
		$("main>section").eq(j).show();
	});

});
var contColor = 0;
function cambiaColorGrabar(abc){
	var colores = ["blue","red","green","#3c92ff","#9800ff","orange"];
			//var x = Math.floor((Math.random() * 6) + 1);
			document.querySelector(" "+abc+" + h3").style.color = colores[contColor];
			contColor = contColor + 1;
			if(contColor == 6){
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
	$scope.cerrarModalUsu = function(){
		document.querySelector("#usuModal").style.display="none";
	}
	$scope.meGusta = function(i,j){
		document.querySelector("#frmMeGusta").submit();
	}
	$scope.ocultarFiltros = function(){
		document.querySelector("#id_filtroModal").style.display="none";
	}
	document.querySelector("#usuModal").style.display="none";
	$scope.verUsu = function(i){
		document.querySelector("#usuModal").style.display="block";
		//alert(i);
		$http({
		method: 'GET',
		url: 'cargaOtroUsuario2.php?idU='+i,
		}).then(function(response) {
		$scope.mdatos = response.data.lstCargaDatosOtroUsuario;
		});
	}
	$scope.editarMiDes = function(){
		var txtDes = document.querySelector("#txtDes");
		$http({
			method: 'POST',
			url: 'editarMiDes.php', 
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
			url: 'editarMiOcu.php', 
			data: { txtOcuR: txtOcu.value }
			}).then(function (response) {
		}, function (error) {
		});
			cambiaColorGrabar("#txtOcu");
		
	}
	$scope.editarMiInteres = function(i){
		var txtInteres = document.querySelectorAll("#txtInteres");
		$http({
			method: 'POST',
			url: 'editarMiInteres.php', 
			data: { txtInteresR: txtInteres[i-1].value, preR: i }
			}).then(function (response) {
		}, function (error) {
		});
		var colores = ["blue","red","green","##3c92ff","##9800ff","orange"];
			//var x = Math.floor((Math.random() * 6) + 1);
			
			var m = parseInt(i) + parseInt((i-1));
			var txtInteres2 = document.querySelectorAll("#txtInteres + h3");
			txtInteres2[i-1].style.color = colores[contColor];
			contColor = contColor + 1;
			if(contColor == 6){
				contColor = 0;
			}
	}
	$scope.cargarSugeridos = function(){
		location.reload();
	}
});

</script>
<script type="text/javascript" src="js/mmmlst.js"></script>
</html>




