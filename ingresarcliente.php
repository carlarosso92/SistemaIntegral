<?php include "php/config.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"]; 
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $email = $_POST["email"];
    $contraseña = $_POST ["contraseña"];
   

    // Insertar datos en la base de datos
    $insertar = "INSERT INTO usuario (nombre, telefono, email, rut, direccion,contraseña) VALUES ('$nombre', '$telefono', '$direccion','$email', '$contraseña', '$rut', )";

    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Ejecutar la consulta de inserción
        $resultado = mysqli_query($conexion, $insertar);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Mensaje emergente en JS
            echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'portafolioe.php';</script>";
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

