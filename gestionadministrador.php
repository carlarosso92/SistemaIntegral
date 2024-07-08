<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: crudloginempleado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
</head>
<body>
    <header>
        <div class="contenedor">
            <img src="img/logo.png" alt="Don Perico Logo">
            <h1>Don Perico</h1>
            <input type="text" placeholder="¿Qué buscas?...">
            <div class="opcionusuario">
                <a href="crudlogincliente.php">¡Hola! Inicia sesión</a>
                <a href="#">Mis pedidos</a>
            </div>
        </div>
        <div class="menuopcion">
            <nav>
            <ul>
                    <li><a href="logout.php">Cerrar sesión</a></li> 
                </ul>
            </nav>
        </div>
    </header>

    <main class="contenido">
        <div class="employee-section">
            <div class="employee-info">
                <div class="details">
                    <div class="name">Nombre: <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></div>
                    <div class="role">Cargo: <?php echo htmlspecialchars($_SESSION['usuario_cargo']); ?></div>
                </div>
            </div>
            <h2>Actividades empleado</h2>
            <div class="activities">
                <button class="activity"><span class="icon">✓</span> Registrar venta</button>
                <button class="activity"><span class="icon">🧩</span> Gestionar Producto</button>
                <button class="activity"><span class="icon">✏️</span> Devoluciones</button>
                <button class="activity"><span class="icon">📑</span> Reservas</button>
                <button class="activity"><span class="icon">📦</span> Inventario</button>
            </div>
        </div>
    </main>

</body>
</html>
