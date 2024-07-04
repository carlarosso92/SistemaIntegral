<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Listado de Productos</title>
</head>
<body>
<?php include "header.php"; ?>
        <div class="conteiner">
            <h1 class="text-center">LISTADO DE PRODUCTOS</h1>
        </div>
        <div class="conteiner">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Codigo de barra</th>
                        <!--<th scope="col">ID</th>-->
                        <th scope="col">Categoría</th>
                        <th scope="col">Subcategoría</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de configuración para la conexión a la base de datos
                    require("config/conexion.php");

                    // Consulta SQL para obtener el listado de productos con categorías y subcategorías p.id_producto
                    $sql = "SELECT p.codigo_barras, c.nombre_categoria, s.nombre_subcategoria, p.nombre, p.descripcion, p.precio, p.cantidad_stock
                            FROM productos p
                            INNER JOIN categorias c ON p.id_categoria = c.id
                            LEFT JOIN subcategorias s ON p.id_subcategoria = s.id";

                    // Ejecutar la consulta
                    $resultado = $conexion->query($sql);

                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        // Iterar sobre los resultados obtenidos
                        while ($producto = $resultado->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $producto['codigo_barras']; ?></td>
                                <!--<td><?php echo $producto['id_producto']; ?></td>-->
                                <td><?php echo $producto['nombre_categoria']; ?></td>
                                <td><?php echo $producto['nombre_subcategoria']; ?></td>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td><?php echo $producto['descripcion']; ?></td>
                                <td><?php echo $producto['precio']; ?></td>
                                <td><?php echo $producto['cantidad_stock']; ?></td>
                                <td>
                                    <a href="#">Editar</a>
                                    <a href="#">Eliminar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        // Si no hay resultados encontrados
                        echo "<tr><td colspan='8'>No se encontraron productos.</td></tr>";
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
