<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Ventas e Inventario</title>
    <link rel="stylesheet" href="../css/global.css"> <!-- Asegúrate de tener el archivo CSS adecuado -->
</head>
<body>
<?php include "header.php"; ?>
    <h1>Generar Informes</h1>
    
    <h2>Informe de Ventas Diarias</h2>
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="ventas">
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
    
    <h2>Informe de Inventario</h2>
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="inventario">
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
</body>
</html>
