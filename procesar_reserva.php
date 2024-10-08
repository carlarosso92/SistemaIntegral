<?php
include 'php/config.php';
session_start();

header('Content-Type: application/json'); // Establecer cabecera JSON

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$hora_retiro_entrada = $_POST['hora_retiro'];
$hora_actual = date("Y-m-d H:i:s");

//formatear la hora de retiro
$currentDate = date("Y-m-d");
$hora_retiro = $currentDate . " " . $hora_retiro_entrada;

// Obtener el total del carrito
$cart_total = 0;
$cart = $_SESSION['cart'] ?? []; // Usar el nombre correcto de la variable de sesión

$cart_total = $_SESSION['total'];

$conexion->begin_transaction();

try {

    // Insertar en la tabla reservas
    $stmt = $conexion->prepare("INSERT INTO reservas (usuario_id, hora_reserva, hora_retiro, total) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $usuario_id, $hora_actual, $hora_retiro, $cart_total);
    $stmt->execute();
    $reserva_id = $stmt->insert_id;

    // Insertar en la tabla detalle_reservas y actualizar el stock de productos
    $stmt_detalle = $conexion->prepare("INSERT INTO detalle_reservas (reserva_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
    $stmt_update_stock = $conexion->prepare("UPDATE productos SET cantidad_stock = cantidad_stock - ? WHERE id_producto = ?");
    
    foreach ($cart as $item) {
        $stmt_detalle->bind_param("iiid", $reserva_id, $item['id'], $item['quantity'], $item['price']);
        $stmt_detalle->execute();
        
        $stmt_update_stock->bind_param("ii", $item['quantity'], $item['id']);
        $stmt_update_stock->execute();
    }

    $conexion->commit();

    // Limpiar el carrito
    $_SESSION['cart'] = [];

    echo json_encode(['success' => true, 'message' => 'Reserva confirmada']);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al procesar la reserva: ' . $e->getMessage()]); // Mensaje de error más detallado
}

$conexion->close();
?>
