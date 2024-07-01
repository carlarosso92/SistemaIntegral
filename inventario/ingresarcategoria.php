<?php include "config/conexion.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $nombrecategoria = $_POST["nombrecategoria"]; 
    $descripcion = $_POST["descripcion"];
   
    
    if ($conexion) {
        
        $insertar1 = "INSERT INTO categorias (nombrecategoria, descripcion) VALUES ('$nombrecategoria', '$descripcion')";
        $resultado1 = mysqli_query($conexion, $insertar1);
        
        $id_categoria = mysqli_insert_id($conexion);
        if ($resultado1) {
            
            echo "<script>alert('Los registros se ingresaron correctamente.');window.location.href = 'agregarcategoria.php';</script>";
        } else {
            echo "Error al ingresar los registros en la tabla categoria: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    } else {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
}
?>