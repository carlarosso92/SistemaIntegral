
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="css/agregarproducto.css" />
    <title>Ingreso de Producto</title>
</head>
<body>
    <h2>Nuevo producto</h2>
    <form action="ingresarproducto.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Categoría: <input type="text" name="nombrecategoria" placeholder="ej: bebidas, congelados..." required><br>
        Descripción: <input type="text" name="descripcion" required><br>
        precio <input type="number" name="precio" required><br>
        cantidad: <input type="number" name="cantidad_stock" required ><br>
        fecha de vencimiento: <input type="date" name="fecha_vencimiento" required><br>
        
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
