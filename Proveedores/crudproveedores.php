<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso de Proveedor</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Ingreso de Proveedor</h2>
    <form action="ingresar_proveedor.php" method="POST">
        <label for="nombre">Nombre del Proveedor:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        
        <label for="contacto">Contacto:</label><br>
        <input type="text" id="contacto" name="contacto"><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono_proveedor"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email_proveedor"><br>
        
        <button type="submit">Ingresar Proveedor</button>
    </form>
</body>
</html>
