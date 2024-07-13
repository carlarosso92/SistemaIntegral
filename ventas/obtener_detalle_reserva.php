<?php
require("../inventario/config/conexion.php"); // Conexión a la base de datos

// Asegurarse de que se recibe un ID de reserva válido
if (isset($_GET['reserva_id']) && is_numeric($_GET['reserva_id'])) {
    $reservaId = $_GET['reserva_id'];

    // Consulta SQL para obtener el detalle de la reserva
    $sqlDetalle = "SELECT p.nombre AS nombre_producto, dr.cantidad, dr.precio_unitario 
                   FROM detalle_reservas dr 
                   INNER JOIN productos p ON dr.producto_id = p.id_producto 
                   WHERE dr.reserva_id = $reservaId";

    $resultadoDetalle = $conexion->query($sqlDetalle);
    
    // Verificar si hay resultados
    if ($resultadoDetalle) {
        $detalle = $resultadoDetalle->fetch_all(MYSQLI_ASSOC);
        echo json_encode($detalle); // Array JSON
    } else {
        echo json_encode([]); // Array vacío si no hay resultados
    }
} else {
    // Manejo de errores si no se proporciona un ID de reserva válido
    echo json_encode(['error' => 'ID de reserva no válido']);
}
?>

