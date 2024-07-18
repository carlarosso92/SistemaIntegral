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
            <h2>Actividades Administrador</h2>
            <div class="activities">
               <a href="ventas/ventas.php"><button class="activity"><span class="icon">✓</span> Registrar venta</button></a>
        
                <a href="ventas/reservas.php">
                <button class="activity"><span class="icon">📑</span> Reservas</button>
                </a>
                <a href="inventario/categoria.php"><button class="activity"><span class="icon">🧩</span>Gestión Categorías</button></a>
                <a href="inventario/index.php"><button class="activity"><span class="icon">📦</span>Gestión Inventario</button></a>
                <a href="empleados.php">
                <a href="descuentos/mostrar_descuentos.php"><button class="activity"><span class="icon">🏷️</span> Gestionar descuentos</button></a>
                <a href="empleados.php">
                <button class="activity"><span class="icon">👤</span> Gestión de Empleados</button>
                </a>
                <a href="proveedores.php"><button class="activity"><span class="icon">📚</span> Proveedores</button></a>
                <a href="informes/informes.php"><button class="activity"><span class="icon">📄</span> Generar informes</button></a>
                <button class="activity"><span class="icon">✏️</span> Devoluciones</button>
            </div>
        </div>
    </main>

</body>

</html>