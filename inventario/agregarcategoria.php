<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de categorías</title>
    <link rel="stylesheet" href="css/agregarcategoria.css" />
</head>
<body>
        <h2>Nueva categoría</h2>
        <form id="formulariocategoria" action="ingresarcategoria.php" method="POST">
            Nombre categoria: <input type="text" id="nombrecategoria" name="nombrecategoria" required><br>
            Descripción: <input type="text" id="descripcion" name="descripcion"><br>

            <button type="button" id="botonagregarsub">Agregar subcategoría</button><br>
            <button type="submit">Ingresar</button>
        </form>

</body>
</html>
