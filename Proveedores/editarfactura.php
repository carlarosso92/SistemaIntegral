<?php
include '../php/config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

$factura_id = $_GET['id'] ?? null;
$factura = null;

if ($factura_id) {
    // Consulta para obtener los datos de la factura
    $query = "SELECT * FROM facturas_proveedores WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $factura_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $factura = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $factura_id = $_POST['factura_id'];
    $fecha_pago = $_POST['fecha_pago'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $proveedor_id = $_POST['proveedor_id'];

    // Actualizar los datos de la factura
    $query = "UPDATE facturas_proveedores SET fecha_pago = ?, monto = ?, descripcion = ?, proveedor_id = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sdsii', $fecha_pago, $monto, $descripcion, $proveedor_id, $factura_id);

    if ($stmt->execute()) {
        echo "<script>alert('Factura actualizada exitosamente.');window.location.href='listadofacturas.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
    exit();
}

// Consulta para obtener todos los proveedores
$query = "SELECT id, nombre_proveedor FROM proveedores";
$proveedores_result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: auto;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
        }

        h2:hover {
            background-color: #D3E1A4;
            color: #61A502;
            border-radius: 20%;
        }

        form {
            background-color: #E4F2B5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="date"],
        form select,
        form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button {
            width: 100%;
            background-color: #72A603;
            color: yellow;
            border: none;
            padding: 10px 0;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #EAF207;
            color: #72A603;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }

        .validation-message {
            color: red;
            margin: 0;
            padding-left: 10px;
            font-size: small;
        }

        #buttonSubmit:disabled {
            background-color: #ddd;
            color: #666;
            cursor: default;
            pointer-events: none;
        }

        #buttonSubmit:disabled:hover {
            background-color: #ddd;
            color: #666;
        }

        .monto_input {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <form action="editarfactura.php" method="POST">
        <h2>Editar Factura</h2>
        <input type="hidden" name="factura_id" value="<?php echo htmlspecialchars($factura['id'] ?? ''); ?>">

        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <option value="" selected disabled>Seleccionar proveedor</option>
            <?php while ($row = $proveedores_result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php echo isset($factura['proveedor_id']) && $factura['proveedor_id'] == $row['id'] ? 'selected' : ''; ?>><?php echo $row['nombre_proveedor']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="numero_factura">Número de factura:</label>
        <input type="text" name="numero_factura" id="numero_factura" value="<?php echo htmlspecialchars($factura['numero_factura'] ?? ''); ?>" disabled>

        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" name="fecha_pago" id="fecha_pago" value="<?php echo htmlspecialchars($factura['fecha_pago'] ?? ''); ?>" required>

        <div class="monto_input">
            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" value="<?php echo htmlspecialchars($factura['monto'] ?? ''); ?>" required>
            <p id="montoOutput" class="validation-message"></p>
        </div>

        <div>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($factura['descripcion'] ?? ''); ?>" required>
            <p id="descripcionOutput" class="validation-message">La descripcion no puede estar vacía.</p>
        </div>
        <button type="submit" id="buttonSubmit">Guardar Cambios</button>
    </form>
</body>
</html>
