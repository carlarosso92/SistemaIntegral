<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Ventas e Inventario</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="../informes/css/global.css"> <!-- Asegúrate de tener el archivo CSS adecuado -->
    <style>
   
        h1.tituloh1 {
            border: 1px solid #72A603;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            margin: 10vh auto;
            font-style: normal;
            text-align: center;
            color: #E4F2B5;
            background-color: #72A603;
            border-radius: 10px;
        }

        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: auto;
            color: #333;
            background-color: #E4F2B5;
            border-radius: 10px;
        }
        h2:hover{
            background-color: #72A603;
            color: yellow;
        }
        
        form {
            min-height: 15vh;
            max-width: 80vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            margin: 10vh auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"]
         {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: center;
            margin-left: 20px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
            background-color: #72A603;
            color: yellow;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: blue;
            color: white;
        }
        form button {
            margin-top: 1.5em;
            margin: 20px 32px 10px;
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

        .validation-message {
            color: red;
            margin: 0;
            padding-left: 10px; /* Ajusta este valor según tus necesidades */
            display: inline-block;
            vertical-align: middle;
            margin-top: -40px;
            font-size: small;
        }

        input[type="text"] {
            display: inline-block;
            vertical-align: middle;
        }
        /* Estilo para el botón "Guardar" cuando está deshabilitado */
        #buttonSubmit:disabled {
            background-color: #ddd; /* Color de fondo gris */
            color: #666; /* Color de texto gris */
            cursor: default; /* Cursor predeterminado */
            pointer-events: none; /* Evitar eventos de puntero */
        }

        /* Estilo adicional para deshabilitar el efecto de hover */
        #buttonSubmit:disabled:hover {
            background-color: #ddd; /* Mantener el color de fondo gris */
            color: #666; /* Mantener el color de texto gris */
        }
    </style>
</head>
<body>
<?php include "../inventario/header.php"; ?>
    <div class="tituloh1">
        <h1>Generar Informes</h1>
    </div>
    
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="ventas">
        <h2>Informe de Ventas Diarias</h2>
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
    
    
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="inventario">
        <h2>Informe de Inventario</h2>
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
    
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="inventario">
        <h2>Informe de Proveedores</h2>
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
</body>
</html>
