<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Registro de Empleado</title>
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
            padding-left: 10px; /* Ajusta este valor según tus necesidades */
            display: inline-block;
            vertical-align: middle;
            margin-top: -40px;
            font-size: small;
        }

        input[type="text"] {
            display: inline-block;
            vertical-align: middle;
        }
        /* Estilo para el botón "Guardar" cuando está deshabilitado */
        #buttonSubmit:disabled {
            background-color: #ddd; /* Color de fondo gris */
            color: #666; /* Color de texto gris */
            cursor: default; /* Cursor predeterminado */
            pointer-events: none; /* Evitar eventos de puntero */
        }

        /* Estilo adicional para deshabilitar el efecto de hover */
        #buttonSubmit:disabled:hover {
            background-color: #ddd; /* Mantener el color de fondo gris */
            color: #666; /* Mantener el color de texto gris */
        }

        span.texto{
            margin-top: 10px;
            margin-bottom: 50px;
        }

    </style>
</head>
<body>
    
    <form action="ingresarempleado.php" method="POST">
    <h2>Registro</h2>
        <div>
            <span class="texto">Nombre: </span><input type="text" name="nombre" id="name"><br>
            <p id="nombreOutput" class="validation-message">El nombre no puede estar vacío.</p>
        </div>
        <div>
            Rut: <input type="text" name="rut" id="rut" placeholder="Rut, Ej:11.111.111-1"><br>
            <p id="rutOutput" class="validation-message">El rut no puede ser vacio.</p>
        </div>
        <div>
            Telefono: <input type="text" name="telefono" id="telefono" placeholder="Telefono"><br>
            <p id="telefonoOutput" class="validation-message">El teléfono no puede ser vacio.</p>
        </div>
        <div>
            Email: <input type="text" name="correo" id="correo" placeholder="email@correo.com"><br>
            <p id="correoOutput" class="validation-message">El correo no puede ser vacio.</p>
        </div>
        <div>
            Contraseña: <input type="text" name="contrasena" id="contrasena"><br>
            <p id="contrasenaOutput" class="validation-message">La contraseña no puede ser vacia.</p>
        </div>
        <div>
            Cargo: <input type="text" name="cargo" id="cargo"><br>
            <p id="cargoOutput" class="validation-message">El cargo no puede ser vacio.</p>
        </div>
        <div>
            Sueldo: <input type="number" name="sueldo" id="sueldo" value="0" required><br>
            <p id="sueldoOutput" class="validation-message"></p>
        </div>
        <button type="submit" id="buttonSubmit" disabled>Registrarse</button>
    </form>
</body>
</html>
