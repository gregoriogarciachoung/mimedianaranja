ellanomehacecaso.controller('frmRegistro', function($scope, $http) {
	$scope.listaSexo = function(){
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
	$scope.listaDistrito = function(){
		$http({
		method: 'POST',
		url: 'servicio/listaDistrito.php'
		}).then(function(response) {
		$scope.datos = response.data.lstDistritos;
		});
	},
	$scope.listaEstado = function(){
		$scope.estados = [	                
		                {
		                	id: 1,
		                	nom : 'Soltero'
		                },
						{
		                	id: 2,
		                	nom : 'Casado'
		                }
		                ]
	},
	$scope.listaEducacion = function(){
		$http({
		method: 'POST',
		url: 'servicio/listaNivelEducacion.php'
		}).then(function(response) {
		$scope.edus = response.data.lstNivelEducacion;
		});
	},
	$scope.listaRelacionInteres = function() {
		$http({
		method: 'POST',
		url: 'servicio/listaRelacionInteres.php'
		}).then(function(response) {
		$scope.relaciones = response.data.lstRelacionInteres;
		});
	}
});