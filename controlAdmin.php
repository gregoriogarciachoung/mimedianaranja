<?php
session_start();
if ($_SESSION['axa']!="1"){
header("location:adm.html");
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
<h3>Bloqueo de usuario</h3>
<h4>Ingrese el correo del usuario a bloquear</h4>
<form action="on/bloqueoAdmin.php" method="post">
<input type="text" id="txtCorreo" name="txtCorreo" placeholder="correo" />
<input type="submit" />
</form>
<form action="on/sesionAdmin.php" method="post">
<input type="submit" value="cerrar"/>
</form>
</html>