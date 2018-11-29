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
				<li>Sugeridos<!-- <li ng-click="cargarSugeridos()">Sugeridos -->
				<li><a href="invitaciones.php">Invitaciones</a>
				<li><a href="mensajes.php">Mensajes</a>
				<li><a href="miperfil.php">Mi Perfil</a>
			</ul>
		</nav>
	</aside>

	<!-- Sugeridos -->
	<section ng-controller="ella" ng-init="listaOtroUsuario()" id="galu">
	<h2>Sugeridos</h2>
	<div id="msjnohay">No Hay usuarios, edite su filtro</div>
	<div ng-repeat="x in datos" ng-click="verUsu(x.id)">
	<img ng-src="{{x.foto}}">
	<p>{{x.nom}}</p>
	<p>{{x.edad}} años</p>
	<p>{{x.ocu}}</p>
	</div>
	<section class="momo" id="usuModal">
	<form action="on/meGusta.php" method="post" id="meGusta">
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
			<p>¿Cómo es {{y.nom}}?</p>
			<p>Estado Civil: <font>{{y.est}}</font></p>
			<p>Mido: <font>{{y.altura}} cm</font></p>
			<p>Vivo en: <font>{{y.vivoen}}</font></p>
			<p>&#128188; Ocupacion: <font>{{y.ocu}}</font></p>
			<p>&#128152; ¿Qué busco en mi próxima relación?:<br> <font>{{y.quebusco}}</font></p>
			<p>&#9977; Mis pasiones en la vida:<br> <font>{{y.pasiones}}</font></p>
			
			
			<p>&#9996; ¿Que hago en mis tiempos libres ?:<br> <font>{{y.tmplibres}}</font></p>
			<p>&#127910; Películas o series favoritas:<br> <font>{{y.pelis}}</font></p>
			<p>&#127925; Bandas o artistas favoritas :<br> <font>{{y.musi}}</font></p>
			<p>&#128218; Mis libros o autores favoritos:<br> <font>{{y.lbrs}}</font></p>
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
			<div><input type="number" value="{{x.edadMin}}" name="eMin" id="eMin" min="18" placeholder="Edad mínima" required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.edadMax}}" name="eMax" id="eMax"  placeholder="Edad máxima"  required/></div>
			
			<h3>Que mida(cm) entre</h3>
			<div><input type="number" value="{{x.alturaMin}}" name="aMin" id="aMin"  placeholder="Altura mímina" required/><a style="padding:0 1em 0 1em">a</a>
			<input type="number" value="{{x.alturaMax}}" name="aMax" id="aMax" min="150"  placeholder="Altura máxima" required/></div>

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


		/*$("main>aside>nav li").click(function(){
		var j = $("main>aside>nav li").index(this);
		ocultarSecciones();
		$("main>section").eq(j).show();
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
	$scope.cerrarModalUsu = function(){
		document.querySelector("#usuModal").style.display="none";
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
		url: 'servicio/cargaOtroUsuario2.php?idU='+i,
		}).then(function(response) {
		$scope.mdatos = response.data.lstCargaDatosOtroUsuario;
		});
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
</html>




