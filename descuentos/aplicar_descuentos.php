<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Aplicar Descuentos - Don Perico</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>

body {
    font-family: sans-serif;
    margin: 0;
    background-color: #F2EDD0;
}
        .main-container {
            margin-top: 100px; /* Margen superior para evitar solapamiento con el header */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Añadir sombra */
        }

        form h2 {
            font-style: normal;
            text-align: center;
            color: #72A603;
            background-color: #E4F2B5;
            border-radius: 10px;
            margin-bottom: 20px;
        }
      
        form label {
            display: block;
            margin-bottom: 5px;
            color: #72A603;
        }

        form select,
        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
            background-color: #fff;
        }

        form input[type="submit"],
        form button {
            width: 100%;
            padding: 10px;
            border: 1px solid #72A603;
            border-radius: 20px;
            background-color: #72A603;
            color: yellow;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }


     

        .validation-message {
            color: red;
            margin: 0;
            padding-left: 10px;
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
            background-color: #ddd;
            color: #666;
            cursor: default;
            pointer-events: none;
        }

        /* Estilo adicional para deshabilitar el efecto de hover */
        #buttonSubmit:disabled:hover {
            background-color: #ddd;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <form action="procesar_descuento.php" method="POST">
            <h2>Aplicar Descuentos</h2>
            <label for="producto">Producto:</label>
            <select id="producto" name="producto_id" required>
                <option value="">Seleccionar producto</option>
                <?php
                include "../inventario/config/conexion.php";
                $result = mysqli_query($conexion, "SELECT id_producto, nombre FROM productos");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_producto'] . "'>" . $row['nombre'] . "</option>";
                }
                ?>
            </select>



            <label for="valor_descuento">Valor del Descuento (%):</label>
            <input type="number" id="valor_descuento" name="valor_descuento" required>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>

            <input type="submit" value="Aplicar Descuento">
        </form>
    </div>
</body>
</html>
