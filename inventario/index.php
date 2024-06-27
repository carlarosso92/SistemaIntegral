<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Document</title>
</head>
<body>
    <br>
    <div class ="conteiner">
        <h1 class ="text-center">LISTADO DE PRODUCTOS</h1>
    </div>
    <br>
    <div class="conteiner">
        <table class="table">
            <thead>
                <tr>
                    <th scope ="col">ID</th>
                    <th scope ="col">Categoría</th>
                    <th scope ="col">Nombre</th>
                    <th scope ="col">Descripción</th>
                    <th scope ="col">Precio</th>
                    <th scope ="col">Stock</th>
                    <th scope ="col">acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require ("config/conexion.php");
                    
                $sql = $conexion -> query("SELECT * FROM productos
                        INNER JOIN categorias ON productos.id_categoria = categorias.ID_Categoria                   
                    ");

                while ($resultado = $sql ->fetch_assoc()){
                ?>    
                    <tr>
                        <th scope="row"><?php echo $resultado['id_producto']?></th>
                        <th scope="row"><?php echo $resultado['nombrecategoria']?></th>
                        <th scope="row"><?php echo $resultado['nombre']?></th>
                        <th scope="row"><?php echo $resultado['descripcion']?></th>
                        <th scope="row"><?php echo $resultado['precio']?></th>
                        <th scope="row"><?php echo $resultado['cantidad_stock']?></th>
                        <th>
                            <a href="">Editar</a>
                            <a href="">Eliminar</a>
                        </th>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
        <div>
            <a href="agregarproducto.php" class="button">Agregar Producto</a>
        </div>
    </div>
</body>
</html>