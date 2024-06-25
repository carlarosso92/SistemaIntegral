<?php
include "php/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if ($conexion) {
        $query = "SELECT usuarios.contrasena FROM usuarios INNER JOIN clientes ON usuarios.usuario_id = clientes.usuario_id WHERE clientes.email='$email'";
        $result = mysqli_query($conexion, $query);
        $client = mysqli_fetch_assoc($result);

        if ($client) {
            $password = $client['contrasena'];

            // Enviar la contraseña actual por email ver esto despues porque sale error
            mail($email, "Recuperación de contraseña", "Tu contraseña actual es: $password"); 

            echo "<script>alert('La contraseña ha sido enviada a tu email.');window.location.href = 'crudlogincliente.php';</script>";
        } else {
            echo "<script>alert('No se encontró una cuenta con ese email.');window.location.href = 'crudrecuperarcontrasena.php';</script>";
        }

        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>