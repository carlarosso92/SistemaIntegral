<?php
session_start();
include('php/config.php');

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    if ($_POST['action'] == 'add') {
        // Lógica para agregar un producto al carrito
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $product_query = "SELECT * FROM productos WHERE id_producto = $product_id";
            $product_result = mysqli_query($conexion, $product_query);
            $product = mysqli_fetch_assoc($product_result);

            $_SESSION['cart'][$product_id] = [
                'id' => $product['id_producto'],
                'name' => $product['nombre'],
                'price' => $product['precio'],
                'quantity' => 1,
                'imagen' => 'img/producto_default.jpg' // Puedes cambiar esto para usar imágenes reales
            ];
        }
    } elseif ($_POST['action'] == 'modify') {
        // Lógica para modificar la cantidad de un producto en el carrito
        $quantity = $_POST['quantity'];
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    } elseif ($_POST['action'] == 'remove') {
        // Lógica para eliminar un producto del carrito
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    $response['cart'] = $_SESSION['cart'];
    echo json_encode($response);
    exit();
} else {
    // Obtener categorías, subcategorías y productos
    $categorias_query = "SELECT * FROM categorias";
    $categorias_result = mysqli_query($conexion, $categorias_query);

    $data = [];
    $data['categorias'] = [];
    $data['productos'] = [];

    while ($categoria = mysqli_fetch_assoc($categorias_result)) {
        $categoria_id = $categoria['id'];
        $categoria_nombre = $categoria['nombre_categoria'];

        $subcategorias_query = "SELECT * FROM subcategorias WHERE id_categoria = $categoria_id";
        $subcategorias_result = mysqli_query($conexion, $subcategorias_query);

        $subcategorias = [];
        while ($subcategoria = mysqli_fetch_assoc($subcategorias_result)) {
            $subcategorias[] = [
                'id' => $subcategoria['id'],
                'nombre' => $subcategoria['nombre_subcategoria']
            ];
        }

        $data['categorias'][] = [
            'id' => $categoria_id,
            'nombre' => $categoria_nombre,
            'subcategorias' => $subcategorias
        ];
    }

    // Obtener productos con descuentos
    $productos_query = "SELECT p.*, IFNULL(d.valor_descuento, 0) AS descuento 
                        FROM productos p
                        LEFT JOIN descuentos d ON p.id_producto = d.producto_id
                        AND CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin";
    $productos_result = mysqli_query($conexion, $productos_query);

    while ($producto = mysqli_fetch_assoc($productos_result)) {
        // Depuración: Verificar que los datos del producto son correctos
        // echo "<pre>"; var_dump($producto); echo "</pre>"; // Puedes habilitar esto para depurar

        $data['productos'][] = [
            'id' => $producto['id_producto'],
            'nombre' => $producto['nombre'],
            'descripcion' => $producto['descripcion'],
            'precio' => (float) $producto['precio'], // Asegurarse de que el precio es un número
            'descuento' => (float) $producto['descuento'], // Asegurarse de que el descuento es un número
            'imagen' => 'img/producto_default.jpg'
        ];
    }

    // Enviar los datos como JSON
    echo json_encode($data);
    exit();
}
?>
