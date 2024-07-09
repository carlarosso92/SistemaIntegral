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
                <div class="oferta">Oferta 10%</div>
                <div class="oferta">Oferta 15%</div>
                <div class="oferta">Oferta 20%</div>
                <div class="oferta">Oferta 25%</div>
            </div>
        </section>
        
        <section id="productos" class="productos">
    <h2>Productos</h2>
    <div class="productos-carrusel">
        <div class="producto">
            <img src="img/producto1.jpg" alt="Producto 1">
            <h3>Nombre del producto</h3>
            <p>Valor</p>
            <button>Agregar</button>
        </div>
        <div class="producto">
            <img src="img/producto2.jpg" alt="Producto 2">
            <h3>Nombre del producto</h3>
            <p>Valor</p>
            <button>Agregar</button>
        </div>
        <div class="producto">
            <img src="img/producto3.jpg" alt="Producto 3">
            <h3>Nombre del producto</h3>
            <p>Valor</p>
            <button>Agregar</button>
        </div>
        <div class="producto">
            <img src="img/producto4.jpg" alt="Producto 4">
            <h3>Nombre del producto</h3>
            <p>Valor</p>
            <button>Agregar</button>
        </div>
        <div class="producto">
            <img src="img/producto5.jpg" alt="Producto 5">
            <h3>Nombre del producto</h3>
            <p>Valor</p>
            <button>Agregar</button>
        </div>
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
    
</body>

</html>
