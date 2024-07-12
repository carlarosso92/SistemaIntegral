<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de categorías</title>
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <link rel="stylesheet" href="css/agregarcategoria.css" />
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
        }
        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 2em 26em auto;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 500px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover{
            background-color: #D3E1A4;
            color: #61A502;
        }

        form {
            max-width: 500px;
            margin: 2em auto;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 4px;
            margin-bottom: 4px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form button {
            margin-top: 1.5em;
            background-color: #72A603;
            color: yellow;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #EAF207;
            color: #72A603;
        }
    </style>
</head>
<body>
        <h2>Nueva categoría</h2>
        <form id="formulariocategoria" action="ingresarcategoria.php" method="POST">
            Nombre categoria: <input type="text" id="nombrecategoria" name="nombrecategoria" required><br>
            <button type="button" id="botonagregarsub">Agregar categoría</button><br>
            <button type="submit">Ingresar</button>
        </form>

</body>
</html>
