<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventario/css/proveedorespantalla.css" />
    <title>Listado de Proveedores</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <style>
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: auto;
          
            border-radius: 10px;
        }
        h2:hover {
            background-color:  rgb(234, 234, 76);
            color: #333;
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

        .table-header {
            background-color: #72A603;
            padding: 10px;
            text-align: center;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h2 {
            margin: 0;
            color: #333;
        }

        .header-content h2:hover {
            background-color: rgb(234, 234, 76);
            color: #333;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #72A603;
            color: #E4F2B5;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        a.button:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #E4F2B5;
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <?php include "inventario/header.php"; ?>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6" class="table-header">
                        <div class="header-content">
                            <h2>LISTADO DE PROVEEDORES</h2>
                            <a href="Proveedores/crudproveedores.php" class="button">Agregar Proveedor</a>
                        </div>
                    </th>
                </tr>
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
                <tr>
                    <td colspan="7" class="text-center">
                        <a href="Proveedores/crudproveedores.php" class="button">Agregar Proveedor</a>
                    </td>
                </tr>
            </tbody>
        </table>
<<<<<<< HEAD
       
=======
>>>>>>> 4bcf0b105612a8ebc2a9021f373281f41625dd52
    </div>
</body>

</html>
