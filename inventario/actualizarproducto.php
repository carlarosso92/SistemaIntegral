<?php
include_once("config/conexion.php");

// Obtener los datos del formulario
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad_stock = $_POST['cantidad_stock'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$proveedor = $_POST['proveedor'];

// Actualizar el producto en la base de datos
$sql_actualizar = "UPDATE productos SET 
    nombre = '$nombre',
    id_categoria = '$categoria',
    id_subcategoria = '$subcategoria',
    descripcion = '$descripcion',
    precio = '$precio',
    cantidad_stock = '$cantidad_stock',
    fecha_vencimiento = '$fecha_vencimiento',
    id_proveedor = '$proveedor'
    WHERE id_producto = '$id_producto'";

if ($conexion->query($sql_actualizar) === TRUE) {
    echo "Producto actualizado exitosamente";
} else {
    echo "Error actualizando el producto: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();

// Redireccionar a la página de listado de productos
header("Location: index.php");
exit;
?>
