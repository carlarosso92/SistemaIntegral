<?php
include "config/conexion.php";

// Consulta SQL para obtener las categorías
$sqlCategoria = "SELECT id, nombre_categoria FROM categorias";
$resultCategoria = $conexion->query($sqlCategoria);

if (!$resultCategoria) {
    die("Error en la consulta: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <title>Ingreso de Producto</title>
    <link rel="stylesheet" href="css/agregarproducto.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Knewave:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jockey+One&wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jomhuria&wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kameron&wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jeju+Gothic&wght@400&display=swap" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/validacionFormularios.js"></script>
    <style>
        form {
            min-height: 70vh;
            min-width: 75vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            margin: 2vh auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: auto;
            margin-top: 8px;
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
            min-width: calc(100% - 10%);
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

        .product-group {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'get_proveedores.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#proveedor').empty();
                    $('#proveedor').append('<option value="" selected disabled>Seleccionar proveedor</option>');
                    if (response.length > 0) {
                        response.forEach(function(proveedor) {
                            $('#proveedor').append('<option value="' + proveedor.id + '">' + proveedor.nombre_proveedor + '</option>');
                        });
                    } else {
                        $('#proveedor').append('<option value="">No hay proveedores disponibles</option>');
                    }
                }
            });

            $('#proveedor').change(function() {
                var proveedor_id = $(this).val();
                // Opcional: Cargar facturas del proveedor si es necesario
            });

            // Inicializar categorías para el primer producto
            cargarCategorias($('.categoria'));

            $(document).on('change', '.categoria', function() {
                var categoria_id = $(this).val();
                var subcategoriaSelect = $(this).closest('.product-group').find('.subcategoria');
                $.ajax({
                    url: 'get_subcategorias.php',
                    type: 'POST',
                    data: { categoria_id: categoria_id },
                    dataType: 'json',
                    success: function(response) {
                        subcategoriaSelect.empty();
                        if (response.length > 0) {
                            response.forEach(function(subcategoria) {
                                subcategoriaSelect.append('<option value="' + subcategoria.id + '">' + subcategoria.nombre_subcategoria + '</option>');
                            });
                        } else {
                            subcategoriaSelect.append('<option value="">No hay subcategorías disponibles</option>');
                        }
                    }
                });
            });

            $('#addProduct').click(function() {
                var productGroup = `
                    <div class="product-group">
                        <label>Categoría:
                            <select name="categoria[]" class="categoria" required>
                                <option value="" selected disabled>Seleccionar categoría</option>
                                <?php
                                    if ($resultCategoria->num_rows > 0) {
                                        while($row = $resultCategoria->fetch_assoc()) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["nombre_categoria"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay categorías disponibles</option>";
                                    }
                                ?>
                            </select>
                        </label><br>
                        <label>Subcategoría:
                            <select name="subcategoria[]" class="subcategoria" required>
                                <option value="">Selecciona una categoría primero</option>
                            </select>
                        </label><br>
                        <label>Nombre: <input type="text" name="nombre[]" required></label><br>
                        <label>Descripción: <input type="text" name="descripcion[]" required></label><br>
                        <label>Precio: <input type="number" name="precio[]" value="0" required></label><br>
                        <label>Cantidad: <input type="number" name="cantidad_stock[]" value="0" required></label><br>
                        <label>Fecha de vencimiento: <input type="date" name="fecha_vencimiento[]" required></label><br>
                        <label>Imagen: <input type="file" name="imagen[]" accept="image/*" required></label><br>
                    </div>`;
                $('#products').append(productGroup);
            });

            function cargarCategorias(selectElement) {
                $.ajax({
                    url: 'get_categorias.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        selectElement.empty();
                        selectElement.append('<option value="" selected disabled>Seleccionar categoría</option>');
                        if (response.length > 0) {
                            response.forEach(function(categoria) {
                                selectElement.append('<option value="' + categoria.id + '">' + categoria.nombre_categoria + '</option>');
                            });
                        } else {
                            selectElement.append('<option value="">No hay categorías disponibles</option>');
                        }
                    }
                });
            }
        });
    </script>
</head>
<body>
    <div class="configuracion-div-form">
        <div class="centrar-form">
            <form action="ingresarproducto.php" method="POST" enctype="multipart/form-data">
                <div>
                    <h2>Nuevo producto</h2>
                </div>
                <label for="proveedor">Selecciona un proveedor:</label>
                <select name="proveedor" id="proveedor" required></select><br>
                <label for="factura_proveedor">Número de factura:</label>
                <input type="text" name="factura_proveedor" id="factura_proveedor" required><br>

                <div id="products">
                    <div class="product-group">
                        <label>Categoría:
                            <select name="categoria[]" class="categoria" required>
                                <option value="" selected disabled>Seleccionar categoría</option>
                                <?php
                                    if ($resultCategoria->num_rows > 0) {
                                        while($row = $resultCategoria->fetch_assoc()) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["nombre_categoria"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay categorías disponibles</option>";
                                    }
                                ?>
                            </select>
                        </label><br>
                        <label>Subcategoría:
                            <select name="subcategoria[]" class="subcategoria" required>
                                <option value="">Selecciona una categoría primero</option>
                            </select>
                        </label><br>
                        <label>Nombre: <input type="text" name="nombre[]" required></label><br>
                        <label>Descripción: <input type="text" name="descripcion[]" required></label><br>
                        <label>Precio: <input type="number" name="precio[]" value="0" required></label><br>
                        <label>Cantidad: <input type="number" name="cantidad_stock[]" value="0" required></label><br>
                        <label>Fecha de vencimiento: <input type="date" name="fecha_vencimiento[]" required></label><br>
                        <label>Imagen: <input type="file" name="imagen[]" accept="image/*" required></label><br>
                    </div>
                </div>
                <button type="button" id="addProduct">Agregar otro producto</button><br>
                <button type="submit" id="buttonSubmit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
