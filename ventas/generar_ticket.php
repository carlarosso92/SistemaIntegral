<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta a Dompdf sea correcta

use Dompdf\Dompdf;

// Obtener datos de la venta y detalles de la venta
$venta_id = $_GET['venta_id'];
include '../php/config.php';

$queryVenta = "SELECT * FROM ventas WHERE id = '$venta_id'";
$resultVenta = mysqli_query($conexion, $queryVenta);
$venta = mysqli_fetch_assoc($resultVenta);

$queryDetalles = "SELECT dv.*, p.nombre FROM detalle_ventas dv INNER JOIN productos p ON dv.producto_id = p.id_producto WHERE dv.venta_id = '$venta_id'";
$resultDetalles = mysqli_query($conexion, $queryDetalles);

// Generar el contenido HTML para el PDF
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .logo {
            width: 100px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../img/logo.png" alt="Logo" class="logo">
        <h1>Minimarket Perico</h1>
        <p>Número de Ticket: ' . $venta_id . '</p>
        <p>Fecha: ' . $venta['fecha_venta'] . '</p>
        
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>';

while ($detalle = mysqli_fetch_assoc($resultDetalles)) {
    $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
    $html .= '
            <tr>
                <td>' . $detalle['nombre'] . '</td>
                <td>' . $detalle['cantidad'] . '</td>
                <td>$' . $detalle['precio_unitario'] . '</td>
                <td>$' . $subtotal . '</td>';
}

$html .= '
        </table>
        <p><b>Total: $' . $venta['total'] . '</b></p>
    </div>
</body>
</html>';

// Crear una instancia de Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Opcional) Configurar el tamaño del papel y la orientación
$dompdf->setPaper('A4', 'portrait');

// Renderizar el HTML como PDF
$dompdf->render();

header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="ticket_' . $venta_id . '.pdf"'); // Cambiado a 'attachment'
echo $dompdf->output();
exit;