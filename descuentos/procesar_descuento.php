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
        echo "Descuento aplicado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
