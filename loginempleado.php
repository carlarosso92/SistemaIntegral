<?php include "php/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    if ($conexion) {
        // Consulta para administradores
        $query = "SELECT us.usuario_id, us.nombre, ad.id AS admin_id, em.cargo AS cargo 
                  FROM usuarios us
                  INNER JOIN administradores ad ON us.usuario_id = ad.usuario_id 
                  INNER JOIN empleados em ON us.usuario_id = em.usuario_id
                  WHERE us.email='$email' AND us.contrasena='$contrasena'";
        $result = mysqli_query($conexion, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['usuario_id'] = $user['usuario_id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_cargo'] = $user['cargo'];
            echo "<script>alert('Inicio de sesión exitoso.');window.location.href = 'gestionadministrador.php';</script>";
        } else {
            // Consulta para empleados
            $query2 = "SELECT usuarios.usuario_id, usuarios.nombre, empleados.cargo 
                       FROM usuarios 
                       INNER JOIN empleados ON usuarios.usuario_id = empleados.usuario_id 
                       WHERE usuarios.email='$email' AND usuarios.contrasena='$contrasena'";
            $result2 = mysqli_query($conexion, $query2);
            $user2 = mysqli_fetch_assoc($result2);

            if ($user2) {
                $_SESSION['usuario_id'] = $user2['usuario_id'];
                $_SESSION['usuario_nombre'] = $user2['nombre'];
                $_SESSION['usuario_cargo'] = $user2['cargo'];
                echo "<script>alert('Inicio de sesión exitoso.');window.location.href = 'gestionempleado.php';</script>";
            } else {
                echo "<script>alert('Email o contraseña incorrectos.');window.location.href = 'crudloginempleado.php';</script>";
            }
        }
        
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>
