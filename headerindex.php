<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
                /* Estilo para el precio original tachado */
        .precio-original {
            text-decoration: line-through !important;
            color: red !important;
            font-size: 1em !important;
        }

        /* Estilo para el precio con descuento */
        .precio-con-descuento {
            color: green;
            font-size: 1.2em;
            font-weight: bold;
        }

        /* Estilo para el porcentaje de descuento */
        .descuento {
            color: orange;
            font-size: 1em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="contenedor">
            <img src="img/logo.png" alt="Logo">
            <h1>Don Perico</h1>
            
            <input type="text" placeholder="¿Qué buscas?">
            <div class="opcionusuario">
                <?php if (isset($_SESSION['cliente_nombre'])): ?>
                    <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['cliente_nombre']); ?></span>
        <a href="gestioncliente.php" id="editarPerfilButton">Editar Perfil</a>
        <a href="cerrarsesioncliente.php" id="cerrarSesionButton">Cerrar Sesión</a>

                <?php else: ?>
                    <a href="crudlogincliente.php">Iniciar Sesión</a>
                    <a href="crudcliente.php">Registrarse</a>
                <?php endif; ?>
            </div>
            <div class="separator"></div>
            <div class="carrito">
                <button id="carritoButton"><i class="fas fa-shopping-cart"></i> Carrito</button>
            </div>
        </div>
        <nav>
            <div class="menuopcion">
                <ul>
                <a href="index.php" class="home-button">
                <i class="fas fa-home"></i>
            </a>
                    <li><a href="pantallaproducto.php">Productos</a></li>
                    <li><a href="#ofertas">Ofertas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li class="dropdown">
                        <button class="category-button" id="categoryButton">Todas las Categorías</button>
                        <div class="dropdown-content" id="categoryMenu">
                            <!-- Aquí se cargarán dinámicamente las subcategorías con JavaScript -->
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Pantalla lateral del carrito -->
    <div id="carritoLateral" class="carrito-lateral">
        <div class="carrito-header">
            <span>Carrito de Compras</span>
            <button id="closeCarrito" class="close-carrito">&times;</button>
        </div>
        <div class="carrito-body">
            <div class="carrito-vacio" id="carritoVacio">
                <p>Tu carro está vacío</p>
            </div>
            <ul id="carritoItems">
                <!-- Aquí se cargarán los productos con JavaScript -->
            </ul>
            <div class="carrito-footer">
                <p>Total: <span id="totalCarrito">$0</span></p>
                <button id="checkoutButton">Reservar</button>
            </div>
        </div>
    </div>

    <!-- Botón de volver arriba -->
    <button id="backToTopBtn" title="Volver arriba">↑</button>

    <script>
        // Mostrar el botón cuando el usuario desplaza hacia abajo 20px desde la parte superior del documento
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("backToTopBtn").style.display = "block";
            } else {
                document.getElementById("backToTopBtn").style.display = "none";
            }
        }

        // Desplazar hacia arriba cuando el usuario hace clic en el botón
        document.getElementById("backToTopBtn").onclick = function() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        // Mostrar y ocultar el menú de categorías al hacer clic
        document.getElementById('categoryButton').onclick = function() {
            const menu = document.getElementById('categoryMenu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        };

        // Mostrar y ocultar el carrito lateral
        document.getElementById('carritoButton').onclick = function() {
            document.getElementById('carritoLateral').style.width = '600px';
        };

        document.getElementById('closeCarrito').onclick = function() {
            document.getElementById('carritoLateral').style.width = '0';
        };

        // Función para actualizar el carrito
        function actualizarCarrito(carrito) {
            const carritoItems = document.getElementById('carritoItems');
            const carritoVacio = document.getElementById('carritoVacio');
            carritoItems.innerHTML = '';

            let total = 0;
            let tieneProductos = false;
            for (const [id, producto] of Object.entries(carrito)) {
                const item = document.createElement('li');
                const precioOriginal = parseFloat(producto.price);
                const descuento = parseFloat(producto.descuento) || 0;
                const precioConDescuento = precioOriginal * (1 - descuento / 100);

                console.log(`Producto ID: ${id}, Precio Original: ${precioOriginal}, Descuento: ${descuento}, Precio con Descuento: ${precioConDescuento}`);

                item.innerHTML = `
                    <div class="producto-carrito">
                        <img src="${producto.imagen}" alt="${producto.name}">
                        <div>
                            <p>${producto.name}</p>
                            <p class="precio-con-descuento">$${precioConDescuento}</p>
                            <div class="cantidad">
                                <button onclick="modificarCantidad(${id}, -1)">-</button>
                                <span>${producto.quantity}</span>
                                <button onclick="modificarCantidad(${id}, 1)">+</button>
                            </div>
                            <button class="eliminar" onclick="eliminarProducto(${id})">X</button>
                        </div>
                    </div>
                `;
                carritoItems.appendChild(item);
                total += precioConDescuento * producto.quantity;
                tieneProductos = true;
            }

            document.getElementById('totalCarrito').innerText = `$${total}`;

            // Mostrar u ocultar el mensaje de carrito vacío
            if (tieneProductos) {
                carritoVacio.style.display = 'none';
            } else {
                carritoVacio.style.display = 'block';
            }
        }

        // Función para modificar la cantidad de un producto en el carrito
        function modificarCantidad(productId, cantidad) {
            fetch('logicapantallaproducto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=modify&product_id=${productId}&quantity=${cantidad}`
            })
            .then(response => response.json())
            .then(data => {
                actualizarCarrito(data.cart);
            })
            .catch(error => console.error('Error:', error));
        }

        // Función para eliminar un producto del carrito
        function eliminarProducto(productId) {
            fetch('logicapantallaproducto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=remove&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                actualizarCarrito(data.cart);
            })
            .catch(error => console.error('Error:', error));
        }

        // Cargar las categorías y subcategorías dinámicamente desde indexlogica.php
        document.addEventListener('DOMContentLoaded', function() {
            fetch('indexlogica.php')
                .then(response => response.json())
                .then(data => {
                    const categoryMenu = document.getElementById('categoryMenu');
                    for (const [category, products] of Object.entries(data)) {
                        const categoryDiv = document.createElement('div');
                        categoryDiv.classList.add('dropdown-category');
                        categoryDiv.innerHTML = `<strong>${category}</strong>`;
                        products.forEach(product => {
                            const productLink = document.createElement('a');
                            productLink.href = '#';
                            productLink.textContent = product;
                            categoryDiv.appendChild(productLink);
                        });
                        categoryMenu.appendChild(categoryDiv);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
