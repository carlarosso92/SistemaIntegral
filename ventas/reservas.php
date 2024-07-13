<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Listado de reserva</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "../inventario/header.php"; ?>
    <div class="container">
        <h1 class="text-center">LISTADO DE RESERVAS</h1>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">nombre del Cliente</th>
                    <th scope="col">hora de reserva</th>
                    <th scope="col">hora de retiro</th>
                    <th scope="col">Productos</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("../inventario/config/conexion.php");

                // Consulta SQL para obtener el listado de productos con categorías, subcategorías y proveedores
                $sql = "SELECT 
                u.nombre,
                r.hora_reserva, 
                r.hora_retiro, 
                r.total,
                p.id_producto,
                p.nombre AS nombre_producto,,
                dr.cantidad AS cantidad_reservada
            FROM 
                reserva r
            INNER JOIN 
                usuario u ON r.id_usuario = u.id_usuario
            INNER JOIN 
                detalle_reserva dr ON r.id_reserva = dr.id_reserva
            INNER JOIN 
                productos p ON dr.id_producto = p.id_producto";

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($reserva = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <!--<td><?php echo htmlspecialchars($reserva['id']); ?></td>-->
                            <td><?php echo htmlspecialchars($reserva['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['hora_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($producto['hora_retiro']); ?></td>
                            <td><?php echo htmlspecialchars($producto['producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['total']); ?></td>
                            <td>
                                <a href="eliminarproducto.php?id_producto=<?php echo htmlspecialchars($producto['id_producto']); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Si no hay resultados encontrados
                    echo "<tr><td colspan='9'>No se encontraron productos.</td></tr>";
                }

                // Liberar resultado y cerrar la conexión
                $resultado->free();
                $conexion->close();
                ?>
            </tbody>
        </table>
        <div>
            <a href="agregarproducto.php" class="button">Agregar Producto</a>
        </div>
    </div>
</body>

</html>
