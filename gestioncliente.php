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
    <style>
        .main-container {
            display: flex;
            justify-content: space-between;
            margin-top: 90px;
        }

        .left-column, .right-column {
            width: 48%;
        }

        .configuracion-div-form {
            margin-bottom: 20px;
        }

        .listado-row {
            display: none;
        }

        .button {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <main class="contenido">
        <div class="main-container">
            <div class="left-column">
                <div class="employee-section">
                    <div class="employee-info">
                        <div class="details">
                            <div class="name">Cliente: <?php echo ($_SESSION['cliente_nombre']); ?></div>
                        </div>
                    </div>
                    <h2>Datos Personales</h2>

                    <?php
                    include_once("inventario/config/conexion.php");

                    $usuario_id = $_SESSION['usuario_id'];
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
            </div>

            <div class="right-column">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="6" class="table-header">
                                <div class="header-content">
                                    <h2 class="text-center">Listado de reservas</h2>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Código reserva</th>
                            <th scope="col">Hora de Reserva</th>
                            <th scope="col">Hora de Retiro</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require("inventario/config/conexion.php");

                        $sql = "
                            SELECT r.id AS id_reserva, r.hora_reserva, r.hora_retiro, r.total, p.nombre AS producto_nombre, dr.cantidad
                            FROM reservas r
                            INNER JOIN detalle_reservas dr ON r.id = dr.reserva_id
                            INNER JOIN productos p ON dr.producto_id = p.id_producto
                            WHERE r.usuario_id = " . $usuario_id . " AND r.flg_activo = 1
                            ORDER BY id_reserva ASC";

                        $resultado = $conexion->query($sql);

                        if ($resultado->num_rows > 0) {
                            $reservas = [];
                            while ($reserva = $resultado->fetch_assoc()) {
                                $reservas[$reserva['id_reserva']]['info'] = [
                                    'hora_reserva' => $reserva['hora_reserva'],
                                    'hora_retiro' => $reserva['hora_retiro'],
                                    'total' => $reserva['total']
                                ];
                                $reservas[$reserva['id_reserva']]['productos'][] = [
                                    'nombre' => $reserva['producto_nombre'],
                                    'cantidad' => $reserva['cantidad']
                                ];
                            }

                            foreach ($reservas as $id_reserva => $reserva) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($id_reserva); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['hora_reserva']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['hora_retiro']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['total']); ?></td>
                                    <td>
                                        <button class="button" onclick="toggleListado(<?php echo $id_reserva; ?>)">Mostrar/Ocultar Listado</button>
                                    </td>
                                </tr>
                                <tr class="listado-row" id="listado-<?php echo $id_reserva; ?>">
                                    <td colspan="5">
                                        <ul>
                                        <?php
                                            foreach ($reserva['productos'] as $producto) {
                                                echo '<div>';
                                                echo '<input type="checkbox" id="producto-' . htmlspecialchars($producto['nombre']) . '-' . htmlspecialchars($id_reserva) . '" name="productos[]" value="' . htmlspecialchars($producto['nombre']) . '">';
                                                echo '<label for="producto-' . htmlspecialchars($producto['nombre']) . '-' . htmlspecialchars($id_reserva) . '">' . htmlspecialchars($producto['nombre']) . ' - Cantidad: ' . htmlspecialchars($producto['cantidad']) . '</label>';
                                                echo '</div>';
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron reservas.</td></tr>";
                        }

                        $conexion->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer id="contacto">
        <p>&copy; 2024 Don Perico. Todos los derechos reservados.</p>
        <p><a href="formulario_contacto.php">Contáctanos aquí</a></p>
    </footer>

    <script>
        function toggleListado(idReserva) {
            const row = document.getElementById(`listado-${idReserva}`);
            if (row.style.display === 'none' || row.style.display === '') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }
    </script>
</body>

</html>
