<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/global.css">
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
