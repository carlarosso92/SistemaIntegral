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
    <style>
        /* Estilos generales */
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
            padding-top: 80px; /* Agregar espacio para el header fijo */
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

        h1 {
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
            width: min-content;
            margin: 20px auto;
            text-align: center;
            margin-top: 100px;
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

        .header-content h1 {
            margin: 0;
            font-size: 2em;
            color: #333;
        }

        .header-content h1:hover {
            background-color: rgb(234, 234, 76);
            color: #333;
        }

        .table th, .table td {
            border: 1px solid black;
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
            background-color: whitesmoke;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #72A603;
            color: #E4F2B5;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
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
