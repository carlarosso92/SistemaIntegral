<?php
// Incluir la conexión a la base de datos
include "config/conexion.php";

// Consulta SQL para obtener las categorías
$sql = "SELECT id, nombre_categoria FROM categorias";
$resultado = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($resultado->num_rows > 0) {
    $categorias = array();
    while($row = $resultado->fetch_assoc()) {
        $categoria = array(
            'id' => $row['id'],
            'nombre_categoria' => $row['nombre_categoria']
        );
        $categorias[] = $categoria;
    }
    // Devolver las categorías como JSON
    echo json_encode($categorias);
} else {
    // Si no hay categorías
    echo json_encode(array());
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
