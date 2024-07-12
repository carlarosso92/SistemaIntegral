<!DOCTYPE html>
<html>
<head>
    <title>Aplicar Descuentos - Don Perico</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
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
      position: relative;
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
    <header>
        <div class="container">
            <img src="../img/logo.png" alt="Don Perico Logo">
            <h1>Don Perico</h1>
            <div class="user-options">
                <a href="#">Empleado</a>
                <ul>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="main-container">
        <h2>Aplicar Descuentos</h2>
        <form action="procesar_descuento.php" method="POST">
            <label for="producto">Producto:</label>
            <select id="producto" name="producto_id">
                <?php
                include "config/conexion.php";
                $result = mysqli_query($conexion, "SELECT id_producto, nombre FROM productos");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_producto'] . "'>" . $row['nombre'] . "</option>";
                }
                ?>
            </select><br><br>

            <label for="tipo_descuento">Tipo de Descuento:</label>
            <select id="tipo_descuento" name="tipo_descuento">
                <option value="categoria">Categoría</option>
                <option value="producto">Producto</option>
                <option value="marca">Marca</option>
                <option value="dia">Día</option>
            </select><br><br>

            <label for="valor_descuento">Valor del Descuento (%):</label>
            <input type="number" id="valor_descuento" name="valor_descuento" required><br><br>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>

            <input type="submit" value="Aplicar Descuento">
        </form>
    </div>
</body>
</html>
