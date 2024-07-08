<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="contenedor">
            <img src="img/logo.png" alt="Logo">
            <h1>Don Perico</h1>
            <input type="text" placeholder="¿Qué buscas?">
            <div class="opcionusuario">
                <a href="#">Iniciar Sesión</a>
                <a href="#">Registrarse</a>
            </div>
            <div class="carrito">
                <button id="carritoButton"><i class="fas fa-shopping-cart"></i> Carrito</button>
            </div>
        </div>
        <nav>
            <div class="menuopcion">
                <ul>
                    <li><a href="#productos">Productos</a></li>
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
            <div class="carrito-vacio">
                <p>Tu carro está vacío</p>
                <p>Navega por las ofertas y categorías</p>
                <button id="intentaloAquiButton">Inténtalo aquí</button>
            </div>
            <ul id="carritoItems">
                <!-- Aquí se cargarán los productos con JavaScript -->
            </ul>
            <div class="carrito-footer">
                <p>Total: <span id="totalCarrito">$0</span></p>
                <button id="checkoutButton">Ir a Pagar</button>
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
            document.getElementById('carritoLateral').style.width = '300px';
        };

        document.getElementById('closeCarrito').onclick = function() {
            document.getElementById('carritoLateral').style.width = '0';
        };

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
