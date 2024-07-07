<?php
// Conectar a la base de datos
include 'php/config.php';

if (isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];
    // Consulta para obtener productos de la subcategoría seleccionada
    $query = "SELECT nombre_producto, valor FROM productos WHERE id_subcategoria IN (SELECT id_subcategoria FROM subcategorias WHERE nombre_subcategoria = '$subcategory')";
    $result = mysqli_query($conexion, $query);

    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }

    // Devolver el resultado como JSON
    header('Content-Type: application/json');
    echo json_encode($productos);
    exit; // Terminar el script después de enviar la respuesta JSON
}

// Consulta para obtener categorías y subcategorías
$query = "SELECT c.nombre_categoria AS categoria, s.nombre_subcategoria AS subcategoria 
          FROM categorias c
          LEFT JOIN subcategorias s ON c.id = s.id_categoria";
$result = mysqli_query($conexion, $query);

$categorias = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categoria = $row['categoria'];
    $subcategoria = $row['subcategoria'];
    if (!isset($categorias[$categoria])) {
        $categorias[$categoria] = [];
    }
    if ($subcategoria) {
        $categorias[$categoria][] = $subcategoria;
    }
}

// Devolver el resultado como JSON
header('Content-Type: application/json');
echo json_encode($categorias);
?>
