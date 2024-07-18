<?php
require 'config/conexion.php';

// Consulta para obtener los IDs de las ventas
$sqlVentas = "SELECT id FROM ventas";
$resultadoVentas = $conexion->query($sqlVentas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Devolución</title>
    <link rel="stylesheet" href="css/registro_devolucion.css">
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Knewave:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
</head>
<body>
    <div class="configuracion-div-form">
        <div class="centrar-form">
            <form action="procesar_devolucion.php" method="POST">
                <h2>Registrar Devolución</h2>
                
                <label for="id_venta">ID de Venta:</label>
                <select name="id_venta" required>
                    <option value="" disabled selected>Seleccionar ID de Venta</option>
                    <?php
                    if ($resultadoVentas->num_rows > 0) {
                        while ($venta = $resultadoVentas->fetch_assoc()) {
                            echo "<option value='" . $venta['id'] . "'>" . $venta['id'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No hay ventas disponibles</option>";
                    }
                    ?>
                </select>
                
                <label for="id_producto">ID de Producto:</label>
                <input type="number" name="id_producto" required>
                
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" required>
                
                <label for="monto_devuelto">Monto Devuelto:</label>
                <input type="number" step="0.01" name="monto_devuelto" required>
                
                <label for="motivo">Motivo:</label>
                <textarea name="motivo" required></textarea>
                
                <label for="tipo_devolucion">Tipo de Devolución:</label>
                <select name="tipo_devolucion" required>
                    <option value="devolucion">Devolución</option>
                    <option value="cambio">Cambio</option>
                </select>
                
                <button type="submit">Procesar Devolución</button>
            </form>
        </div>
    </div>
</body>
</html>
