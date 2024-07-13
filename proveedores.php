<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/index.css" />
    <title>Listado de Proveedores</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>
        h2 {
            padding: 12px;
            font-style: normal;
            text-align: center;
            margin: 8em 21em auto;
            margin-bottom: 1em;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover {
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
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
        <h2 class="text-center">LISTADO DE PROVEEDORES</h2>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del Proveedor</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de configuración para la conexión a la base de datos
                require("inventario/config/conexion.php");

                // Consulta SQL para obtener el listado de proveedores
                $sql = "SELECT id, nombre_proveedor, contacto_proveedor, telefono_proveedor, email_proveedor FROM proveedores";

                // Ejecutar la consulta
                $resultado = $conexion->query($sql);

                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Iterar sobre los resultados obtenidos
                    while ($proveedor = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($proveedor['id']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['contacto_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['telefono_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['email_proveedor']); ?></td>
                            <td>
                                <a href="editarproveedor.php?id=<?php echo htmlspecialchars($proveedor['id']); ?>">Editar</a>
                                <a href="eliminarproveedor.php?id=<?php echo htmlspecialchars($proveedor['id']); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Si no hay resultados encontrados
                    echo "<tr><td colspan='6'>No se encontraron proveedores.</td></tr>";
                }

                // Liberar resultado y cerrar la conexión
                $resultado->free();
                $conexion->close();
                ?>
            </tbody>
        </table>
        <div>
            <a href="Proveedores/crudproveedores.php" class="button">Agregar Proveedor</a>
        </div>
    </div>
</body>

</html>
