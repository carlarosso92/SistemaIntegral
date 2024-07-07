<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Perico</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="carrusel">
            <div class="slides">
                <img src="img/banner1.jpg" alt="Banner 1">
                <img src="img/banner2.jpg" alt="Banner 2">
                <img src="img/banner3.jpg" alt="Banner 3">
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
        <section id="galeria" class="galeria">
            <img src="img/tienda1.jpg" alt="Tienda 1">
            <img src="img/tienda2.jpg" alt="Tienda 2">
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
