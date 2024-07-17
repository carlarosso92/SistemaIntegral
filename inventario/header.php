<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Don Perico</title>
  <link rel="icon" href="../img/logo2.png" type="image/png">
  <style>
    /* Estilos generales */
    .body-dp {
      font-family: sans-serif;
      margin: 0;
      background-color: #F2EDD0;
    }

    /* Encabezado */
    .header-dp {
      background-color: #72A603;
      color: yellow;
      padding: 15px 0;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
    }
    
    .header-dp img {
      width: 10%;
    }

    /* Header Container */
    .container-dp {
      max-width: 1200px;
      margin: 0 auto; /* Centers the container horizontally */
      padding: 0 15px;
      display: flex;
      align-items: center;
      justify-content: space-between; /* Distributes items evenly */
      width: 100%; /* Ensures the container takes full width */
    }

    .container-dp h1 {
      margin: 0;
      font-size: 2em;
      font-family: sans-serif;
    }

    .user-options-dp {
      display: flex;
      align-items: center;
    }

    .user-options-dp a {
      background-color: #EAF207;
      color: green;
      padding: 10px 20px;
      border: 1px solid black;
      border-radius: 20px;
      cursor: pointer;
      font-size: 16px;
      display: inline-block;
      text-decoration: none;
      margin-left: 15px;
    }

    .user-options-dp a:hover {
      background-color: #72A603;
      color: #EAF207;
    }

    .separator-dp {
      border-left: 1px solid yellow;
      height: 20px;
      margin: 0 10px;
    }

    .home-button-dp {
      display: inline-block;
      margin-left: 20px; /* Aumenta el margen para alejar el botón de la casa */
      font-size: 24px;
      color: #72A603;
    }

    .home-button-dp:hover {
      color: #007bff;
    }
  </style>
</head>
<body class="body-dp">
  <div class="main-container-dp">
    <header class="header-dp">
      <div class="container-dp">
        <img src="../img/logo.png" alt="Don Perico Logo">
        <h1>Don Perico</h1>
        <div class="user-options-dp">
          <a href="#" onclick="redirectUser()">Gestiones</a>
          <div class="separator-dp"></div>
          <a href="../logout.php">Cerrar sesión</a>
          <a href="index.php" class="home-button-dp">
            <i class="fas fa-home"></i>
          </a>
        </div>
      </div>
    </header>
  </div>
  
  <script>
    // Obteniendo el valor de la variable de sesión desde PHP
    var usuarioCargo = '<?php echo $_SESSION['usuario_cargo']; ?>';
    
    function redirectUser() {
      if (usuarioCargo === 'Administrador') {
        window.location.href = '../gestionadministrador.php';
      } else {
        window.location.href = '../gestionempleado.php';
      }
    }
  </script>
</body>
</html>
