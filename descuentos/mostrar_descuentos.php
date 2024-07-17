<?php
include "config/conexion.php";

// Obtener solo los productos con descuentos activos
$sql = "SELECT p.nombre, p.precio, d.id, d.valor_descuento, 
        FLOOR(p.precio * (1 - d.valor_descuento / 100)) AS precio_con_descuento, d.fecha_fin
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
    <link rel="stylesheet" href="css/mostrar_producto.css">
    <title>Productos con descuentos - Don Perico</title>
</head>
<body>
    <?php include "../inventario/header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="6" class="table-header">
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
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Acciones</th>
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
                            echo "<td>$" . htmlspecialchars($row['precio_con_descuento']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha_fin']) . "</td>";
                            echo "<td class='actions'>
                                    <a href='editar_descuento.php?id=" . htmlspecialchars($row['id']) . "' class='edit-button'>Editar</a>
                                    <a href='eliminar_descuento.php?id=" . htmlspecialchars($row['id']) . "' class='delete-button' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este descuento?\");'>Eliminar</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay productos con descuento disponibles.</td></tr>";
                    }
                    mysqli_close($conexion);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
