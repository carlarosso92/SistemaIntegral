<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Registro de Cliente</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <style>
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 2em 26em auto;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover{
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
    </style>
</head>
<body>
    <h2>Registro</h2>
    <form action="ingresarempleado.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Rut: <input type="text" name="rut" placeholder="Rut, Ej:11.111.111-1" required><br>
        telefono: <input type="text" name="telefono" placeholder="Telefono" required><br>
        Email: <input type="email" name="email" required placeholder="email@gmail.com"><br>
        Contraseña: <input type="contrasena" name="contrasena" required><br>
        Cargo: <input type="text" name="cargo" required><br>
        Sueldo: <input type="number" name="sueldo" required><br>
        
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
