<?php
session_start();
if ($_SESSION['axa']!="1"){
header("location:adm.html");
}
?>
<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html lang="esS" >
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="js/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="myCtrl"> 
<h3>Bloqueo de usuario</h3>
<div ng-init="listaMenajes()">
<section ng-repeat="x in mdatos">
<p>{{x.correo}}: {{x.msj}}</p>
</section>
</div>
<h4>Ingrese el correo del usuario a bloquear</h4>
<form action="on/bloqueoAdmin.php" method="post">
<input type="text" id="txtCorreo" name="txtCorreo" placeholder="correo" />
<input type="submit" />
</form>

<form action="on/sesionAdmin.php" method="post">
<input type="submit" value="cerrar"/>
</form>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  $http({
    method : "GET",
    url : "servicio/listaMensajesAdmin.php"
  }).then(function mySuccess(response) {
      $scope.mdatos = response.data.lstMensajesAdmin;
    }, function myError(response) {
      $scope.mdatos = response.statusText;
  });
});
</script>

</body>
</html>