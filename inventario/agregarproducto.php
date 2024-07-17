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
            max-width: 500px;
            margin: auto;
            margin-top: 80px;
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
            padding-left: 10px;
            display: inline-block;
            vertical-align: middle;
            margin-top: -40px;
            font-size: small;
        }

        input[type="text"] {
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
    </style>
    <script>
        $(document).ready(function() {
            $('#categoria').change(function() {
                var categoria_id = $(this).val();
                $.ajax({
                    url: 'get_subcategorias.php',
                    type: 'POST',
                    data: { categoria_id: categoria_id },
                    dataType: 'json',
                    success: function(response) {
                        $('#subcategoria').empty();
                        if (response.length > 0) {
                            response.forEach(function(subcategoria) {
                                $('#subcategoria').append('<option value="' + subcategoria.id + '">' + subcategoria.nombre_subcategoria + '</option>');
                            });
                        } else {
                            $('#subcategoria').append('<option value="">No hay subcategorías disponibles</option>');
                        }
                    }
                });
            });

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
        });
    </script>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="configuracion-div-form">
        <div class="centrar-form">
            <form action="ingresarproducto.php" method="POST">
                <div>
                    <h2>Nuevo producto</h2>
                    Nombre: <input type="text" name="nombre" id="name"><br>
                    <p id="nombreOutput" class="validation-message">El nombre no puede estar vacío.</p>
                </div>
                <label for="categoria">Selecciona una categoría:</label>
                <select name="categoria" id="categoria" required>
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
                </select><br>
                <label for="subcategoria">Selecciona una subcategoría:</label>
                <select name="subcategoria" id="subcategoria" required>
                    <option value="">Selecciona una categoría primero</option>
                </select><br>
                <label for="proveedor">Selecciona un proveedor:</label>
                <select name="proveedor" id="proveedor" required>
                </select><br>
                <label for="factura_proveedor">Número de factura:</label>
                <input type="text" name="factura_proveedor" id="factura_proveedor" required><br>
                <div>
                    Descripción: <input type="text" name="descripcion" id="descripcion" required><br>
                    <p id="descripcionOutput" class="validation-message">La descripcion no puede estar vacía.</p>
                </div>
                <div>
                    Precio: <input type="number" name="precio" id="precio" value="0" required><br>
                    <p id="precioOutput" class="validation-message"></p>
                </div>
                <div>
                    Cantidad: <input type="number" name="cantidad_stock" id="cantidad" value="0" required><br>
                    <p id="cantidadOutput" class="validation-message"></p>
                </div>
                Fecha de vencimiento: <input type="date" name="fecha_vencimiento" required><br>
                <button type="submit" id="buttonSubmit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
