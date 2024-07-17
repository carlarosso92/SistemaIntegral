<?php
require("inventario/config/conexion.php");

if (isset($_GET['id'])) {
    $id_proveedor = $_GET['id'];

    // Preparar la consulta para eliminar el proveedor
    $sql = "DELETE FROM proveedores WHERE id = ?";

    // Preparar la declaración
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular variables a la declaración preparada como parámetros
        $stmt->bind_param("i", $id_proveedor);

        // Intentar ejecutar la declaración preparada
        if ($stmt->execute()) {
            // Redirigir de vuelta a la página de lista de proveedores después de la eliminación
            header("Location: proveedores.php");
            exit();
        } else {
            echo "Error al eliminar el proveedor.";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la declaración.";
    }
} else {
    echo "ID del proveedor no especificado.";
}

// Cerrar la conexión
$conexion->close();
?>
