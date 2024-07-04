<?php
include "config/conexion.php";

if (isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];
    
    $sqlSubcategoria = "SELECT id, nombre_subcategoria FROM subcategorias WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sqlSubcategoria);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $subcategorias = array();
    while ($row = $result->fetch_assoc()) {
        $subcategorias[] = $row;
    }
    
    echo json_encode($subcategorias);
}
?>
