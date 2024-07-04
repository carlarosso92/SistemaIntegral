<?php include "php/config.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $rut = $_POST["rut"]; 
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $telefono = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $sueldo = $_POST["sueldo"];
    
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Insertar datos en la tabla usuarios
        $insertarUsuario = "INSERT INTO usuarios (nombre, email, contrasena, rut) VALUES ('$nombre', '$email', '$contrasena', '$rut')";
        $resultadoUsuario = mysqli_query($conexion, $insertarUsuario);
        
        if ($resultadoUsuario) {
            // Obtener el ID del último usuario insertado
            $usuario_id = mysqli_insert_id($conexion);
            
            // Insertar datos en la tabla empleados
            $insertarEmpleado = "INSERT INTO empleados (usuario_id, telefono, cargo, sueldo) VALUES ('$usuario_id', '$telefono', '$cargo', '$sueldo')";
            $resultadoEmpleado = mysqli_query($conexion, $insertarEmpleado);
            
            if ($resultadoEmpleado) {
                // Obtener el ID del último empleado insertado
                $empleado_id = mysqli_insert_id($conexion);
                
                // Insertar datos en la tabla administradores
                $insertarAdministrador = "INSERT INTO administradores (usuario_id, empleado_id) VALUES ('$usuario_id', '$empleado_id')";
                $resultadoAdministrador = mysqli_query($conexion, $insertarAdministrador);

                if ($resultadoAdministrador) {
                    echo "<script>alert('Los registros se ingresaron correctamente como administrador.');window.location.href = 'crudloginempleado.php';</script>";
                } else {
                    echo "Error al registrar como administrador: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al ingresar los registros en la tabla empleados: " . mysqli_error($conexion);
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
