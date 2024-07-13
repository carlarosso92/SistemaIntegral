<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: crudlogincliente.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ventanacliente.css">
    <?php include "headerindex.php"; ?>
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
</head>

<body>
    <main class="contenido">
        <div class="employee-section">
            <div class="employee-info">
                <div class="details">
                    <div class="name">Cliente: <?php echo ($_SESSION['cliente_nombre']); ?></div>
                    
                </div>
            </div>
            <h2>Datos Personales</h2>

            <?php
            include_once("inventario/config/conexion.php");

            $usuario_id = $_SESSION['usuario_id']; // Usar la ID del usuario de la sesión
            $sql_usuario = "
                SELECT u.nombre, u.email, u.rut, c.telefono, c.direccion
                FROM usuarios u
                INNER JOIN clientes c ON u.usuario_id = c.usuario_id
                WHERE u.usuario_id = " . $usuario_id;
            $resultado_usuario = $conexion->query($sql_usuario);

            if ($resultado_usuario && $resultado_usuario->num_rows > 0) {
                $usuario = $resultado_usuario->fetch_assoc();
            } else {
                echo "Usuario no encontrado";
                exit;
            }
            ?>
            <div class="configuracion-div-form">
                <div class="centrar-form">
                    <form action="actualizarcliente.php" method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                        Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required><br>
                        Email: <input type="text" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>
                        Rut: <input type="text" name="rut" value="<?php echo htmlspecialchars($usuario['rut']); ?>" required><br>
                        Teléfono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required><br>
                        Dirección: <input type="text" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>" required><br>
                        <button type="submit">Editar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="container">
        <h2>Reservas activas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Hora de Reserva</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("inventario/config/conexion.php");

                // Consulta SQL para obtener el listado de reservas con detalles de reservas y productos
                $sql = "
                    SELECT r.hora_reserva, u.nombre AS nombre_cliente, p.nombre AS nombre_producto, dr.cantidad, r.id
                    FROM reservas r
                    INNER JOIN usuarios u ON r.usuario_id = u.usuario_id
                    INNER JOIN detalle_reservas dr ON r.id = dr.reserva_id
                    INNER JOIN productos p ON dr.producto_id = p.id_producto";

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($reserva = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['nombre_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['hora_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['nombre_producto']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['cantidad']); ?></td>
                            <td>
                                <a href="" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No se encontraron reservas.</td></tr>";
                }

                // Cerrar la conexión
                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
