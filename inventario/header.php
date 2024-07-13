<!DOCTYPE html>
<html>
<head>
  <title>Don Perico</title>
  <link rel="icon" href="../img/logo2.png" type="image/png">
  <style>
    /* Estilos generales */
    body {
      font-family: sans-serif;
      margin: 0;
      background-color: #F2EDD0;
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
    
    img {
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

    .user-options {
      display: flex;
      align-items: center;
    }

    .user-options a {
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

    .user-options a:hover {
      background-color: #72A603;
      color: #EAF207;
    }

    .user-options .separator {
      border-left: 1px solid yellow;
      height: 20px;
      margin: 0 10px;
    }
  </style>
</head>
<body>
  <div class="main-container">
    <header>
      <div class="container">
        <img src="../img/logo.png" alt="Don Perico Logo">
        <h1>Don Perico</h1>

        <div class="user-options">
          <a href="../gestionempleado.php">Gestiones</a>
          <div class="separator"></div>
          <a href="../logout.php">Cerrar sesión</a>
        </div>
      </div>
    </header>
  </div>
</body>
</html>
