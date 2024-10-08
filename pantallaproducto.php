<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Don Perico</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/producto.css">
    <link rel="icon" href="../img/logo2.png" type="image/png">
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
    <?php
    session_start();
    include('headerindex.php'); 
    ?>

    <div class="contenedor-productos">
        <aside class="filtros">
            <h2>Productos</h2>
            <p id="productos-count">0 productos</p>
            <div class="subcategorias">
                <h3>Subcategorías</h3>
                <ul id="categorias-list"></ul>
            </div>
        </aside>
        <section class="productos">
            <div class="ordenar">
                <label for="ordenar">Ordenar</label>
                <select id="ordenar">
                    <option value="recomendados">Recomendados</option>
                    <option value="precio-asc">Precio: Menor a Mayor</option>
                    <option value="precio-desc">Precio: Mayor a Menor</option>
                </select>
            </div>
            <div class="lista-productos" id="productos-list"></div>
        </section>
    </div>

    <!-- Modal para reserva -->
    <div id="reservaModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirmar Reserva</h2>
            <form id="reservaForm">
                <label for="hora_retiro">Hora de Retiro:</label>
                <select id="hora_retiro" name="hora_retiro" required>
                    <option value="">Selecciona una hora</option>
                    <!-- Generar opciones de 10 AM a 8 PM -->
                    <?php 
                    for ($i = 10; $i <= 20; $i++) {
                        echo "<option value='$i:00'>$i:00</option>";
                    }
                    ?>
                </select>
                <button type="submit">Confirmar Reserva</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar categorías y productos desde logicapantallaproducto.php
            fetch('logicapantallaproducto.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Depuración: Verificar datos recibidos

                    // Actualizar el conteo de productos
                    document.getElementById('productos-count').innerText = `${data.productos.length} productos`;

                    // Cargar categorías y subcategorías
                    const categoriasList = document.getElementById('categorias-list');
                    data.categorias.forEach(categoria => {
                        const categoriaItem = document.createElement('li');
                        categoriaItem.innerHTML = `<strong>${categoria.nombre}</strong>`;
                        const subcategoriasList = document.createElement('ul');
                        categoria.subcategorias.forEach(subcategoria => {
                            const subcategoriaItem = document.createElement('li');
                            subcategoriaItem.innerHTML = `<a href="#">${subcategoria.nombre}</a>`;
                            subcategoriasList.appendChild(subcategoriaItem);
                        });
                        categoriaItem.appendChild(subcategoriasList);
                        categoriasList.appendChild(categoriaItem);
                    });

                    // Cargar productos
                    const productosList = document.getElementById('productos-list');
                    data.productos.forEach(producto => {
                        const productoDiv = document.createElement('div');
                        productoDiv.classList.add('producto');

                        const precioConDescuento = producto.precio * (1 - producto.descuento / 100);
                        const precioOriginal = producto.precio;

                        productoDiv.innerHTML = `
                            <img src="img/productos/${producto.id}.jpg" alt="${producto.nombre}">
                            ${producto.descuento > 0 ? `<p class="precio-original">$${precioOriginal}</p>` : ''}
                            <p class="precio-con-descuento">$${precioConDescuento}</p>
                            ${producto.descuento > 0 ? `<p class="descuento">-${producto.descuento}%</p>` : ''}
                            <p class="descripcion">${producto.nombre}</p>
                            <button class="btn-agregar" data-id="${producto.id}">Agregar</button>
                        `;
                        productosList.appendChild(productoDiv);
                    });

                    // Agregar eventos a los botones "Agregar"
                    const addButtons = document.querySelectorAll('.btn-agregar');
                    addButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = this.getAttribute('data-id');

                            fetch('logicapantallaproducto.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `action=add&product_id=${productId}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Producto agregado al carrito:', data);
                                actualizarCarrito(data.cart); // Llamada para actualizar el carrito
                            })
                            .catch(error => console.error('Error:', error));
                        });
                    });
                })
                .catch(error => console.error('Error:', error));

            // Modal
            const modal = document.getElementById("reservaModal");
            const span = document.getElementsByClassName("close")[0];

            document.getElementById("checkoutButton").onclick = function() {
                modal.style.display = "block";
            };

            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };

            // Manejar el formulario de reserva
            document.getElementById('reservaForm').onsubmit = function(event) {
                event.preventDefault();
                const horaRetiro = document.getElementById('hora_retiro').value;

                if (!horaRetiro) {
                    alert('Por favor selecciona una hora de retiro.');
                    return;
                }

                // Verificar si la sesión está iniciada
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    // La sesión está iniciada, procesar la reserva
                    fetch('procesar_reserva.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `hora_retiro=${horaRetiro}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Reserva procesada:', data);
                        if (data.success) {
                            alert('Reserva confirmada.');
                            modal.style.display = "none";
                            actualizarCarrito({}); // Limpiar el carrito

                            // Generación de pdf de reserva
                            fetch('generar_ticket_reserva.php')
                            .then(response => response.blob())
                            .then(blob => {
                                const pdfUrl = URL.createObjectURL(blob);
                                window.open(pdfUrl, '_blank');
                            })
                            .catch(error => {
                                console.error('Error al generar el ticket:', error);
                                alert('Hubo un problema al generar el ticket. Por favor, inténtalo de nuevo.');
                            });
                        } else {
                            alert('Error al procesar la reserva.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                <?php else: ?>
                    // La sesión no está iniciada, redirigir a la página de inicio de sesión
                    window.location.href = 'crudlogincliente.php';
                <?php endif; ?>
            };
        });

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
                        <img src="img/productos/${producto.id}.jpg" alt="${producto.nombre}">
                        <div>
                            <p>${producto.name}</p>
                            <p class="precio-con-descuento">$${precioConDescuento}</p>
                            <div class="cantidad">
                                <button onclick="modificarCantidad(${id}, -1)">-</button>
                                <span>${producto.quantity}</span>
                                <button onclick="modificarCantidad(${id}, 1)">+</button>
                            </div>
                            <button class="eliminar" onclick="eliminarProducto(${id})">Eliminar</button>
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
    <footer id="contacto">
        <p>&copy; 2024 Don Perico. Todos los derechos reservados.</p>
        <p><a href="formulario_contacto.php">Contáctanos aquí</a></p>
    </footer>
</body>
</html>
