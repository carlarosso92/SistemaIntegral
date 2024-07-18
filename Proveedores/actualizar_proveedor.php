<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require("inventario/config/conexion.php");

// Obtener los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$contacto = $_POST['contacto'];
$telefono = $_POST['telefono_proveedor'];
$email = $_POST['email_proveedor'];

// Consulta SQL para actualizar los datos del proveedor
$sql = "UPDATE proveedores SET nombre_proveedor = ?, contacto_proveedor = ?, telefono_proveedor = ?, email_proveedor = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $contacto, $telefono, $email, $id);

if ($stmt->execute()) {
    // Redireccionar a la página de listado de proveedores con un mensaje de éxito
    header("Location: proveedores.php?mensaje=Proveedor actualizado correctamente");
} else {
    // Redireccionar a la página de listado de proveedores con un mensaje de error
    header("Location: proveedores.php?mensaje=Error al actualizar el proveedor");
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
