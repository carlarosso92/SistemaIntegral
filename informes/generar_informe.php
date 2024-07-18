<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta a Dompdf y PhpSpreadsheet sea correcta
require '../php/config.php'; // Archivo de conexión a la base de datos

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$tipo_informe = $_POST['tipo_informe'];
$formato = $_POST['formato'];

// Conexión a la base de datos
$conexion = mysqli_connect($server, $usuario, $contraseña, $db) or die("Error en la conexión");

if ($tipo_informe == 'ventas') {
    $fecha_hoy = date('Y-m-d');
    $query = "SELECT v.id, v.fecha_venta, v.total, u.nombre AS cliente, p.nombre AS producto, dv.cantidad, dv.precio_unitario
              FROM ventas v
              LEFT JOIN clientes c ON v.cliente_id = c.id
              LEFT JOIN usuarios u ON c.usuario_id = u.usuario_id
              LEFT JOIN detalle_ventas dv ON v.id = dv.venta_id
              LEFT JOIN productos p ON dv.producto_id = p.id_producto";
    $titulo = "Informe de Ventas";
} else if ($tipo_informe == 'inventario') {
    $query = "SELECT p.nombre, p.descripcion, p.cantidad_stock, p.fecha_vencimiento, p.precio, pr.nombre_proveedor
              FROM productos p
              LEFT JOIN proveedores pr ON p.id_proveedor = pr.id";
    $titulo = "Informe de Inventario";
} else if ($tipo_informe == 'proveedores') {
    $query = "SELECT
        fp.numero_factura,
        fp.fecha_pago,
        p.nombre_proveedor,
        fp.monto,
        IF(fp.flagpagado = 1, 'Pagado', 'No Pagado') as estado
    FROM
        facturas_proveedores fp
    LEFT JOIN proveedores p ON fp.proveedor_id = p.id";
    $titulo = "Estado de cuenta proveedores";
} else if ($tipo_informe == 'devoluciones') {
    $query = "SELECT d.id, d.id_venta, d.id_producto, d.cantidad, d.monto_devuelto, d.fecha_devolucion, d.motivo, d.tipo_devolucion
              FROM devoluciones d";
    $titulo = "Informe de Devoluciones";
}

$result = mysqli_query($conexion, $query);

