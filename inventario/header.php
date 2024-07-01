<!DOCTYPE html>
<html>
<head>
  <title>Don Perico</title>
  <style>
    /* Estilos generales */
    body {
      font-family: sans-serif;
      margin: 0;
    }

    /* Encabezado */
    header {
      background-color: #72A603;
      color: yellow;
      padding: 15px 0;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
    }
    img{
      width: 10%;
    }

     /* Header Container */
     .container {
      max-width: 1200px;
      margin: 0 auto; /* Centers the container horizontally */
      padding: 0 15px;
      display: flex;
      align-items: center;
      justify-content: space-between; /* Distributes items evenly */
      width: 100%; /* Ensures the container takes full width */
    }
    h1 {
      margin: 0;
      font-size: 2em;
      font-family: sans-serif;
    }

    input[type="text"] {
      padding: 8px;
      border: black 1px;
      border-radius: 20px;
      flex-grow: 1;
      margin: 0 px;
    }

    .user-options {
      display: flex;
      align-items: center;
    }

    .user-options a, .user-options span {
      color: yellow;
      text-decoration: none;
      margin-left: 15px;
      position: top;
    }

    .cart {
      background-color: yellow;
      color: #669900;
      padding: 5px 8px;
      border-radius: 50%;
    }

    /* Menú de navegación */
    nav {
      background-color: #e6e6e6;
      padding: 10px 0;
      text-align: center;
      margin-top: 70px; /* Espacio para el encabezado fijo */
    }

    nav a {
      color: #333;
      text-decoration: none;
      margin: 0 15px;
    }

    /* Menú de categorías */
    .categories-menu {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-top: 10px;
    }

    .categories-menu a {
      display: block;
      color: #333;
      text-decoration: none;
      padding: 5px 10px;
    }

    /* Carrusel de imágenes */
    .carousel {
      width: 100%;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .carousel img {
      width: 100%;
      height: auto;
    }

    /* Sección de productos */
    .products-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }

    .product {
      width: 23%;
      margin-bottom: 20px;
      text-align: center;
    }

    .product img {
      max-width: 100%;
      height: auto;
    }

    /* Media queries para responsive design */
    @media (max-width: 768px) {
      .product {
        width: 48%;
      }
    }

    @media (max-width: 480px) {
      .product {
        width: 100%;
      }

      .container {
        flex-direction: column;
        align-items: flex-start;
      }

      h1 {
        margin-bottom: 10px;
      }

      input[type="text"] {
        width: 100%;
        margin-bottom: 10px;
      }

      .user-options {
        flex-direction: column;
        align-items: flex-start;
      }

      .user-options a, .user-options span {
        margin-left: 0;
        margin-bottom: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <header>
      <div class="container">
        <img src="../img/logo.png" alt="Don Perico Logo">
        <h1>Don Perico</h1>
        <input type="text" placeholder="¿Qué buscas?...">

        <div class="user-options">
          <a href="#">¡Hola!</a>
          <a href="#">Inicia sesión</a>
          <span class="cart">0</span>
          <a href="#">Mis pedidos</a>
        </div>
      </div>
    </header>
  </div>
</body>
</html>
