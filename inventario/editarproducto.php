<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <title>Editar Producto</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Cargar subcategorías cuando cambia la categoría
            $('#categoria').change(function () {
                var categoria_id = $(this).val();
                $.ajax({
                    url: 'get_subcategorias.php',
                    type: 'POST',
                    data: { categoria_id: categoria_id },
                    dataType: 'json',
                    success: function (response) {
                        $('#subcategoria').empty();
                        if (response.length > 0) {
                            response.forEach(function (subcategoria) {
                                $('#subcategoria').append('<option value="' + subcategoria.id + '">' + subcategoria.nombre_subcategoria + '</option>');
                            });
                        } else {
                            $('#subcategoria').append('<option value="">No hay subcategorías disponibles</option>');
                        }
                    }
                });
            });

            // Cargar proveedores al cargar la página
            $.ajax({
                url: 'get_proveedores.php',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    $('#proveedor').empty();
                    $('#proveedor').append('<option value="" selected disabled>Seleccionar proveedor</option>'); // Placeholder
                    if (response.length > 0) {
                        response.forEach(function (proveedor) {
                            $('#proveedor').append('<option value="' + proveedor.id + '">' + proveedor.nombre_proveedor + '</option>');
                        });
                    } else {
                        $('#proveedor').append('<option value="">No hay proveedores disponibles</option>');
                    }
                }
            });
        });
    </script>
    <style>
        body {
    font-family: sans-serif;
    margin: 0;
    background-color: #F2EDD0;
}
        h2 {
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: auto;
            color: #72A603;
            background-color: #E4F2B5;
            min-width: calc(100% - 5vh);
            margin-bottom: 10px;
            border-radius: 10px;
        }
        h2:hover{
            background-color: #D3E1A4;
            color: #61A502;
        }

        form {
            min-height: 70vh;
            max-width: 70vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            margin: 10vh auto;
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
        form select {
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
    </style>
</head>

<body>
    <?php
    include_once("config/conexion.php");

    // Obtener los datos del producto a editar
    $producto_id = $_GET['id_producto']; // Asegúrate de pasar este parámetro en el URL
    $sql_producto = "SELECT * FROM productos WHERE id_producto = " . $producto_id;
    $resultado_producto = $conexion->query($sql_producto);

    if ($resultado_producto && $resultado_producto->num_rows > 0) {
        $producto = $resultado_producto->fetch_assoc();
    } else {
        echo "Producto no encontrado";
        exit;
    }

    // Obtener las categorías
    $sql_categorias = "SELECT id, nombre_categoria FROM categorias";
    $resultCategoria = $conexion->query($sql_categorias);
    ?>
    <form action="actualizarproducto.php" method="POST" enctype="multipart/form-data">
        <h2>Editar producto</h2>
        <input type="hidden" name="id_producto" value="<?php echo $producto_id; ?>">
        <div>
            Nombre: <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        </div>
        <div>
            <label for="categoria">Selecciona una categoría:</label>
            <select name="categoria" id="categoria">
                <option value="" selected disabled>Seleccionar categoría</option>
                <?php
                if ($resultCategoria->num_rows > 0) {
                    while ($row = $resultCategoria->fetch_assoc()) {
                        $selected = ($row["id"] == $producto['id_categoria']) ? "selected" : "";
                        echo "<option value='" . $row["id"] . "' $selected>" . $row["nombre_categoria"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay categorías disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="subcategoria">Selecciona una subcategoría:</label>
            <select name="subcategoria" id="subcategoria">
                <option value="">Selecciona una categoría primero</option>
                <?php
                // Obtener las subcategorías de la categoría actual del producto
                if (!empty($producto['id_categoria'])) {
                    $sql_subcategorias = "SELECT id, nombre_subcategoria FROM subcategorias WHERE id_categoria = " . $producto['id_categoria'];
                    $resultSubcategoria = $conexion->query($sql_subcategorias);

                    if ($resultSubcategoria->num_rows > 0) {
                        while ($row = $resultSubcategoria->fetch_assoc()) {
                            $selected = ($row["id"] == $producto['id_subcategoria']) ? "selected" : "";
                            echo "<option value='" . $row["id"] . "' $selected>" . $row["nombre_subcategoria"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay subcategorías disponibles</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div>
            <label for="proveedor">Selecciona un proveedor:</label>
            <select name="proveedor" id="proveedor">
                <!-- Placeholder añadido dinámicamente por JavaScript -->
            </select>
        </div>
        <div>
            Descripción: <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required>
        </div>
        <div>
            Precio: <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" required>
        </div>
        <div>
            Cantidad: <input type="number" name="cantidad_stock" value="<?php echo $producto['cantidad_stock']; ?>" required>
        </div>
        <div>
            Fecha de vencimiento: <input type="date" name="fecha_vencimiento" value="<?php echo $producto['fecha_vencimiento']; ?>" required>
        </div>
        <div>
            Nueva imagen: <input type="file" name="imagen" accept="image/*">
        </div>
        <button type="submit">Actualizar</button>
        <button><a href="index.php">Regresar</a></button>
    </form>
</body>

</html>
