<?php
$server="localhost";
$usuario = "root";
$contraseña="";
$db="sistemaintegral";

$conexion = mysqli_connect($server,$usuario,$contraseña,$db)or die("Error en la conexion");

?>