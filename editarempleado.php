<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Editar Empleado</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <script src="js/validacionFormularios.js"></script>
    <style>
        h2 {
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: auto;
            color: #72A603;
            background-color: #E4F2B5;
            min-width: calc(100% - 5vh);
            margin-bottom: 10px;
            border-radius: 10px;
        }

        h2:hover {
            background-color: #D3E1A4;
            color: #61A502;
            border-radius: 10px;
        }

        form {
            min-height: 70vh;
            max-width: 70vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            margin: 10vh auto;
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
            margin-top: 5px;
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

        span.texto{
            margin-top: 10px;
            margin-bottom: 50px;
        }

    </style>
</head>
<body>

<?php
require("inventario/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id'];
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $sueldo = $_POST['sueldo'];

    $sql = "UPDATE usuarios u
            INNER JOIN empleados e ON u.usuario_id = e.id
            SET u.nombre = ?, u.email = ?, u.rut = ?, e.cargo = ?, e.sueldo = ?, e.telefono = ?
            WHERE u.usuario_id = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssisi", $nombre, $correo, $rut, $cargo, $sueldo, $telefono, $usuario_id);

    if ($stmt->execute()) {
        echo "Empleado actualizado correctamente.";
    } else {
        echo "Error al actualizar el empleado: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT u.nombre, u.email, u.rut, e.cargo, e.sueldo, e.telefono
                FROM usuarios u
                INNER JOIN empleados e ON u.usuario_id = e.id
                WHERE u.usuario_id = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $empleado = $result->fetch_assoc();
        } else {
            echo "Empleado no encontrado.";
            exit;
        }

        $stmt->close();
    } else {
        echo "ID de empleado no proporcionado.";
        exit;
    }
}
?>

<form action="editarempleado.php" method="POST">
    <h2>Editar Empleado</h2>
    <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($id); ?>">
    <div>
        <span class="texto">Nombre: </span><input type="text" name="nombre" id="name" value="<?php echo htmlspecialchars($empleado['nombre']); ?>"><br>
        <p id="nombreOutput" class="validation-message">El nombre no puede estar vacío.</p>
    </div>
    <div>
        Rut: <input type="text" name="rut" id="rut" value="<?php echo htmlspecialchars($empleado['rut']); ?>"><br>
        <p id="rutOutput" class="validation-message">El rut no puede ser vacío.</p>
    </div>
    <div>
        Telefono: <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($empleado['telefono']); ?>"><br>
        <p id="telefonoOutput" class="validation-message">El teléfono no puede ser vacío.</p>
    </div>
    <div>
        Email: <input type="text" name="correo" id="correo" value="<?php echo htmlspecialchars($empleado['email']); ?>"><br>
        <p id="correoOutput" class="validation-message">El correo no puede ser vacío.</p>
    </div>
    <div>
        Cargo: <input type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($empleado['cargo']); ?>"><br>
        <p id="cargoOutput" class="validation-message">El cargo no puede ser vacío.</p>
    </div>
    <div>
        Sueldo: <input type="number" name="sueldo" id="sueldo" value="<?php echo htmlspecialchars($empleado['sueldo']); ?>" required><br>
        <p id="sueldoOutput" class="validation-message"></p>
    </div>
    <button type="submit" id="buttonSubmit" disabled>Guardar Cambios</button>
</form>
</body>
</html>
