<?php
include "config/conexion.php"; // Ruta ajustada según la ubicación de config.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $contacto = $_POST["contacto"];
    $telefono = $_POST["telefono_proveedor"];
    $email = $_POST["email_proveedor"];

    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO proveedores (nombre_proveedor, contacto_proveedor, telefono_proveedor, email_proveedor) 
                VALUES ('$nombre', '$contacto', '$telefono', '$email')";
        
        // Ejecutar la consulta
        if (mysqli_query($conexion, $sql)) {
            // Éxito al insertar
            echo "<script>alert('Proveedor ingresado correctamente.'); window.location.href = 'formulario_proveedor.php';</script>";
        } else {
            // Error al insertar
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos.";
    }
}
?>
