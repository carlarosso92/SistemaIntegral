<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Ingreso de proveedor</title>
    <link rel="icon" href="Proveedores/img/logo2.png" type="image/png">
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
            margin: auto;
            margin-bottom: 15px;
            color: ;
            background-color: #d5ec9b;
            border-radius: 10px;
        }
        h2:hover {
            background-color:  #72a603;
            color: #333;
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
     
    </style>
<body>
    <form action="ingresar_proveedor.php" method="POST">
        <h2>Ingreso de Proveedor</h2>
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
