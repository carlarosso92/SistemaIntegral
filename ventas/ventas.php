<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico - Ventas</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="css/ventas.css">
</head>
<body>
<?php include "../inventario/header.php"; ?>
    <main>
        <div class="contenedor-ventas">
            <div class="productos">
                <h2>Listado de Productos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Código de barra</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Subcategoría</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio original</th>
                            <th scope="col">% Descuento</th>
                            <th scope="col">Precio final</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../php/config.php';
                        $query = "SELECT 
                            prod.codigo_barras, 
                            cat.nombre_categoria, 
                            subc.nombre_subcategoria, 
                            prod.nombre, 
                            prod.descripcion, 
                            prod.precio, 
                            prod.cantidad_stock, 
                            prod.id_producto, 
                            des.valor_descuento,
                            (prod.precio * ( 1 - (IF(des.valor_descuento = 0,0,des.valor_descuento)) / 100)) as precio_final
                        FROM productos prod
                        INNER JOIN categorias cat ON prod.id_categoria = cat.id
                        LEFT JOIN subcategorias subc ON prod.id_subcategoria = subc.id
                        LEFT JOIN descuentos des ON prod.id_producto = des.producto_id";
                        $result = mysqli_query($conexion, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['codigo_barras']; ?></td>
                            <td><?php echo $row['nombre_categoria']; ?></td>
                            <td><?php echo $row['nombre_subcategoria']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['valor_descuento']; ?></td>
                            <td><?php echo $row['precio_final']; ?></td>
                            <td><?php echo $row['cantidad_stock']; ?></td>
                            <td>
                                <button class="button" onclick="agregarAlCarrito(<?php echo $row['id_producto']; ?>, '<?php echo $row['nombre']; ?>', <?php echo $row['precio_final']; ?>, <?php echo $row['cantidad_stock']; ?>)">Agregar al carrito</button>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>No se encontraron productos.</td></tr>";
                        }
                        mysqli_free_result($result);
                        mysqli_close($conexion);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="carrito">
                <h2>Carrito de Compra</h2>
                <ul id="carrito-lista"></ul>
                <p>Total: $<span id="total-carrito">0.00</span></p>
                <form id="form-procesar-compra" action="procesar_venta.php" method="POST">
                    <input type="hidden" name="carrito" id="carrito">
                    <button type="submit" class="button">Procesar Compra</button>
                </form>
            </div>
        </div>
    </main>
    <script>
    let carrito = [];

    function agregarAlCarrito(id, nombre, precio, stock) {
        let producto = carrito.find(p => p.id === id);
        if (producto) {
            if (producto.cantidad < stock) {
                producto.cantidad += 1;
            } else {
                alert('No hay suficiente stock disponible');
            }
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1, stock });
        }
        actualizarCarrito();
    }

    function quitarDelCarrito(id) {
        let producto = carrito.find(p => p.id === id);
        if (producto) {
            if (producto.cantidad > 1) {
                producto.cantidad -= 1;
            } else {
                carrito = carrito.filter(p => p.id !== id);
            }
        }
        actualizarCarrito();
    }

    function actualizarCarrito() {
        const listaCarrito = document.getElementById('carrito-lista');
        const totalCarrito = document.getElementById('total-carrito');
        const carritoInput = document.getElementById('carrito');
        listaCarrito.innerHTML = '';
        let total = 0;

        carrito.forEach(producto => {
            total += producto.precio * producto.cantidad;
            listaCarrito.innerHTML += `<li>${producto.nombre} - ${producto.cantidad} x $${producto.precio.toFixed(2)} 
            <button onclick="agregarAlCarrito(${producto.id}, '${producto.nombre}', ${producto.precio}, ${producto.stock})">+</button>
            <button onclick="quitarDelCarrito(${producto.id})">-</button></li>`;
        });

        totalCarrito.innerText = total.toFixed(2);
        carritoInput.value = JSON.stringify(carrito);
    }

    document.getElementById('form-procesar-compra').addEventListener('submit', function(event) {
        if (carrito.length === 0) {
            alert('El carrito está vacío');
            event.preventDefault();
            return;
        }

        // Realizar la solicitud AJAX para generar el PDF
        fetch('generar_ticket.php?venta_id=' + venta_id)
            .then(response => response.blob())
            .then(blob => {
                alert('Compra procesada');
                const pdfUrl = URL.createObjectURL(blob);
                window.open(pdfUrl, '_blank');
            })
            .catch(error => {
                console.error('Error al generar el ticket:', error);
                alert('Hubo un problema al generar el ticket. Por favor, inténtalo de nuevo.');
            });
        });
    </script>
</body>
</html>
