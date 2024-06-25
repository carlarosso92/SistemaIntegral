
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cliente</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="ingresarcliente.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Rut: <input type="text" name="rut" placeholder="Rut, Ej:11.111.111-1" required><br>
        telefono: <input type="text" name="telefono" placeholder="Telefono" required><br>
        direccion: <input type="text" name="direccion" placeholder="Direccion" required><br>
        Email: <input type="email" name="email" required placeholder="email@gmail.com"><br>
        Contraseña: <input type="contraseña" name="constraseña" required><br>
        
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
