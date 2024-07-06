<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Minimarket Don Perico</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="icon" href="img/logo2.png" type="image/png">
</head>
<body>
    <div class="modal">
        <div class="modal-contenido">
            <form method="POST" action="logincliente.php">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" required>
                <br>
                <button type="submit" value="Iniciar Sesión">Iniciar sesión</button>
            </form>
            <p><a href="crudrecuperarcontrasena.php">¿Olvidaste tu contraseña?</a></p>
            <p><a href="indexempleado.php">ingresar como empleado</a></p>
        </div>
    </div>
</body>
</html>