<?php
include '../inventario/config/conexion.php'; // Ajusta la ruta según la estructura de tu proyecto

// Si se recibe una solicitud para marcar una factura como pagada
if (isset($_GET['id'])) {
    $factura_id = $_GET['id'];

    // Consulta para actualizar el estado de pago de la factura
    $query = "UPDATE facturas_proveedores SET flagpagado = 1 WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $factura_id);

    if ($stmt->execute()) {
        echo "<script>alert('La factura ha sido marcada como pagada.');window.location.href='listadofacturas.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Consulta SQL para obtener el listado de facturas
$sql = "
    SELECT 
        fp.id AS id,
        fp.numero_factura AS numero_factura,
        fp.monto AS monto,
        fp.fecha_pago AS vencimiento_factura,
        fp.flagpagado AS pagado,
        p.nombre_proveedor AS proveedor
    FROM 
        facturas_proveedores fp
    JOIN
        proveedores p ON fp.proveedor_id = p.id
    WHERE 
        fp.flagpagado = 0";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos generales */
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
            padding-top: 112px; /* Espacio para el header fijo */
        }

        /* Encabezado */
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

        /* Header Container */
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        h1, h2 {
            margin: 0;
            font-size: 1.5em;
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
            width: 90%; /* Ajusta este valor para cambiar el ancho de la tabla */
            max-width: 1200px; /* Ancho máximo */
            margin: 20px auto;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        }

        .header-content h1, .header-content h2 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .header-content h1:hover, .header-content h2:hover {
            background-color: rgb(234, 234, 76);
            color: #333;
        }

        .table th, .table td {
            border: 1px solid #72A603; /* Color del borde */
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
            background-color: rgb(167, 191, 57);
            text-decoration: none;
        }

        form {
            max-width: 500px;
            margin: 2em auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="date"],
        form select,
        form textarea {
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

        #buttonSubmit:disabled {
            background-color: #ddd;
            color: #666;
            cursor: default;
            pointer-events: none;
        }

        #buttonSubmit:disabled:hover {
            background-color: #ddd;
            color: #666;
        }
    </style>
    <title>Listado de Facturas</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "../inventario/header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="7" class="table-header">
                            <div class="header-content">
                                <h2 class="text-center">Listado de Facturas</h2>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Número de Factura</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        // Iterar sobre los resultados obtenidos
                        while ($factura = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($factura['id']); ?></td>
                                <td><?php echo htmlspecialchars($factura['proveedor']); ?></td>
                                <td><?php echo htmlspecialchars($factura['numero_factura']); ?></td>
                                <td><?php echo htmlspecialchars($factura['monto']); ?></td>
                                <td><?php echo htmlspecialchars($factura['vencimiento_factura']); ?></td>
                                <td><?php echo $factura['pagado'] == 1 ? 'Pagado' : 'Pendiente'; ?></td>
                                <td>
                                    <?php if ($factura['pagado'] == 0): ?>
                                        <a href="listadofacturas.php?id=<?php echo htmlspecialchars($factura['id']); ?>" onclick="return confirm('¿Estás seguro de que deseas marcar esta factura como pagada?');">Pagado</a>
                                    <?php else: ?>
                                        Pagado
                                    <?php endif; ?>
                                    <a href="editarfactura.php?id=<?php echo htmlspecialchars($factura['id']); ?>">Editar Detalles</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Si no hay resultados encontrados
                        echo "<tr><td colspan='7'>No se encontraron facturas pendientes de pago.</td></tr>";
                    }

                    // Liberar resultado y cerrar la conexión
                    $resultado->free();
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
