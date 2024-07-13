<?php
include "config/conexion.php";

// Obtener los productos y sus descuentos si existen
$sql = "SELECT p.nombre, p.precio, d.valor_descuento, 
        CASE 
            WHEN d.valor_descuento IS NOT NULL THEN p.precio * (1 - d.valor_descuento / 100)
            ELSE p.precio
        END AS precio_con_descuento
        FROM productos p
        LEFT JOIN descuentos d ON p.id_producto = d.producto_id 
        AND CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin";

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <title>Productos con Descuento - Don Perico</title>
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
            margin-top: 10px;
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
        .products-section {
            display: flex;
            gap: 20px;
            max-width: 500px;
            margin: auto;
            margin-top: 10px;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        .products-section h3 {
            font-size: 1.2em;
            color: #333;
            margin: 0 0 15px 0;
        }

        .products-section p {
            font-size: 1em;
            color: #555;
            margin: 5px 0;
        }

        .products-section .Precio-Original,
        .products-section .Descuento,
        .products-section .Precio-con-Descuento {
            font-weight: bold;
            font-size: 1.2em;
        }

        .product-box .Precio-con-Descuento {
            color: #e60000;
        }
    </style>
</head>
<body>
    <?php include "../inventario/header.php"; ?>

    <div class="main-container">
        <h2>Productos con Descuento</h2>
        <div class="products-section">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<h3>" . $row['nombre'] . "</h3>";
                    echo "<p>Precio Original: " . "$" . $row['precio'] . "</p>";
                    if ($row['valor_descuento'] != NULL) {
                        echo "<p>Descuento: " . $row['valor_descuento'] . "%</p>";
                        echo "<p>Precio con Descuento: " . "$" . $row['precio_con_descuento'] . "</p>";
                    } else {
                        echo "<p>Precio: " . "$" . $row['precio'] . "</p>";
                    }
                    echo "</div>";
                }
            } else {
                echo "No hay productos disponibles.";
            }
            mysqli_close($conexion);
            ?>
        </div>
    </div>
</body>
</html>


