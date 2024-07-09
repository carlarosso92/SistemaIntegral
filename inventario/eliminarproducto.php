<?php
require("config/conexion.php");

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // Preparar la consulta para eliminar el producto
    $sql = "DELETE FROM productos WHERE id_producto = ?";

    // Preparar la declaración
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular variables a la declaración preparada como parámetros
        $stmt->bind_param("i", $id_producto);

        // Intentar ejecutar la declaración preparada
        if ($stmt->execute()) {
            // Redirigir de vuelta a la página de lista de productos después de la eliminación
            header("Location: index.php");
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Cerrar la conexión
$conexion->close();
?>
