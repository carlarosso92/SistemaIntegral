<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/global.css">

    <style>
        /* Estilo para el botón de todas las categorías y el menú desplegable */
        .category-button {
            background-color: #EAF207;
            color: green;
            padding: 10px;
            border: 2px solid black;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .category-button:hover {
            background-color: #72A603;
            color: #EAF207;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #F9F9F9;
            min-width: 300px;
            max-height: 400px; /* Altura máxima del menú desplegable */
            overflow-y: auto; /* Barra de desplazamiento vertical */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 10px;
            padding: 10px;
            left: 0;
        }

        .dropdown-category {
            margin-bottom: 10px;
        }

        /* Estilo para el texto de las categorías */
        .dropdown-category strong {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
            color: #72A603; /* Cambia este valor al color deseado */
        }

        .dropdown-category a {
            color: black;
            padding: 5px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin: 2px 0;
        }

        .dropdown-category a:hover {
            background-color: #EAF207;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Estilo para el botón de volver arriba */
        #backToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #555;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
        }

        #backToTopBtn:hover {
            background-color: #333;
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
                        <button class="category-button">Todas las Categorías</button>
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
