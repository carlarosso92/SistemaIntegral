<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/modal.css">
    <title>Inicio de Sesión</title>
</head>
<body>
         <div class="modal">
        <div class="modal-contenido">
    <form method="POST" action="loginempleado.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p><a href="crudrecuperarcontrasena.php">¿Olvidaste tu contraseña?</a></p>
        </div>
    </div>
</body>
</html>