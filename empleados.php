<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/index.css" />
    <title>Listado de empleados</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="7" class="titulo">
                        <h1 class="text-center">LISTADO DE EMPLEADOS</h1>
                    </td>
                </tr>
                <tr>
                    <th scope="col">Nombre</th>
                    <!--<th scope="col">ID</th>-->
                    <th scope="col">Email</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Sueldo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("inventario/config/conexion.php");

                
                $sql = "SELECT u.usuario_id, u.nombre, u.email, u.rut, e.cargo, e.sueldo, e.telefono
                        FROM usuarios u
                        INNER JOIN empleados e ON u.usuario_id = e.id";
                        

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($usuario = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                           
                            <!--<td><?php echo htmlspecialchars($producto['id_usuario']); ?></td>-->
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['rut']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['cargo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['sueldo']); ?></td>
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
