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

// Manejo de la nueva imagen
if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenNombre = $id_producto . ".jpg";
    $rutaDestino = '../img/productos/' . $imagenNombre;

    // Eliminar la imagen anterior si existe
    if (file_exists($rutaDestino)) {
        unlink($rutaDestino);
    }

    // Mover la imagen a la carpeta de destino
    if (move_uploaded_file($imagenTmp, $rutaDestino)) {
        echo "Imagen actualizada correctamente.";
    } else {
        echo "Error al actualizar la imagen.";
    }
}

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
