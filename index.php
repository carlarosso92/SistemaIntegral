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
                 <!--<div class="controls">
                    <span class="prev" onclick="changeSlide(-1)">&#10094;</span>
                    <span class="next" onclick="changeSlide(1)">&#10095;</span>
                </div> -->
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
            <div class="productos-grid">
                <div class="producto">
                    <h3>Nombre del producto</h3>
                    <p>Valor</p>
                    <button>Agregar</button>
                </div>
                <div class="producto">
                    <h3>Nombre del producto</h3>
                    <p>Valor</p>
                    <button>Agregar</button>
                </div>
                <div class="producto">
                    <h3>Nombre del producto</h3>
                    <p>Valor</p>
                    <button>Agregar</button>
                </div>
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
    </script>
</body>
</html>
