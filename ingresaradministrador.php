<?php include "php/config.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"]; 
    $contrasena = $_POST["contrasena"];
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Insertar datos en la tabla usuarios
        $insertar1 = "INSERT INTO usuarios (nombre, contrasena, rut) VALUES ('$nombre','$contrasena', '$rut')";
        $resultado1 = mysqli_query($conexion, $insertar1);
        
        if ($resultado1) {
            // Obtener el ID del último usuario insertado
            $usuario_id = mysqli_insert_id($conexion);
            echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'crudlogincliente.php';</script>";
            
        } else {
            echo "Error al ingresar los registros en la tabla usuarios: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>
