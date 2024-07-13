<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="stylesheet" href="css/index.css">
    <?php include "headerindex.php"; ?>
</head>
<body>
    <main>
        <section class="carrusel">
            <div class="slides">
                <img src="img/banner1.jpg" alt="Banner 1" class="active">
                <img src="img/banner2.jpg" alt="Banner 2">
                <img src="img/banner3.jpg" alt="Banner 3">
            </div>
            <div class="indicators">
                <span class="dot" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
        </section>
    
        <section id="ofertas" class="ofertas">
            <h2>Ofertas</h2>
            <div class="ofertas-grid">
                <?php
                include 'php/config.php';
                // Consultar productos con oferta
                $ofertas_query = "SELECT p.*, d.valor_descuento 
                                  FROM productos p 
                                  JOIN descuentos d ON p.id_producto = d.producto_id 
                                  WHERE CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin";
                $ofertas_result = mysqli_query($conexion, $ofertas_query);
                while ($oferta = mysqli_fetch_assoc($ofertas_result)) {
                    echo '<div class="oferta">';
                    echo '<img src="img/producto_default.jpg" alt="' . htmlspecialchars($oferta['nombre']) . '">';
                    echo '<h3>' . htmlspecialchars($oferta['nombre']) . '</h3>';
                    echo '<p class="precio-original">$' . number_format($oferta['precio'], 2) . '</p>';
                    $precio_con_descuento = $oferta['precio'] * (1 - $oferta['valor_descuento'] / 100);
                    echo '<p class="precio-con-descuento">$' . number_format($precio_con_descuento, 2) . '</p>';
                    echo '<p class="descuento">-' . $oferta['valor_descuento'] . '%</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
        
        <section id="productos" class="productos">
            <h2>Productos</h2>
            <div class="productos-carrusel">
                <?php
                // Consultar todos los productos
                $productos_query = "SELECT * FROM productos";
                $productos_result = mysqli_query($conexion, $productos_query);
                while ($producto = mysqli_fetch_assoc($productos_result)) {
                    echo '<div class="producto">';
                    echo '<img src="img/producto_default.jpg" alt="' . htmlspecialchars($producto['nombre']) . '">';
                    echo '<h3>' . htmlspecialchars($producto['nombre']) . '</h3>';
                    echo '<p>$' . number_format($producto['precio'], 2) . '</p>';
                    echo '<button>Agregar</button>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="controls">
                <span class="prev" onclick="changeProductSlide(-1)">&#10094;</span>
                <span class="next" onclick="changeProductSlide(1)">&#10095;</span>
            </div>
        </section>
    </main>

    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slides img');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = (i === index) ? 'block' : 'none';
                dots[i].classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        }

        function changeSlide(n) {
            slideIndex = (slideIndex + n + totalSlides) % totalSlides;
            showSlide(slideIndex);
        }

        function currentSlide(n) {
            slideIndex = n;
            showSlide(slideIndex);
        }

        function startCarousel() {
            showSlide(slideIndex);
            setInterval(nextSlide, 3000); // Cambia de imagen cada 3 segundos
        }

        document.addEventListener('DOMContentLoaded', startCarousel);
        
        let productSlideIndex = 0;
        const products = document.querySelectorAll('.productos-carrusel .producto');
        const totalProducts = products.length;
        const visibleProducts = 3; // Número de productos visibles
        const productWidth = 280; // Ancho del producto más el margen

        function showProductSlide(index) {
            const offset = index * -productWidth;
            products.forEach(product => {
                product.style.transform = `translateX(${offset}px)`;
            });
        }

        function changeProductSlide(n) {
            const maxIndex = totalProducts - visibleProducts;
            productSlideIndex = (productSlideIndex + n + totalProducts) % totalProducts;
            if (productSlideIndex > maxIndex) {
                productSlideIndex = maxIndex;
            } else if (productSlideIndex < 0) {
                productSlideIndex = 0;
            }
            showProductSlide(productSlideIndex);
        }

        document.addEventListener('DOMContentLoaded', () => showProductSlide(productSlideIndex));
    </script>
    <footer id="contacto">
        <p>&copy; 2024 Don Perico. Todos los derechos reservados.</p>
        <p><a href="formulario_contacto.php">Contáctanos aquí</a></p>
    </footer>
</body>
</html>
