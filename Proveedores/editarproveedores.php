<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
        }

        h2 {
            color: #72A603;
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: auto;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        form {
            max-width: 500px;
            margin: 5em auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form button {
            display: block;
            margin: 1.5em auto 0;
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
    </style>
</head>
<body>
    <?php
    // Incluir el archivo de configuración para la conexión a la base de datos
    require("config/conexion.php");

    // Obtener el ID del proveedor a editar
    $id = $_GET['id'];

    // Consulta SQL para obtener los datos del proveedor
    $sql = "SELECT nombre_proveedor, contacto_proveedor, telefono_proveedor, email_proveedor FROM proveedores WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $proveedor = $resultado->fetch_assoc();

    // Verificar si se encontraron resultados
    if (!$proveedor) {
        echo "<p>No se encontró el proveedor.</p>";
        exit;
    }
    ?>
    <form action="actualizar_proveedor.php" method="POST">
        <h2>Editar Proveedor</h2>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        
        <label for="nombre">Nombre del Proveedor:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?>" required><br>
        
        <label for="contacto">Contacto:</label><br>
        <input type="text" id="contacto" name="contacto" value="<?php echo htmlspecialchars($proveedor['contacto_proveedor']); ?>"><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono_proveedor" value="<?php echo htmlspecialchars($proveedor['telefono_proveedor']); ?>"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email_proveedor" value="<?php echo htmlspecialchars($proveedor['email_proveedor']); ?>"><br>
        
        <button type="submit">Actualizar Proveedor</button>
    </form>
    <?php
    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
    ?>
</body>
</html>
