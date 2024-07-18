<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Ventas e Inventario</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="../css/global.css"> <!-- Asegúrate de tener el archivo CSS adecuado -->
    <style>
        body {
        
            background-color: #F2EDD0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        
        }

        .formulario-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
          margin-top: 105px;
        }

        .formulario {
            background-color: #E4F2B5;
            border: 1px solid #72A603;
            border-radius: 10px;
            padding: 20px;
            max-width: 300px;
            flex: 1 1 calc(33.333% - 40px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .formulario h2 {
            color: #72A603;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5em;
            background-color: #E4F2B5;
            border-radius: 10px;
            padding: 10px;
        }

        .formulario h2:hover {
            background-color: #D3E1A4;
            color: #61A502;
        }

        .formulario button {
            width: 100%;
            background-color: #72A603;
            color: #F2EDD0;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .formulario button:hover {
            background-color: #EAF207;
            color: #72A603;
        }
    </style>
</head>
<body>
<?php include "../inventario/header.php"; ?>
    <h1>Generar Informes</h1>
    
    <div class="formulario-container">
        <div class="formulario">
            <h2>Informe de Ventas</h2>
            <form action="generar_informe.php" method="POST">
                <input type="hidden" name="tipo_informe" value="ventas">
                <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
                <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
            </form>
        </div>
        
        <div class="formulario">
            <h2>Informe de Inventario</h2>
            <form action="generar_informe.php" method="POST">
                <input type="hidden" name="tipo_informe" value="inventario">
                <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
                <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
            </form>
        </div>
        
        <div class="formulario">
            <h2>Informe de Proveedores</h2>
            <form action="generar_informe.php" method="POST">
                <input type="hidden" name="tipo_informe" value="proveedores">
                <button type="submit" name="formato" value="pdf">Descargar Informe PDF</button>
                <button type="submit" name="formato" value="excel">Descargar Informe Excel</button>
            </form>
        </div>
    </div>
</body>
</html>
