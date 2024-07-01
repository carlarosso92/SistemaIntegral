<?php
// get_proveedores.php

include "config/conexion.php";

$sql = "SELECT id, nombre_proveedor FROM proveedores";
$result = $conexion->query($sql);

$proveedores = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = array(
            'id' => $row['id'],
            'nombre_proveedor' => $row['nombre_proveedor']
        );
    }
}

// Devolver respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($proveedores);
?>
