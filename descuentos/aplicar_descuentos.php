<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Aplicar Descuentos - Don Perico</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 8em 26em auto;
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
            width: calc(100% - 100px);
            padding: 10px;
            margin: center;
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
    <div class="main-container">
        <h2>Aplicar Descuentos</h2>
        <form action="procesar_descuento.php" method="POST">
            <label for="producto">Producto:</label>
            <select id="producto" name="producto_id">
                <?php
                include "../inventario/config/conexion.php";
                $result = mysqli_query($conexion, "SELECT id_producto, nombre FROM productos");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_producto'] . "'>" . $row['nombre'] . "</option>";
                }
                ?>
            </select><br><br>

            <label for="tipo_descuento">Tipo de Descuento:</label>
            <select id="tipo_descuento" name="tipo_descuento">
                <option value="categoria">Categoría</option>
                <option value="producto">Producto</option>
                <option value="marca">Marca</option>
                <option value="dia">Día</option>
            </select><br><br>

            <label for="valor_descuento">Valor del Descuento (%):</label>
            <input type="number" id="valor_descuento" name="valor_descuento" required><br><br>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>

            <input type="submit" value="Aplicar Descuento">
        </form>
    </div>
</body>
</html>