if ($formato == 'pdf') {
    // Generar el contenido HTML para el PDF
    $html = "<h1>$titulo</h1>";
    $html .= '<table border="1" cellpadding="10">
                <thead>
                    <tr>';
    if ($tipo_informe == 'ventas') {
        $html .= '<th>ID Venta</th>
                  <th>Fecha Venta</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>';
    } else if ($tipo_informe == 'inventario') {
        $html .= '<th>Producto</th>
                  <th>Descripción</th>
                  <th>Stock Actual</th>
                  <th>Fecha de Vencimiento</th>
                  <th>Precio</th>
                  <th>Proveedor</th>';
    } else if ($tipo_informe == 'proveedores') {
        $html .= '<th>Numero factura</th>
                  <th>Fecha pago</th>
                  <th>Proveedor</th>
                  <th>Monto</th>
                  <th>Estado</th>';
    } else if ($tipo_informe == 'devoluciones') {
        $html .= '<th>ID Devolución</th>
                  <th>ID Venta</th>
                  <th>ID Producto</th>
                  <th>Cantidad</th>
                  <th>Monto Devuelto</th>
                  <th>Fecha Devolución</th>
                  <th>Motivo</th>
                  <th>Tipo Devolución</th>';
    }
    $html .= '</tr></thead><tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        if ($tipo_informe == 'ventas') {
            $html .= '<td>' . $row['id'] . '</td>
                      <td>' . $row['fecha_venta'] . '</td>
                      <td>' . $row['producto'] . '</td>
                      <td>' . $row['cantidad'] . '</td>
                      <td>' . $row['precio_unitario'] . '</td>';
        } else if ($tipo_informe == 'inventario') {
            $html .= '<td>' . $row['nombre'] . '</td>
                      <td>' . $row['descripcion'] . '</td>
                      <td>' . $row['cantidad_stock'] . '</td>
                      <td>' . $row['fecha_vencimiento'] . '</td>
                      <td>' . $row['precio'] . '</td>
                      <td>' . $row['nombre_proveedor'] . '</td>';
        } else if ($tipo_informe == 'proveedores') {
            $html .= '<td>' . $row['numero_factura'] . '</td>
                      <td>' . $row['fecha_pago'] . '</td>
                      <td>' . $row['nombre_proveedor'] . '</td>
                      <td>' . $row['monto'] . '</td>
                      <td>' . $row['estado'] . '</td>';
        } else if ($tipo_informe == 'devoluciones') {
            $html .= '<td>' . $row['id'] . '</td>
                      <td>' . $row['id_venta'] . '</td>
                      <td>' . $row['id_producto'] . '</td>
                      <td>' . $row['cantidad'] . '</td>
                      <td>' . $row['monto_devuelto'] . '</td>
                      <td>' . $row['fecha_devolucion'] . '</td>
                      <td>' . $row['motivo'] . '</td>
                      <td>' . $row['tipo_devolucion'] . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Renderizar el HTML como PDF
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Salida del PDF generado al navegador
    $dompdf->stream("$titulo.pdf");
} else if ($formato == 'excel') {
    // Crear una instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle($titulo);

    // Agregar los encabezados
    if ($tipo_informe == 'ventas') {
        $sheet->setCellValue('A1', 'ID Venta');
        $sheet->setCellValue('B1', 'Fecha Venta');
        $sheet->setCellValue('C1', 'Producto');
        $sheet->setCellValue('D1', 'Cantidad');
        $sheet->setCellValue('E1', 'Precio Unitario');
    } else if ($tipo_informe == 'inventario') {
        $sheet->setCellValue('A1', 'Producto');
        $sheet->setCellValue('B1', 'Descripción');
        $sheet->setCellValue('C1', 'Stock Actual');
        $sheet->setCellValue('D1', 'Fecha de Vencimiento');
        $sheet->setCellValue('E1', 'Precio');
        $sheet->setCellValue('F1', 'Proveedor');
    } else if ($tipo_informe == 'proveedores') {
        $sheet->setCellValue('A1', 'Numero factura');
        $sheet->setCellValue('B1', 'Fecha pago');
        $sheet->setCellValue('C1', 'Proveedor');
        $sheet->setCellValue('D1', 'Monto');
        $sheet->setCellValue('E1', 'Estado');
    } else if ($tipo_informe == 'devoluciones') {
        $sheet->setCellValue('A1', 'ID Devolución');
        $sheet->setCellValue('B1', 'ID Venta');
        $sheet->setCellValue('C1', 'ID Producto');
        $sheet->setCellValue('D1', 'Cantidad');
        $sheet->setCellValue('E1', 'Monto Devuelto');
        $sheet->setCellValue('F1', 'Fecha Devolución');
        $sheet->setCellValue('G1', 'Motivo');
        $sheet->setCellValue('H1', 'Tipo Devolución');
    }

    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['argb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => '72A603'],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];

    $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

    // Agregar los datos
    $rowNumber = 2;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($tipo_informe == 'ventas') {
            $sheet->setCellValue('A' . $rowNumber, $row['id']);
            $sheet->setCellValue('B' . $rowNumber, $row['fecha_venta']);
            $sheet->setCellValue('C' . $rowNumber, $row['cliente']);
            $sheet->setCellValue('D' . $rowNumber, $row['producto']);
            $sheet->setCellValue('E' . $rowNumber, $row['cantidad']);
            $sheet->setCellValue('F' . $rowNumber, $row['precio_unitario']);
            $sheet->setCellValue('G' . $rowNumber, $row['total']);
        } else if ($tipo_informe == 'inventario') {
            $sheet->setCellValue('A' . $rowNumber, $row['nombre']);
            $sheet->setCellValue('B' . $rowNumber, $row['descripcion']);
            $sheet->setCellValue('C' . $rowNumber, $row['cantidad_stock']);
            $sheet->setCellValue('D' . $rowNumber, $row['fecha_vencimiento']);
            $sheet->setCellValue('E' . $rowNumber, $row['precio']);
            $sheet->setCellValue('F' . $rowNumber, $row['nombre_proveedor']);
        } else if ($tipo_informe == 'proveedores') {
            $sheet->setCellValue('A' . $rowNumber, $row['numero_factura']);
            $sheet->setCellValue('B' . $rowNumber, $row['fecha_pago']);
            $sheet->setCellValue('C' . $rowNumber, $row['nombre_proveedor']);
            $sheet->setCellValue('D' . $rowNumber, $row['monto']);
            $sheet->setCellValue('E' . $rowNumber, $row['estado']);
        } else if ($tipo_informe == 'devoluciones') {
            $sheet->setCellValue('A' . $rowNumber, $row['id']);
            $sheet->setCellValue('B' . $rowNumber, $row['id_venta']);
            $sheet->setCellValue('C' . $rowNumber, $row['id_producto']);
            $sheet->setCellValue('D' . $rowNumber, $row['cantidad']);
            $sheet->setCellValue('E' . $rowNumber, $row['monto_devuelto']);
            $sheet->setCellValue('F' . $rowNumber, $row['fecha_devolucion']);
            $sheet->setCellValue('G' . $rowNumber, $row['motivo']);
            $sheet->setCellValue('H' . $rowNumber, $row['tipo_devolucion']);
        }
        $rowNumber++;
    }

    // Aplicar estilos a los datos
    $dataStyle = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];

    $sheet->getStyle('A2:H' . $rowNumber)->applyFromArray($dataStyle);

    // Ajustar el ancho de las columnas
    foreach (range('A', 'H') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Establecer el encabezado para la descarga del archivo
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $titulo . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit();
}
?>
