ellanomehacecaso.controller('ella', function($scope, $http) {
	$scope.listaSexo2 = function(){
		$scope.sexos = [
		                {
		                	id : 1,
		                	nom : 'Hombre'
		                },
		                {
		                	id: 2,
		                	nom : 'Mujer'
		                }
		                ]
	},
	$scope.listaOtroUsuario = function() {
		$http({
		method: 'POST',
		url: 'servicio/cargaOtroUsuario.php'
		}).then(function(response) {
		$scope.datos = response.data.lstOtroUsuario;
				 if($scope.datos == ""){
			document.querySelector("#msjnohay").style.display="block";
}
else{
	document.querySelector("#msjnohay").style.display="none";
}
		});
	},
	$scope.listaMisDatos = function() {
		$http({
		method: 'POST',
		url: 'servicio/cargaMisDatos.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisDatos;
		});
	},
	$scope.listaMisFiltros = function() {
		$http({
		method: 'POST',
		url: 'servicio/cargaMisFiltros.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisFiltros;
		});
	},
	$scope.listaMisOtrosIntereses = function() {
		$http({
		method: 'POST',
		url: 'servicio/cargaMisOtrosIntereses.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisOtrosIntereses;
		});
	},
	$scope.listaRelacionInteres2 = function() {
		$http({
		method: 'POST',
		url: 'servicio/listaRelacionInteres.php'
		}).then(function(response) {
		$scope.adatos = response.data.lstRelacionInteres;
		});
	}
	$scope.listaParejas = function() {
		$http({
		method: 'POST',
		url: 'servicio/listaParejas.php'
		}).then(function(response) {
		$scope.datos = response.data.lstParejas;
		});
	}
	$scope.listaMeGustan = function() {
		$http({
		method: 'POST',
		url: 'servicio/listaMeGustan.php'
		}).then(function(response) {
		$scope.datos2 = response.data.lstMeGustan;
		});
	}
	$scope.listaMensajes = function() {
		$http({
		method: 'POST',
		url: 'servicio/listaMensajes.php'
		}).then(function(response) {
		$scope.msj = response.data.lstMensajes;
		});
	}
	$scope.listaDistrito = function(){
		$http({
		method: 'POST',
		url: 'servicio/listaDistrito.php'
		}).then(function(response) {
		$scope.distri = response.data.lstDistritos;
		});
	}
});