<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require("config/conexion.php");

// Verificar si se ha proporcionado el ID de la categoría a eliminar
if (isset($_GET['id'])) {
    $categoria_id = intval($_GET['id']);

    // Consulta SQL para eliminar la categoría
    $sql = "DELETE FROM categorias WHERE id = ?";
    
    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("i", $categoria_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página de categorías con un mensaje de éxito
            header("Location: categoria.php?mensaje=Categoria eliminada correctamente");
            exit();
        } else {
            echo "Error al eliminar la categoría: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "ID de categoría no proporcionado.";
}
?>
