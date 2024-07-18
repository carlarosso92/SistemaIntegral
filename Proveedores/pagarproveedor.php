<?php
include '../php/config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'get_facturas') {
        // Lógica para obtener las facturas según el proveedor seleccionado
        $proveedor_id = $_POST['proveedor_id'];

        // Consulta para obtener las facturas del proveedor
        $query = "SELECT id, numero_factura FROM facturas_proveedores WHERE proveedor_id = ? AND flagpagado = 0";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('i', $proveedor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $facturas = [];
        while ($row = $result->fetch_assoc()) {
            $facturas[] = $row;
        }

        echo json_encode($facturas);

        $stmt->close();
        $conexion->close();
        exit();
    } else {
        // Lógica para registrar el pago
        $proveedor_id = $_POST['proveedor_id'];
        $factura_id = $_POST['factura_id'];
        $fecha_pago = $_POST['fecha_pago'];
        $monto = $_POST['monto'];
        $descripcion = $_POST['descripcion'];

        // Actualiza el estado de la factura a pagado
        $query = "UPDATE facturas_proveedores SET fecha_pago = ?, monto = ?, descripcion = ?, flagpagado = 1 WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('sdsi', $fecha_pago, $monto, $descripcion, $factura_id);

        if ($stmt->execute()) {
            echo "<script>alert('Pago registrado exitosamente.');window.location.href='listadofacturas.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conexion->close();
    }
}
?>
