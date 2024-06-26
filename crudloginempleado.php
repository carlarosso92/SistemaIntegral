<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión</title>
</head>
<body>
    <form method="POST" action="logintrabajador.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p><a href="crudrecuperarcontrasena.php">¿Olvidaste tu contraseña?</a></p>
</body>
</html>