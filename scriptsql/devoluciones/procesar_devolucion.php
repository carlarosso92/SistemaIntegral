<?php
require 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_venta = $_POST['id_venta'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $monto_devuelto = $_POST['monto_devuelto'];
    $motivo = $_POST['motivo'];
    $tipo_devolucion = $_POST['tipo_devolucion'];

    // Insertar la devolución en la tabla de devoluciones
    $sql = "INSERT INTO devoluciones (id_venta, id_producto, cantidad, monto_devuelto, motivo, tipo_devolucion) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiidss", $id_venta, $id_producto, $cantidad, $monto_devuelto, $motivo, $tipo_devolucion);
    $stmt->execute();

    // Actualizar el stock si es una devolución
    if ($tipo_devolucion == 'devolucion') {
        $sql = "UPDATE productos SET cantidad_stock = cantidad_stock + ? WHERE id_producto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $id_producto);
        $stmt->execute();
    }

    echo "<script>
        alert('Devolución procesada exitosamente.');
        window.location.href = 'ver_devoluciones.php';
    </script>";
}
?>
