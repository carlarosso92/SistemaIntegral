<?php
include '../php/config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

// Consulta para obtener todos los proveedores
$query = "SELECT id, nombre_proveedor FROM proveedores";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de proveedor</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <script src="../js/validacionFormularios.js"></script>
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
    <form action="guardarpago.php" method="POST">
        <h2>Registrar Pago a Proveedor</h2>
        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_proveedor']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" name="fecha_pago" id="fecha_pago" required>
        <div class="monto_input">
            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" value="0" required>
            <p id="montoOutput" class="validation-message"></p>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <p id="descripcionOutput" class="validation-message">La descripcion no puede estar vacía.</p>
        </div>
        <button type="submit" id="buttonSubmit">Registrar Pago</button>
    </form>
</body>
