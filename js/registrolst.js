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
		$scope.lstDistritos = [
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
		$scope.educacion = [	                
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
		$scope.adatos = [	                
		                {
		                	id: 1,
		                	nom : 'A su alma gemela, matrimomio'
		                },
						{
		                	id: 2,
		                	nom : 'Una relacion seria'
		                },
						{
		                	id: 3,
		                	nom : 'Conocer nuevas personas y ver que pasa'
		                },
						{
		                	id: 4,
		                	nom : 'Una relacion de una noche'
		                }
		                ]
	}
});