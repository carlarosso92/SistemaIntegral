<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require("config/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria_id = intval($_POST['categoria_id']);
    $nombre_categoria = $_POST['category'];
    $subcategorias = $_POST['subcategories'];

    // Actualizar el nombre de la categoría
    $sql_update_categoria = "UPDATE categorias SET nombre_categoria = ? WHERE id = ?";
    $stmt_update_categoria = $conexion->prepare($sql_update_categoria);
    $stmt_update_categoria->bind_param("si", $nombre_categoria, $categoria_id);
    if ($stmt_update_categoria->execute()) {
        // Eliminar las subcategorías existentes
        $sql_delete_subcategorias = "DELETE FROM subcategorias WHERE id_categoria = ?";
        $stmt_delete_subcategorias = $conexion->prepare($sql_delete_subcategorias);
        $stmt_delete_subcategorias->bind_param("i", $categoria_id);
        $stmt_delete_subcategorias->execute();
        $stmt_delete_subcategorias->close();

        // Insertar las nuevas subcategorías
        $sql_insert_subcategoria = "INSERT INTO subcategorias (id_categoria, nombre_subcategoria) VALUES (?, ?)";
        $stmt_insert_subcategoria = $conexion->prepare($sql_insert_subcategoria);
        foreach ($subcategorias as $subcategoria) {
            $stmt_insert_subcategoria->bind_param("is", $categoria_id, $subcategoria);
            $stmt_insert_subcategoria->execute();
        }
        $stmt_insert_subcategoria->close();
        
        // Redirigir a la página de categorías con un mensaje de éxito
        header("Location: categoria.php?mensaje=Categoría actualizada correctamente");
        exit();
    } else {
        echo "Error al actualizar la categoría: " . $stmt_update_categoria->error;
    }

    $stmt_update_categoria->close();
}

// Cerrar la conexión
$conexion->close();
?>
