
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Empleados</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="ingresarempleado.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Rut: <input type="text" name="rut" placeholder="Rut, Ej:11.111.111-1" required><br>
        Email: <input type="email" name="email" required placeholder="email@gmail.com"><br>
        Contraseña: <input type="contrasena" name="contrasena" required><br>
        telefono: <input type="text" name="telefono" placeholder="Telefono" required><br>
        Cargo: <input type="text" name="cargo" required><br>
        Sueldo: <input type="number" name="sueldo" required><br>
        
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
