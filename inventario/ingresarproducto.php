<?php include "config/conexion.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $nombrecategoria = $_POST["nombrecategoria"]; 
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $cantidad_stock = $_POST["cantidad_stock"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
   
    // Verificar si la conexión a la base de datos fue exitosa
    if ($conexion) {
        // Insertar datos en la tabla ..
        $insertar1 = "INSERT INTO categorias (nombrecategoria) VALUES ('$nombrecategoria')";
        $resultado1 = mysqli_query($conexion, $insertar1);
        
        if ($resultado1) {
            // Obtener el ID del último usuario insertado
            $id_categoria = mysqli_insert_id($conexion);
            
            // Insertar datos en la tabla ..
            $insertar2 = "INSERT INTO productos (nombre, id_categoria, descripcion, precio, cantidad_stock, fecha_vencimiento) VALUES ('$nombre','$id_categoria',  '$descripcion', '$precio', '$cantidad_stock', '$fecha_vencimiento')";
            $resultado2 = mysqli_query($conexion, $insertar2);
            
            // Verificar si la consulta fue exitosa
            if ($resultado2) {
                // Mensaje emergente en JS
                echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'agregarproducto.php';</script>";
            } else {
                echo "Error al ingresar los registros en la tabla clientes: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al ingresar los registros en la tabla usuarios: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>