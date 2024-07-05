<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <title>minimarket</title>
</head>
<body>
    <header>
        <div class="contenedor">
            <img src="img/logo.png" alt="Don Perico Logo">
            <h1>Don Perico</h1>
            <input type="text" placeholder="¿Qué buscas?...">

            <div class="opcionusuario">
                <a href="crudlogincliente.php">¡Hola! Inicia sesión</a>
                <a href="#">Mis pedidos</a>
            </div><br>       
        </div>
        <div class="menuopcion">
            <nav>
                <ul>
                    <li><a href="">Categorías</a></li> 
                    <li><a href="">Ofertas</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="offers" class="parallax"> 
            <div class="offer-container">
                <div class="offer-box">¡ oferta ! 15%</div>
                <div class="offer-box">oferta 10%</div>
                <div class="offer-box">oferta 15%</div>
            </div>
        </section>

        <section id="product-list">
            <h2>Productos</h2>
            <div class="product-grid">
                </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </section>
    </main>

    <footer>
        <div class="contact-info">
            <h3>contacto</h3>
            </div>
    </footer>
</body>
</html>
