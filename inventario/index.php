<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Listado de Productos</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>
        h2 {
            padding: 12px;
            font-style: normal;
            text-align: center;
            margin: 8em 21em auto;
            margin-bottom: 1em;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover{
            background-color: #D3E1A4;
            color: #61A502;
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
        form input[type="number"] {
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
            padding-left: 10px; /* Ajusta este valor según tus necesidades */
            display: inline-block;
            vertical-align: middle;
            margin-top: -40px;
            font-size: small;
        }

        input[type="text"] {
            display: inline-block;
            vertical-align: middle;
        }
        /* Estilo para el botón "Guardar" cuando está deshabilitado */
        #buttonSubmit:disabled {
            background-color: #ddd; /* Color de fondo gris */
            color: #666; /* Color de texto gris */
            cursor: default; /* Cursor predeterminado */
            pointer-events: none; /* Evitar eventos de puntero */
        }

        /* Estilo adicional para deshabilitar el efecto de hover */
        #buttonSubmit:disabled:hover {
            background-color: #ddd; /* Mantener el color de fondo gris */
            color: #666; /* Mantener el color de texto gris */
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2 class="text-center">LISTADO DE PRODUCTOS</h2>
    </div>
    <div class="container">
        <table class="table">
            <thead>
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
        <div>
            <a href="agregarproducto.php" class="button">Agregar Producto</a>
        </div>
    </div>
</body>

</html>