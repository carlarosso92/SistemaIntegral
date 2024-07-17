<?php
include "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $subcategoria = $_POST["subcategoria"];
    $proveedor = $_POST["proveedor"];
    $factura_proveedor = $_POST["factura_proveedor"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $cantidad_stock = $_POST["cantidad_stock"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
   
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        $randomNumber = rand(1000, 9999);
        $barcodeNumber = '00' . $categoria . '00' . $subcategoria .'00'. $proveedor . $randomNumber;
        
        // Insertar datos en la tabla productos
        $insertar = "INSERT INTO productos (nombre, id_categoria, id_subcategoria, id_proveedor, descripcion, precio, cantidad_stock, fecha_vencimiento, codigo_barras, factura_proveedor) VALUES ('$nombre', '$categoria', '$subcategoria', '$proveedor', '$descripcion', '$precio', '$cantidad_stock', '$fecha_vencimiento', '$barcodeNumber', '$factura_proveedor')";
        $resultado = mysqli_query($conexion, $insertar);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Mensaje emergente en JS
            echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'index.php';</script>";
        } else {
            echo "Error al ingresar los registros en la tabla productos: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>
