<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/empleado.css" />
    <title>Listado de empleados</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="7" class="table-header">
                        <div class="header-content">
                            <h1 class="header-title">LISTADO DE EMPLEADOS</h1>
                            <a href="crudempleado.php" class="button">Agregar Empleado</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="col">Nombre</th>
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
                require("inventario/config/conexion.php");

                $sql = "SELECT u.usuario_id, u.nombre, u.email, u.rut, e.cargo, e.sueldo, e.telefono
                        FROM usuarios u
                        INNER JOIN empleados e ON u.usuario_id = e.id";

                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($usuario = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['rut']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['cargo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['sueldo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                            <td class="actions">
                                <a href="editarempleado.php?id=<?php echo htmlspecialchars($usuario['usuario_id']); ?>" class="edit-button">Editar</a>
                                <a href="eliminarproducto.php?id_producto=<?php echo htmlspecialchars($usuario['usuario_id']); ?>" class="delete-button" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No se encontraron empleados.</td></tr>";
                }

                $resultado->free();
                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
