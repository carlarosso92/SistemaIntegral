<?php include "php/config.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"]; 
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $cargo = $_POST["cargo"];
    $sueldo = $_POST["sueldo"];
   
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Insertar datos en la tabla usuarios
        $insertar1 = "INSERT INTO usuarios (nombre, contrasena, rut) VALUES ('$nombre', '$contrasena', '$rut')";
        $resultado1 = mysqli_query($conexion, $insertar1);
        
        if ($resultado1) {
            // Obtener el ID del último usuario insertado
            $usuario_id = mysqli_insert_id($conexion);
            
            // Insertar datos en la tabla clientes
            $insertar2 = "INSERT INTO trabajadores (usuario_id, telefono, cargo, sueldo) VALUES ('$usuario_id', '$telefono', '$cargo', '$sueldo')";
            $resultado2 = mysqli_query($conexion, $insertar2);
            
            // Verificar si la consulta fue exitosa
            if ($resultado2) {
                // Mensaje emergente en JS
                echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'crudempleado.php';</script>";
            } else {
                echo "Error al ingresar los registros en la tabla clientes: " . mysqli_error($conexion);
            }
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
