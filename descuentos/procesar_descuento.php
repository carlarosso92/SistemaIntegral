<?php
include "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $tipo_descuento = $_POST['tipo_descuento'];
    $valor_descuento = $_POST['valor_descuento'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $sql = "INSERT INTO descuentos (producto_id, tipo_descuento, valor_descuento, fecha_inicio, fecha_fin) 
            VALUES ('$producto_id', '$tipo_descuento', '$valor_descuento', '$fecha_inicio', '$fecha_fin')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>
                alert('Descuento aplicado exitosamente.');
                window.location.href = 'aplicar_descuentos.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conexion) . "');
                window.location.href = 'aplicar_descuentos.php';
              </script>";
    }

    mysqli_close($conexion);
}
?>
