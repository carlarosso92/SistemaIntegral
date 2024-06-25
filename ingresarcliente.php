<?php include "php/config.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"]; 
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
   

    // Insertar datos en la base de datos
    $insertar1 = "INSERT INTO usuarios (nombre, contrasena, rut) VALUES ('$nombre', '$contrasena', '$rut')";
    $insertar2 = "INSERT INTO clientes (telefono, email, direccion) VALUES ('$telefono', '$direccion', '$email')";

    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Ejecutar la consulta de inserción
        $resultado1 = mysqli_query($conexion, $insertar1);
        $resultado2 = mysqli_query($conexion, $insertar2);

        // Verificar si la consulta fue exitosa
        if ($resultado1 && $resultado2) {
            // Mensaje emergente en JS
            //echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'sistemaintegral.php';</script>";
        } else {
            echo "Error al ingresar los registros: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>

