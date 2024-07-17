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
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    
</head>
<body>
    <?php include "inventario/header.php"; ?>
    <main class="contenido">
        <div class="employee-section">
            <div class="employee-info">
                <div class="details">
                    <div class="name">Nombre: <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></div>
                    <div class="role">Cargo: <?php echo htmlspecialchars($_SESSION['usuario_cargo']); ?></div>
                </div>
            </div>
            <h2>Actividades Empleado</h2>
            <div class="activities">
                <a href="ventas/ventas.php"><button class="activity"><span class="icon">✓</span> Registrar venta</button></a>
                <a href="inventario/index.php"><button class="activity"><span class="icon">🧩</span> Gestionar Producto</button></a>
                <a href="#"><button class="activity"><span class="icon">✏️</span> Devoluciones</button></a>
                <a href="ventas/reservas.php"><button class="activity"><span class="icon">📑</span> Reservas</button></a>
                <a href="inventario/index.php"><button class="activity"><span class="icon">📦</span> Inventario</button></a>
            </div>
        </div>
    </main>
</body>
</html>
