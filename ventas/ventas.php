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
    <header>
        <div class="contenedor">
            <img src="../img/logo.png" alt="Logo">
            <h1>Don Perico</h1>
            <input type="text" placeholder="¿Qué buscas?">
            <div class="opcionusuario">
                <a href="#">Iniciar Sesión</a>
                <a href="#">Registrarse</a>
            </div>
        </div>
        <nav>
            <div class="menuopcion">
                <ul>
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>
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
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../php/config.php';
                        $query = "SELECT p.codigo_barras, c.nombre_categoria, s.nombre_subcategoria, p.nombre, p.descripcion, p.precio, p.cantidad_stock, p.id_producto
                                  FROM productos p
                                  INNER JOIN categorias c ON p.id_categoria = c.id
                                  LEFT JOIN subcategorias s ON p.id_subcategoria = s.id";
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
                            <td><?php echo $row['cantidad_stock']; ?></td>
                            <td>
                                <button class="button" onclick="agregarAlCarrito(<?php echo $row['id_producto']; ?>, '<?php echo $row['nombre']; ?>', <?php echo $row['precio']; ?>, <?php echo $row['cantidad_stock']; ?>)">Agregar al carrito</button>
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

        // Aquí puedes agregar la lógica para procesar la compra
        // y disminuir el stock de productos en la base de datos
        alert('Compra procesada');
        
        actualizarCarrito();
        window.open('generar_ticket.php?venta_id=' + venta_id, '_blank');
    });
    </script>
</body>
</html>
