<?php
include "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $proveedor = $_POST["proveedor"];
    $factura_proveedor = $_POST["factura_proveedor"];
    $categorias = $_POST["categoria"];
    $subcategorias = $_POST["subcategoria"];
    $nombres = $_POST["nombre"];
    $descripciones = $_POST["descripcion"];
    $precios = $_POST["precio"];
    $cantidades = $_POST["cantidad_stock"];
    $fechas_vencimiento = $_POST["fecha_vencimiento"];

    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Insertar datos en la tabla facturas_proveedores
        $insertarFactura = "INSERT INTO facturas_proveedores (proveedor_id, numero_factura, fecha_pago, descripcion, monto, flagpagado) VALUES ('$proveedor', '$factura_proveedor', NOW(), '', 0, 0)";
        $resultadoFactura = mysqli_query($conexion, $insertarFactura);

        if ($resultadoFactura) {
            $facturaId = mysqli_insert_id($conexion);

            foreach ($nombres as $index => $nombre) {
                $categoria = $categorias[$index];
                $subcategoria = $subcategorias[$index];
                $descripcion = $descripciones[$index];
                $precio = $precios[$index];
                $cantidad_stock = $cantidades[$index];
                $fecha_vencimiento = $fechas_vencimiento[$index];

                $randomNumber = rand(1000, 9999);
                $barcodeNumber = '00' . $categoria . '00' . $subcategoria . '00' . $proveedor . $randomNumber;

                // Insertar datos en la tabla productos
                $insertarProducto = "INSERT INTO productos (nombre, id_categoria, id_subcategoria, id_proveedor, descripcion, precio, cantidad_stock, fecha_vencimiento, codigo_barras, factura_proveedor) VALUES ('$nombre', '$categoria', '$subcategoria', '$proveedor', '$descripcion', '$precio', '$cantidad_stock', '$fecha_vencimiento', '$barcodeNumber', '$facturaId')";
                $resultadoProducto = mysqli_query($conexion, $insertarProducto);

                // Verificar si la consulta fue exitosa
                if (!$resultadoProducto) {
                    echo "Error al ingresar los registros en la tabla productos: " . mysqli_error($conexion);
                    break;
                }
            }

            // Si todas las consultas fueron exitosas
            if ($resultadoProducto) {
                echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'index.php';</script>";
            }
        } else {
            echo "Error al ingresar los registros en la tabla facturas_proveedores: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>
