<?php
include '../php/config.php';

// Obtener los parámetros enviados desde JavaScript
$idReserva = $_POST['id_reserva'];
$tipoOperacion = $_POST['tipo_operacion'];

// Realizar las consultas SQL según el tipo de operación
if ($tipoOperacion == 'procesar') {
    // Desactivar la reserva
    $sql = "UPDATE reservas SET flg_activo = 0 WHERE id = $idReserva";
    $mensaje = "Reserva procesada con éxito";

    // Obtener los datos de la reserva
    $queryReserva = "SELECT usuario_id, hora_reserva, hora_retiro, total FROM reservas WHERE id = $idReserva";
    $resultReserva = $conexion->query($queryReserva);

    if ($resultReserva->num_rows > 0) {
        $reserva = $resultReserva->fetch_assoc();
        $clienteId = $reserva['usuario_id'];
        $fechaVenta = date('Y-m-d'); // Utilizamos la fecha actual para la venta
        $total = $reserva['total'];

        // Insertar en la tabla ventas
        $insertVenta = "INSERT INTO ventas (cliente_id, fecha_venta, total) VALUES (NULL, CURDATE(), $total)";
        if ($conexion->query($insertVenta) === TRUE) {
            $ventaId = $conexion->insert_id;

            // Obtener los detalles de la reserva
            $queryDetalleReserva = "SELECT producto_id, cantidad, precio_unitario FROM detalle_reservas WHERE reserva_id = $idReserva";
            $resultDetalleReserva = $conexion->query($queryDetalleReserva);

            while ($detalleReserva = $resultDetalleReserva->fetch_assoc()) {
                $productoId = $detalleReserva['producto_id'];
                $cantidad = $detalleReserva['cantidad'];
                $precioUnitario = $detalleReserva['precio_unitario'];

                // Insertar en la tabla detalle_ventas
                $insertDetalleVenta = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario) VALUES ($ventaId, $productoId, $cantidad, $precioUnitario)";
                $conexion->query($insertDetalleVenta);
            }
        } else {
            $resultado = false;
            $mensaje = "Error al insertar en la tabla ventas: " . $conexion->error;
        }
    } else {
        $resultado = false;
        $mensaje = "No se encontró la reserva.";
    }
} else if ($tipoOperacion == 'anular') {        
    $sql = "UPDATE reservas SET flg_activo = 0 WHERE id = $idReserva";
    $mensaje = "Reserva anulada con éxito";

    // Devolver el stock de la reserva anulada
    $busquedaProd = "SELECT dr.producto_id, dr.cantidad FROM detalle_reservas dr WHERE dr.reserva_id = $idReserva";
    $listadoProd = $conexion->query($busquedaProd);

    while ($producto = $listadoProd->fetch_assoc()) {
        $productoId = $producto['producto_id'];
        $cantidad = $producto['cantidad'];

        $devolverStock = "UPDATE productos SET cantidad_stock = cantidad_stock + $cantidad WHERE id_producto = $productoId";
        $conexion->query($devolverStock);
    }
} else {
    $resultado = false;
    $mensaje = "Tipo de operación no válido";
}

// Ejecutar la consulta SQL para desactivar la reserva
$resultado = $conexion->query($sql);

// Devolver una respuesta JSON a JavaScript
$respuesta = array(
    'exito' => $resultado, // true si la consulta se ejecutó correctamente
    'mensaje' => $mensaje
);

echo json_encode($respuesta);
?>
