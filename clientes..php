<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/index.css" />
    <title>Listado de clientes</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
        <h1 class="text-center">LISTADO DE CLIENTES</h1>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <!--<th scope="col">ID</th>-->
                    <th scope="col">Email</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("inventario/config/conexion.php");

                
                $sql = "SELECT u.usuario_id, u.nombre, u.email, u.rut, c.direccion, c.telefono
                        FROM usuarios u
                        INNER JOIN clientes c ON u.usuario_id = c.id";
                        

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($usuario = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                           
                            <!--<td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>-->
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['rut']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                            <td>
                                <a href="eliminarproducto.php?id_producto=<?php echo htmlspecialchars($producto['id_producto']); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Si no hay resultados encontrados
                    echo "<tr><td colspan='9'>No se encontraron clientes.</td></tr>";
                }

                
                $resultado->free();
                $conexion->close();
                ?>
            </tbody>
        </table>
        
    </div>
</body>

</html>
