<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/proveedorespantalla.css" />
    <title>Listado de Proveedores</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="6" class="table-header">
                            <div class="header-content">
                                <h2 class="text-center">Listado de Proveedores</h2>
                                <a href="Proveedores/crudproveedores.php" class="button">Agregar Proveedor</a>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Proveedor</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de configuración para la conexión a la base de datos
                    require("inventario/config/conexion.php");

                    // Consulta SQL para obtener el listado de proveedores
                    $sql = "SELECT id, nombre_proveedor, contacto_proveedor, telefono_proveedor, email_proveedor FROM proveedores";

                    // Ejecutar la consulta
                    $resultado = $conexion->query($sql);

                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        // Iterar sobre los resultados obtenidos
                        while ($proveedor = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($proveedor['id']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['contacto_proveedor']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['telefono_proveedor']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['email_proveedor']); ?></td>
                                <td>
                                    <a href="editarproveedor.php?id=<?php echo htmlspecialchars($proveedor['id']); ?>">Editar</a>
                                    <a href="eliminarproveedor.php?id=<?php echo htmlspecialchars($proveedor['id']); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Si no hay resultados encontrados
                        echo "<tr><td colspan='6'>No se encontraron proveedores.</td></tr>";
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
