<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta a Dompdf y PhpSpreadsheet sea correcta
require '../php/config.php'; // Archivo de c

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID Devolución');
$sheet->setCellValue('B1', 'ID Venta');
$sheet->setCellValue('C1', 'ID Producto');
$sheet->setCellValue('D1', 'Cantidad');
$sheet->setCellValue('E1', 'Monto Devuelto');
$sheet->setCellValue('F1', 'Fecha Devolución');
$sheet->setCellValue('G1', 'Motivo');
$sheet->setCellValue('H1', 'Tipo Devolución');

$sql = "SELECT * FROM devoluciones";
$result = $conexion->query($sql);

$rowNum = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNum, $row['id']);
    $sheet->setCellValue('B' . $rowNum, $row['id_venta']);
    $sheet->setCellValue('C' . $rowNum, $row['id_producto']);
    $sheet->setCellValue('D' . $rowNum, $row['cantidad']);
    $sheet->setCellValue('E' . $rowNum, $row['monto_devuelto']);
    $sheet->setCellValue('F' . $rowNum, $row['fecha_devolucion']);
    $sheet->setCellValue('G' . $rowNum, $row['motivo']);
    $sheet->setCellValue('H' . $rowNum, $row['tipo_devolucion']);
    $rowNum++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'devoluciones_' . date('Y-m-d_H-i-s') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit();
?>
