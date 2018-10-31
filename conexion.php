<?php
function getConexion(){
		$db = new PDO('mysql:host=localhost;dbname=mmm', 'root', 'mysql');
		return $db;
	}
?>