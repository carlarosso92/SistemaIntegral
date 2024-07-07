<?php
include '../php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carrito = json_decode($_POST['carrito'], true);
    $total = 0;

    // Calcular el total de la venta
    foreach ($carrito as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    // Insertar en la tabla ventas
    $query = "INSERT INTO ventas (cliente_id, fecha_venta, total) VALUES (NULL, CURDATE(), '$total')";
    if ($conexion->query($query) === TRUE) {
        $venta_id = $conexion->insert_id;

        // Insertar en la tabla detalle_ventas y actualizar el stock de productos
        foreach ($carrito as $producto) {
            // Insertar en detalle_ventas
            $query = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario) VALUES ('$venta_id', '{$producto['id']}', '{$producto['cantidad']}', '{$producto['precio']}')";
            $conexion->query($query);

            // Actualizar el stock del producto
            $query = "UPDATE productos SET cantidad_stock = cantidad_stock - {$producto['cantidad']} WHERE id_producto = '{$producto['id']}'";
            $conexion->query($query);
        }

        $conexion->close();
        header("Location: generar_ticket.php?venta_id=$venta_id");
        exit();
    } else {
        $conexion->close();
        header("Location: ventas.php?error=1");
        exit();
    }
} else {
    header("Location: ventas.php");
    exit();
}
?>
