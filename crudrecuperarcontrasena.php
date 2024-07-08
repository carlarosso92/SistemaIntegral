<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Recuperar Contraseña</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <style>
        form {
    max-width: 500px;
    margin: 300px auto;
    padding: 20px;
    border: 1px solid #72A603;
    border-radius: 10px;
    background-color: #E4F2B5;
    text-align: center;
    }   

    form label {
        display: block;
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    form input[type="email"] {
        padding: 10px;
        border: 1px solid #72A603;
        border-radius: 20px;
        width: calc(100% - 24px);
        margin-bottom: 20px;
    }

    form input[type="submit"] {
        background-color: #72A603;
        color: yellow;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #EAF207;
        color: #72A603;
    }
    </style>
</head>
<body>
    
    <form method="POST" action="recuperarcontrasena.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" value="Recuperar Contraseña">
    </form>
</body>
</html>