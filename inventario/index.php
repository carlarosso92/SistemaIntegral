<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico - Listado de Productos</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/indexgestionproducto.css" />
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
                                <h1 class="text-center">Listado productos</h1>
                                <a href="agregarproducto.php" class="button">Agregar Producto</a>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">Código de barra</th>
                        <!--<th scope="col">ID</th>-->
                        <th scope="col">Categoría</th>
                        <th scope="col">Subcategoría</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de configuración para la conexión a la base de datos
                    require("config/conexion.php");

                    // Consulta SQL para obtener el listado de productos con categorías, subcategorías y proveedores
                    $sql = "SELECT p.id_producto, p.codigo_barras, c.nombre_categoria, s.nombre_subcategoria, p.nombre, p.descripcion, p.precio, p.cantidad_stock, prov.nombre_proveedor
                            FROM productos p
                            INNER JOIN categorias c ON p.id_categoria = c.id
                            LEFT JOIN subcategorias s ON p.id_subcategoria = s.id
                            LEFT JOIN proveedores prov ON p.id_proveedor = prov.id";

                    // Ejecutar la consulta
                    $resultado = $conexion->query($sql);

                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        // Iterar sobre los resultados obtenidos
                        while ($producto = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['codigo_barras']); ?></td>
                                <!--<td><?php echo htmlspecialchars($producto['id_producto']); ?></td>-->
                                <td><?php echo htmlspecialchars($producto['nombre_categoria']); ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre_subcategoria']); ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                                <td><?php echo htmlspecialchars($producto['cantidad_stock']); ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre_proveedor']); ?></td>
                                <td>
                                    <a href="editarproducto.php?id_producto=<?php echo htmlspecialchars($producto['id_producto']); ?>">Editar</a>
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
        </div>
    </main>
</body>

</html>
