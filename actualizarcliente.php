<?php
include_once("inventario/config/conexion.php");

// Obtener los datos del formulario
$usuario_id = $_POST['usuario_id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$rut = $_POST['rut'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Iniciar una transacción para asegurar que ambas consultas se ejecuten correctamente
$conexion->begin_transaction();

try {
    // Actualizar la tabla usuarios
    $sql_actualizar_usuarios = "UPDATE usuarios SET 
        nombre = ?,
        email = ?,
        rut = ?
        WHERE usuario_id = ?";
    $stmt_usuarios = $conexion->prepare($sql_actualizar_usuarios);
    $stmt_usuarios->bind_param('sssi', $nombre, $email, $rut, $usuario_id);
    $stmt_usuarios->execute();

    // Actualizar la tabla clientes
    $sql_actualizar_clientes = "UPDATE clientes SET 
        telefono = ?,
        direccion = ?
        WHERE usuario_id = ?";
    $stmt_clientes = $conexion->prepare($sql_actualizar_clientes);
    $stmt_clientes->bind_param('ssi', $telefono, $direccion, $usuario_id);
    $stmt_clientes->execute();

    // Confirmar la transacción
    $conexion->commit();
    echo "Datos actualizados exitosamente";
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "Error actualizando los datos: " . $e->getMessage();
}

// Cerrar las conexiones de las sentencias
$stmt_usuarios->close();
$stmt_clientes->close();

// Cerrar la conexión
$conexion->close();

// Redireccionar a la página de listado de productos
header("Location: gestioncliente.php");
exit;
?>
