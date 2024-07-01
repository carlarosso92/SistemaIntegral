<?php
include "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario y limpiarlos (opcional)
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $categoria = $_POST["categoria"];
    $subcategoria = $_POST["subcategoria"];
    $proveedor = $_POST["proveedor"];
    $descripcion = mysqli_real_escape_string($conexion, $_POST["descripcion"]);
    $precio = $_POST["precio"];
    $cantidad_stock = $_POST["cantidad_stock"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
   
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Preparar la consulta SQL utilizando una sentencia preparada
        $insertar = "INSERT INTO productos (nombre, id_categoria, id_subcategoria, id_proveedor, descripcion, precio, cantidad_stock, fecha_vencimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conexion, $insertar);
        
        if ($stmt) {
            // Vincular parámetros a la consulta preparada
            mysqli_stmt_bind_param($stmt, "siiisdis", $nombre, $categoria, $subcategoria, $proveedor, $descripcion, $precio, $cantidad_stock, $fecha_vencimiento);
            
            // Ejecutar la consulta preparada
            mysqli_stmt_execute($stmt);
            
            // Verificar si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Mensaje emergente en JS y redirección
                echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'agregarproducto.php';</script>";
            } else {
                echo "Error al ingresar los registros en la tabla productos: " . mysqli_stmt_error($stmt);
            }
            
            // Cerrar la declaración preparada
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>
