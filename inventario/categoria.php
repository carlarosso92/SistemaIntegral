<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/categorias.css" />
    <title>Listado de Categorías y Subcategorías</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "header.php"; ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="4" class="table-header">
                            <div class="header-content">
                                <h2 class="text-center">Listado de Categorías y Subcategorías</h2>
                                <a href="crudcategoria.php" class="button">Agregar Categoría</a>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de la Categoría</th>
                        <th scope="col">Subcategorías</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de configuración para la conexión a la base de datos
                    require("config/conexion.php");

                    // Consulta SQL para obtener el listado de categorías y subcategorías
                    $sql = "SELECT c.id AS categoria_id, c.nombre_categoria, s.id AS subcategoria_id, s.nombre_subcategoria
                            FROM categorias c
                            LEFT JOIN subcategorias s ON c.id = s.id_categoria
                            ORDER BY c.nombre_categoria, s.nombre_subcategoria";

                    // Ejecutar la consulta
                    $resultado = $conexion->query($sql);

                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        // Iterar sobre los resultados obtenidos
                        $categorias = [];
                        while ($fila = $resultado->fetch_assoc()) {
                            $categoria_id = $fila['categoria_id'];
                            $categoria_nombre = $fila['nombre_categoria'];
                            $subcategoria_id = $fila['subcategoria_id'];
                            $subcategoria_nombre = $fila['nombre_subcategoria'];

                            if (!isset($categorias[$categoria_id])) {
                                $categorias[$categoria_id] = [
                                    'nombre' => $categoria_nombre,
                                    'subcategorias' => []
                                ];
                            }

                            if ($subcategoria_id) {
                                $categorias[$categoria_id]['subcategorias'][$subcategoria_id] = $subcategoria_nombre;
                            }
                        }

                        // Mostrar las categorías y subcategorías en la tabla
                        foreach ($categorias as $categoria_id => $categoria) {
                            $rowspan = count($categoria['subcategorias']) > 0 ? count($categoria['subcategorias']) : 1;
                            echo "<tr>";
                            echo "<td rowspan='{$rowspan}'>" . htmlspecialchars($categoria_id) . "</td>";
                            echo "<td rowspan='{$rowspan}'>" . htmlspecialchars($categoria['nombre']) . "</td>";

                            if (count($categoria['subcategorias']) > 0) {
                                $first = true;
                                foreach ($categoria['subcategorias'] as $subcategoria_id => $subcategoria_nombre) {
                                    if (!$first) echo "<tr>";
                                    echo "<td>" . htmlspecialchars($subcategoria_nombre) . "</td>";
                                    echo "<td>
                                            <a href='editarcategoria.php?id=" . htmlspecialchars($categoria_id) . "'>Editar</a>
                                            <a href='eliminarcategoria.php?id=" . htmlspecialchars($categoria_id) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta categoría?\");'>Eliminar</a>
                                          </td>";
                                    echo "</tr>";
                                    $first = false;
                                }
                            } else {
                                echo "<td>No hay subcategorías</td>";
                                echo "<td>
                                        <a href='editarcategoria.php?id=" . htmlspecialchars($categoria_id) . "'>Editar</a>
                                        <a href='eliminarcategoria.php?id=" . htmlspecialchars($categoria_id) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta categoría?\");'>Eliminar</a>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        // Si no hay resultados encontrados
                        echo "<tr><td colspan='4'>No se encontraron categorías.</td></tr>";
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
