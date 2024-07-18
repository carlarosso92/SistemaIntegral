<?php
require 'config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ver_devoluciones.css" />
    <title>Listado de Devoluciones</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>
<body>
<?php include "../inventario/header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="9" class="table-header">
                            <div class="header-content">
                                <h2 class="text-left">Listado de Devoluciones</h2>
                                <div class="button-group">
                                    <a href="registrar_devolucion.php" class="button">Registrar Devolución</a>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">ID Venta</th>
                        <th scope="col">ID Producto</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Monto Devuelto</th>
                        <th scope="col">Fecha Devolución</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Tipo Devolución</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT d.id, d.id_venta, d.id_producto, p.nombre AS nombre_producto, d.cantidad, FLOOR(d.monto_devuelto) AS monto_devuelto, d.fecha_devolucion, d.motivo, d.tipo_devolucion 
                            FROM devoluciones d
                            JOIN productos p ON d.id_producto = p.id_producto";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        while ($devolucion = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($devolucion['id_venta']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['id_producto']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['nombre_producto']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['cantidad']); ?></td>
                                <td><?php echo '$' . htmlspecialchars($devolucion['monto_devuelto']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['fecha_devolucion']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['motivo']); ?></td>
                                <td><?php echo htmlspecialchars($devolucion['tipo_devolucion']); ?></td>
                                <td class="table-actions">
                                    <a href="eliminar_devolucion.php?id=<?php echo $devolucion['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta devolución?');" class="button">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No se encontraron devoluciones.</td></tr>";
                    }

                    $resultado->free();
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
