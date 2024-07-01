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
    <title>Ingreso de Producto</title>
    <link rel="stylesheet" href="css/agregarproducto.css" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Knewave:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jockey One:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jomhuria:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kameron:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JejuGothic:wght@400&display=swap" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        if(response.length > 0){
                            response.forEach(function(subcategoria) {
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
                success: function(response) {
                    $('#proveedor').empty();
                    $('#proveedor').append('<option value="" selected disabled>Seleccionar proveedor</option>'); // Placeholder
                    if(response.length > 0){
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
        <h2>Nuevo producto</h2>
        <div class="centrar-form">
            <form action="ingresarproducto.php" method="POST">
                Nombre: <input type="text" name="nombre" required><br>
                <label for="categoria">Selecciona una categoría:</label>
                <select name="categoria" id="categoria">
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
                <select name="subcategoria" id="subcategoria">
                    <option value="">Selecciona una categoría primero</option>
                </select><br>
                <label for="proveedor">Selecciona un proveedor:</label>
                <select name="proveedor" id="proveedor">
                    <!-- Placeholder añadido dinámicamente por JavaScript -->
                </select><br>
                Descripción: <input type="text" name="descripcion" required><br>
                Precio: <input type="number" name="precio" required><br>
                Cantidad: <input type="number" name="cantidad_stock" required><br>
                Fecha de vencimiento: <input type="date" name="fecha_vencimiento" required><br>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
