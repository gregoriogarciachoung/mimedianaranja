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
		url: 'cargaOtroUsuario.php'
		}).then(function(response) {
		$scope.datos = response.data.lstOtroUsuario;
		});
	},
	$scope.listaMisDatos = function() {
		$http({
		method: 'POST',
		url: 'cargaMisDatos.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisDatos;
		});
	},
	$scope.listaMisFiltros = function() {
		$http({
		method: 'POST',
		url: 'cargaMisFiltros.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisFiltros;
		});
	},
	$scope.listaMisOtrosIntereses = function() {
		$http({
		method: 'POST',
		url: 'cargaMisOtrosIntereses.php'
		}).then(function(response) {
		$scope.datos = response.data.lstMisOtrosIntereses;
		});
	},
	$scope.listaRelacionInteres2 = function() {
		$http({
		method: 'POST',
		url: 'listaRelacionInteres.php'
		}).then(function(response) {
		$scope.adatos = response.data.lstRelacionInteres;
		});
	}
	$scope.listaParejas = function() {
		$http({
		method: 'POST',
		url: 'listaParejas.php'
		}).then(function(response) {
		$scope.datos = response.data.lstParejas;
		});
	}
	$scope.listaMeGustan = function() {
		$http({
		method: 'POST',
		url: 'listaMeGustan.php'
		}).then(function(response) {
		$scope.datos2 = response.data.lstMeGustan;
		});
	}
});