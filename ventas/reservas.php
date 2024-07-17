<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="css/reservas.css">
    <title>Listado de reserva</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "../inventario/header.php"; ?>
    <main>
        <div class="contenedor-ventas">
            <div class="productos">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="6"><h2>Listado de reservas</h2></th>
                        </tr>
                        <tr>
                            <th scope="col">Código reserva</th>
                            <th scope="col">Nombre cliente</th>
                            <th scope="col">Hora reserva</th>
                            <th scope="col">Hora retiro</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Incluir el archivo de configuración para la conexión a la base de datos
                        require("../inventario/config/conexion.php");

                        // Consulta SQL para obtener el listado de reservas con detalles de productos
                        $sql = "SELECT
                                    r.id AS id_reserva,
                                    u.nombre,
                                    r.hora_reserva,
                                    r.hora_retiro,
                                    r.total,
                                    p.nombre AS producto_nombre,
                                    dr.cantidad
                                FROM
                                    reservas r
                                INNER JOIN usuarios u ON r.usuario_id = u.usuario_id
                                INNER JOIN detalle_reservas dr ON r.id = dr.reserva_id
                                INNER JOIN productos p ON dr.producto_id = p.id_producto
                                WHERE
                                    r.flg_activo = 1
                                ORDER BY
                                    id_reserva ASC";

                        // Ejecutar la consulta
                        $resultado = $conexion->query($sql);

                        // Verificar si se encontraron resultados
                        if ($resultado->num_rows > 0) {
                            // Iterar sobre los resultados obtenidos
                            $reservas = [];
                            while ($reserva = $resultado->fetch_assoc()) {
                                $reservas[$reserva['id_reserva']]['info'] = [
                                    'nombre' => $reserva['nombre'],
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
                                    <td><?php echo htmlspecialchars($reserva['info']['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['hora_reserva']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['hora_retiro']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['info']['total']); ?></td>
                                    <td>
                                        <button class="button" onclick="procesarAnularReserva(<?php echo $id_reserva; ?>, 'procesar')">Procesar</button>
                                        <button class="button" onclick="procesarAnularReserva(<?php echo $id_reserva; ?>, 'anular')">Anular</button>
                                        <button class="button" onclick="toggleListado(<?php echo $id_reserva; ?>)">Mostrar/Ocultar Listado</button>
                                    </td>
                                </tr>
                                <tr class="listado-row" id="listado-<?php echo $id_reserva; ?>" style="display: none;">
                                    <td colspan="6">
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
                            // Si no hay resultados encontrados
                            echo "<tr><td colspan='6'>No se encontraron reservas.</td></tr>";
                        }

                        // Liberar resultado y cerrar la conexión
                        $resultado->free();
                        $conexion->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        function procesarAnularReserva(idReserva, tipoOperacion) {
            // Crear un objeto FormData para enviar los datos
            const formData = new FormData();
            formData.append('id_reserva', idReserva);
            formData.append('tipo_operacion', tipoOperacion);

            // Enviar una solicitud POST al archivo PHP
            fetch('terminareserva.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Asumiendo que el PHP devuelve JSON
            .then(data => {
                if(tipoOperacion == "procesar"){
                    // Realizar la solicitud AJAX para generar el PDF
                    fetch('generar_ticket.php')
                        .then(response => response.blob())
                        .then(blob => {
                            const pdfUrl = URL.createObjectURL(blob);
                            window.open(pdfUrl, '_blank');
                        })
                        .catch(error => {
                            console.error('Error al generar el ticket:', error);
                            alert('Hubo un problema al generar el ticket. Por favor, inténtalo de nuevo.');
                        });
                }

                // Manejar la respuesta del servidor (por ejemplo, mostrar un mensaje)
                alert(data.mensaje);

                // Recargar la página si la operación fue exitosa
                //if (data.exito) {
                  location.reload();
                //}
            })
            .catch(error => {
                console.error('Error:', error);
                // Manejar el error (por ejemplo, mostrar un mensaje al usuario)
            });
        }

        function toggleListado(idReserva) {
            const row = document.getElementById(`listado-${idReserva}`);
            row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
</body>

</html>
