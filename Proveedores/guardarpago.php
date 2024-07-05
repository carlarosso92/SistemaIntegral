<?php
include '../php/config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $proveedor_id = $_POST['proveedor_id'];
    $fecha_pago = $_POST['fecha_pago'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];

    // Inserta los datos en la tabla pagos_proveedores
    $query = "INSERT INTO pagos_proveedores (proveedor_id, fecha_pago, monto, descripcion) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('isds', $proveedor_id, $fecha_pago, $monto, $descripcion);

    if ($stmt->execute()) {
        echo "Pago registrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
