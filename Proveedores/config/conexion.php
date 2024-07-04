<?php
$server = "localhost";
$usuario = "root";
$contraseña = "";
$db = "sistemaintegralperico";

$conexion = mysqli_connect($server, $usuario, $contraseña, $db);

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>
