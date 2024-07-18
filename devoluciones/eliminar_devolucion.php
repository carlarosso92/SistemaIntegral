<?php
require 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la cantidad y el id_producto antes de eliminar la devolución
    $sql = "SELECT cantidad, id_producto, tipo_devolucion FROM devoluciones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $devolucion = $resultado->fetch_assoc();

    if ($devolucion) {
        $cantidad = $devolucion['cantidad'];
        $id_producto = $devolucion['id_producto'];
        $tipo_devolucion = $devolucion['tipo_devolucion'];

        // Si la devolución es una "devolucion", revertir el stock del producto
        if ($tipo_devolucion == 'devolucion') {
            $sql_update = "UPDATE productos SET cantidad_stock = cantidad_stock - ? WHERE id_producto = ?";
            $stmt_update = $conexion->prepare($sql_update);
            $stmt_update->bind_param("ii", $cantidad, $id_producto);
            $stmt_update->execute();
        }

        // Eliminar la devolución
        $sql_delete = "DELETE FROM devoluciones WHERE id = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        if ($stmt_delete->execute()) {
            // Redirigir a la lista de devoluciones con un mensaje de éxito
            header("Location: ver_devoluciones.php?mensaje=Devolución eliminada correctamente");
        } else {
            // Redirigir a la lista de devoluciones con un mensaje de error
            header("Location: ver_devoluciones.php?mensaje=Error al eliminar la devolución");
        }
    } else {
        // Redirigir a la lista de devoluciones si no se encuentra la devolución
        header("Location: ver_devoluciones.php?mensaje=Devolución no encontrada");
    }

    $stmt->close();
} else {
    // Redirigir a la lista de devoluciones si no se ha proporcionado un ID
    header("Location: ver_devoluciones.php");
}

$conexion->close();
?>
