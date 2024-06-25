<?php
include "php/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    if ($conexion) {
        $query = "SELECT * FROM usuarios INNER JOIN clientes ON usuarios.usuario_id = clientes.usuario_id WHERE clientes.email='$email' AND usuarios.contrasena='$contrasena'";
        $result = mysqli_query($conexion, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['usuario_id'] = $user['usuario_id'];
            echo "<script>alert('Inicio de sesión exitoso.');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Email o contraseña incorrectos.');window.location.href = 'crudlogincliente.php';</script>";
        }

        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>