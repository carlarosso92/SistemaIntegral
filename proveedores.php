<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/index.css" />
    <title>Listado de empleados</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
        <h1 class="text-center">LISTADO DE PROVEEDORES</h1>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <!--<th scope="col">ID</th>-->
                    <th scope="col">contacto</th>
                    <th scope="col">telefono</th>
                    <th scope="col">email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("inventario/config/conexion.php");

                
                $sql = "SELECT p.id, p.nombre_proveedor, p.contacto_proveedor, p.telefono_proveedor, p.email_proveedor
                        FROM proveedores p";
                        

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($proveedor = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                           
                            <!--<td><?php echo htmlspecialchars($proveedor['id']); ?></td>-->
                            <td><?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['contacto_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['telefono_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['email_proveedor']); ?></td>
                            <td>
                                <a href="eliminarproducto.php?id_producto=<?php echo htmlspecialchars($producto['id_producto']); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Si no hay resultados encontrados
                    echo "<tr><td colspan='9'>No se encontraron clientes.</td></tr>";
                }

                
                $resultado->free();
                $conexion->close();
                ?>
            </tbody>
        </table>
        
    </div>
</body>

</html>
