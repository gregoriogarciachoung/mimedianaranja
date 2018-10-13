regist.controller('ella', function($scope, $http) {
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
		$scope.sexos = [
		                {
		                	id : -1,
		                	nom : '--- Select ---'
		                },
		                {
		                	id: 1,
		                	nom : 'Cercado Lima'
		                },
						{
		                	id: 2,
		                	nom : 'Los olivos'
		                },
						{
		                	id: 3,
		                	nom : 'Independencia'
		                }
		                ]
	},
	$scope.listaEstado = function(){
		$scope.sexos = [	                
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
		$scope.sexos = [	                
		                {
		                	id: 1,
		                	nom : 'Secundaria'
		                },
						{
		                	id: 2,
		                	nom : 'Tecnico'
		                },
						{
		                	id: 3,
		                	nom : 'Universidad'
		                },
						{
		                	id: 4,
		                	nom : 'Maestria'
		                }
		                ]
	},
	$scope.listaRelacionInteres = function() {
		$http({
		method: 'POST',
		url: 'listaRelacionInteres.php'
		}).then(function(response) {
		$scope.adatos = response.data.lstRelacionInteres;
		});
	}
});