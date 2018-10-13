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
	<section>
		<nav ng-controller="ella" ng-init="listaMisDatos()">
			<ul ng-repeat="x in datos">
				<li ng-click="mostrarFiltros()">Filtro
				<li>Bla
				<li ng-click="cerrarSesion()">Salir
				<li>{{x.nom}}
			</ul>
		</nav>
		<div>
			<h3></h3><img />
		</div>
	</section>
</header>
<main>
	<aside>
		<nav>
			<ul>
				<li>Sugeridos
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
	<p>{{x.nom}}</p>
	<p>{{x.edad}} años</p>
	<p>{{x.ocu}}</p>
	</div>
	<section class="momo" id="usuModal">
	<form>
		<div ng-repeat="y in mdatos">
			<p>nom: {{y.nom}}</p>
			<p>descripcion: {{y.des}}</p>
			<p>ocupacion: {{y.ocu}}</p>
			<p>Estado Civil: {{y.est}}</p>
		</div>
	</form>
		</section>
		
	</section>
	
	<!-- Invitaciones -->
	<section>
	<h2>Invitaciones</h2>
	</section>
	<!-- Mensajes -->
	<section>
	<h2>Mensajes</h2>
	</section>
	<!-- Mi perfil -->
	<section ng-controller="ella" id="id_perfil">
	<h2>Mi perfil</h2>
		<form>
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aquí los filtros de las personas soletras que conocerás y te podrán conocer en OH!</h2>
		</div>
		<h2 class="t2">Datos Básicos</h2>
		<div ng-controller="ella" ng-init="listaMisDatos()">
			<div class="marcotres" ng-repeat="x in datos">
			<p>Autodescripción</p>
			<p>{{x.des}}</p>
			<h3>EDITAR</h3>
			<p>Ocupación</p>
			<p>{{x.ocu}}</p>
			<h3>EDITAR</h3>
			</div>
		</div>
		<h2 class="t2">Mis Intereses</h2>
		<div  ng-init="listaMisOtrosIntereses()">
			<div ng-repeat="x in datos" class="marcodos" id="tampocomehacecaso">
			<p>{{x.pre}}</p>
			<p>"{{x.res}}"</p>
			<h3>EDITAR</h3>
			</div>
		</div>
		</form>
	</section>
</main>
<section ng-controller="ella" ng-init="listaMisFiltros()" id="id_filtroModal" class="momo">
		<form>
		<div ng-repeat="x in datos">
		<div class="t1" id="tampocomehacecaso">
		<h1>Tu tienes el control</h1>
		<h2>Edita aquí los filtros de las personas soletras que conocerás y te podrán conocer en OH!</h2>
		</div>
		<h3>Tipo de relación</h3>
		<div ng-init="listaRelacionInteres()">
			<ul ng-repeat="y in adatos">
			<li ng-if="x.relacion == y.id"><input type="radio"checked="checked" name="chkr"/> {{y.nom}}
			<li ng-if="x.relacion != y.id"><input type="radio" name="chkr"/> {{y.nom}}
			</ul>
			
		</div>
		<h3>Busco</h3>
			<div ng-init="listaSexo()">
				<ul ng-repeat="s in sexos">
					<li ng-if="x.sexo == s.id"><input type="radio"checked="checked" name="chks"/> {{s.nom}}
					<li ng-if="x.sexo != s.id"><input type="radio"  name="chks"/> {{s.nom}}
				</ul>
			</div>
			<h3>Que tenga entre</h3>
			<div><input type="number" value="{{x.edadMin}}"/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.edadMax}}"/></div>
		<div><button type="button"  id="btnCancelar" ng-click="ocultarFiltros()">Cancelar</button>
		<button type="button"  id="btnGuardar">Guardar</button></div>
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
	$("main>section").eq(0).show();

		$("main>aside>nav li").click(function(){
		var j = $("main>aside>nav li").index(this);
		ocultarSecciones();
		$("main>section").eq(j).show();
	});

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
});

</script>
<script type="text/javascript" src="js/mmmlst.js"></script>
</html>




