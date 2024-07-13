<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Ventas e Inventario</title>
    <link rel="stylesheet" href="../css/global.css"> <!-- Asegúrate de tener el archivo CSS adecuado -->
    <style>
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 7em 26em auto;
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
            margin: auto;
            margin-top: 1em;
            margin-bottom: 2em;
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
    <h2>Informe de Proveedores</h2>
    <form action="generar_informe.php" method="POST">
        <input type="hidden" name="tipo_informe" value="inventario">
        <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
        <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
    </form>
</body>
</html>
