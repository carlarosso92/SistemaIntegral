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
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Ingreso de proveedor</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
        }
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 2em 26em auto;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover{
            background-color: #D3E1A4;
            color: #61A502;
        }

        form {
            max-width: 500px;
            margin: 2em auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"] {
            width: calc(60% - 10px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form button {
            margin-top: 1.5em;
            background-color: #72A603;
            color: yellow;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #EAF207;
            color: #72A603;
        }

        textarea {
            width: 60%;
            heigth: 100%;
        }
    </style>
<body>
    <h2>Registrar Pago a Proveedor</h2>
    <form action="guardarpago.php" method="POST">
        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_proveedor']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <br>
        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" name="fecha_pago" id="fecha_pago" required>
        <br>
        <br>
        <label for="monto">Monto:</label>
        <input type="text" name="monto" id="monto" required>
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <button type="submit">Registrar Pago</button>
    </form>
</body>
</html>