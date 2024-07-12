<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/agregarproducto.css" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 2em 26em auto;
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
</head>

<body>
   

    <h1>Editar producto</h1>
    <?php
    include_once ("config/conexion.php");

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
    <div class="configuracion-div-form">
        <h2>Editar producto</h2>
        <div class="centrar-form">
            <form action="actualizarproducto.php" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto_id; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required><br>
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
                </select><br>
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
                </select><br>
                <label for="proveedor">Selecciona un proveedor:</label>
                <select name="proveedor" id="proveedor">
                    <!-- Placeholder añadido dinámicamente por JavaScript -->
                    <!-- Aquí puedes agregar el proveedor actual si lo deseas -->
                </select><br>
                Descripción: <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>"
                    required><br>
                Precio: <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" required><br>
                Cantidad: <input type="number" name="cantidad_stock" value="<?php echo $producto['cantidad_stock']; ?>"
                    required><br>
                Fecha de vencimiento: <input type="date" name="fecha_vencimiento"
                    value="<?php echo $producto['fecha_vencimiento']; ?>" required><br>
                <button type="submit">Actualizar</button>
                <button><a href="index.php">Regresar</a></button>
            </form>
        </div>
    </div>
</body>

</html>