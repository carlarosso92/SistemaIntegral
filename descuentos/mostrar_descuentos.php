<?php
include "config/conexion.php";

// Obtener los productos y sus descuentos si existen
$sql = "SELECT p.nombre, p.precio, d.valor_descuento, 
        CASE 
            WHEN d.valor_descuento IS NOT NULL THEN p.precio * (1 - d.valor_descuento / 100)
            ELSE p.precio
        END AS precio_con_descuento
        FROM productos p
        LEFT JOIN descuentos d ON p.id_producto = d.producto_id 
        AND CURDATE() BETWEEN d.fecha_inicio AND d.fecha_fin";

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos con Descuento - Don Perico</title>
    <style>
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
        <h2>Productos con Descuento</h2>
        <div class="products-section">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<h3>" . $row['nombre'] . "</h3>";
                    echo "<p>Precio Original: " . $row['precio'] . "€</p>";
                    if ($row['valor_descuento'] != NULL) {
                        echo "<p>Descuento: " . $row['valor_descuento'] . "%</p>";
                        echo "<p>Precio con Descuento: " . $row['precio_con_descuento'] . "€</p>";
                    } else {
                        echo "<p>Precio: " . $row['precio'] . "€</p>";
                    }
                    echo "</div>";
                }
            } else {
                echo "No hay productos disponibles.";
            }
            mysqli_close($conexion);
            ?>
        </div>
    </div>
</body>
</html>


