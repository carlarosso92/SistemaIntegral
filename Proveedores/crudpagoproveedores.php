<?php
include '../php/config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

// Consulta para obtener todos los proveedores
$query = "SELECT id, nombre_proveedor FROM proveedores";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Pago a Proveedor</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h2>Registrar Pago a Proveedor</h2>
    <form action="guardarpago.php" method="POST">
        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_proveedor']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" name="fecha_pago" id="fecha_pago" required>

        <label for="monto">Monto:</label>
        <input type="text" name="monto" id="monto" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <button type="submit">Registrar Pago</button>
    </form>
</body>
</html>