<?php
include "config/conexion.php";

// Obtener solo los productos con descuentos activos
$sql = "SELECT p.nombre, p.precio, d.valor_descuento, 
        p.precio * (1 - d.valor_descuento / 100) AS precio_con_descuento
        FROM productos p
        INNER JOIN descuentos d ON p.id_producto = d.producto_id 
        WHERE CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin";

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
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
            padding-top: 80px; /* Espacio para el header fijo */
        }

        header {
            background-color: #72A603;
            color: yellow;
            padding: 15px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        img {
            width: 10%;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        h1 {
            margin: 0;
            font-size: 2em;
            font-family: sans-serif;
        }

        .user-options {
            display: flex;
            align-items: center;
        }

        .user-options a {
            background-color: #EAF207;
            color: green;
            padding: 10px 20px;
            border: 1px solid black;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
            text-decoration: none;
            margin-left: 15px;
        }

        .user-options a:hover {
            background-color: #72A603;
            color: #EAF207;
        }

        .user-options .separator {
            border-left: 1px solid yellow;
            height: 20px;
            margin: 0 10px;
        }

        .container {
            width: auto;
            margin: 20px auto;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }

        .table-header {
            background-color: #72A603;
            padding: 10px;
            text-align: center;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header-title {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #E4F2B5;
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #72A603;
            text-decoration: none;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
            color: #EAF207;
            stroke: #333;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #72A603;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: whitesmoke;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #72A603;
            color: #E4F2B5;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include "../inventario/header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="4" class="table-header">
                            <div class="header-content">
                                <h1 class="header-title">Productos con Descuento</h1>
                                <a href="aplicar_descuentos.php" class="button">Agregar descuento a un producto</a>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio Original</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Precio con Descuento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                            echo "<td>$" . htmlspecialchars($row['precio']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['valor_descuento']) . "%</td>";
                            echo "<td>$" . htmlspecialchars(number_format($row['precio_con_descuento'], 2)) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay productos con descuento disponibles.</td></tr>";
                    }
                    mysqli_close($conexion);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
