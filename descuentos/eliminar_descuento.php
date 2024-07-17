<?php
include "config/conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM descuentos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Descuento eliminado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar el descuento');</script>";
    }

    $stmt->close();
    $conexion->close();

    // Redirigir de nuevo a la página de mostrar descuentos
    echo "<script>window.location.href = 'mostrar_descuentos.php';</script>";
} else {
    echo "<script>alert('ID de descuento no especificado');</script>";
    echo "<script>window.location.href = 'mostrar_descuentos.php';</script>";
}
?>
