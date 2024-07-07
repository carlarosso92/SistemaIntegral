<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta a Dompdf sea correcta
use Dompdf\Dompdf;

include '../php/config.php';

if (isset($_GET['venta_id'])) {
    $venta_id = $_GET['venta_id'];

    // Obtener datos de la venta
    $queryVenta = "SELECT * FROM ventas WHERE id = $venta_id";
    $resultVenta = mysqli_query($conexion, $queryVenta);
    $venta = mysqli_fetch_assoc($resultVenta);

    // Obtener detalles de la venta
    $queryDetalles = "SELECT dv.*, p.nombre FROM detalle_ventas dv INNER JOIN productos p ON dv.producto_id = p.id_producto WHERE dv.venta_id = $venta_id";
    $resultDetalles = mysqli_query($conexion, $queryDetalles);

    // Generar el contenido HTML para el PDF
    $html = '<h1>Ticket de Compra</h1>';
    $html .= '<p>Número de Ticket: ' . $venta_id . '</p>';
    $html .= '<p>Fecha: ' . $venta['fecha_venta'] . '</p>';
    $html .= '<p>Total: $' . $venta['total'] . '</p>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">';
    $html .= '<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr>';

    while ($detalle = mysqli_fetch_assoc($resultDetalles)) {
        $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
        $html .= '<tr>';
        $html .= '<td>' . $detalle['nombre'] . '</td>';
        $html .= '<td>' . $detalle['cantidad'] . '</td>';
        $html .= '<td>$' . $detalle['precio_unitario'] . '</td>';
        $html .= '<td>$' . $subtotal . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el HTML como PDF
    $dompdf->render();

    // Enviar el PDF al navegador
    $dompdf->stream("ticket_$venta_id.pdf", array("Attachment" => 0));
} else {
    echo "No se ha proporcionado un ID de venta.";
}
?>
