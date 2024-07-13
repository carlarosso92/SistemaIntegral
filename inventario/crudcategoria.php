<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menuempleado.css">
    <title>Crear categorias y subcategorias</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
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
            margin: auto;
            margin-top: 8em;
            color: #72A603;
            background-color: #E4F2B5;
            max-width: 400px;
            border-radius: 10px;
            border: 1px solid #72A603;
        }
        h2:hover{
            background-color: #D3E1A4;
            color: #61A502;
        }

        form {
            max-width: 500px;
            margin: auto;
            margin-top: 10px;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form input[type="submit"] {
            background-color: #72A603;
            color: yellow;
            cursor: pointer;
        }

        form input[type="submit"]:hover{
            background-color: blue;
            color: white;
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
    <script>
        function addSubcategoryField() {
            const subcategoriesDiv = document.getElementById('subcategories');
            const newField = document.createElement('input');
            newField.type = 'text';
            newField.name = 'subcategories[]';
            newField.placeholder = 'Subcategory';
            subcategoriesDiv.appendChild(newField);
            subcategoriesDiv.appendChild(document.createElement('br'));
        }
    </script>
</head>
<body>
    <?php include "header.php"; ?>

    <h2>Crear categoría nueva y subcategorías de la misma</h2>
    
    <form action="process_category.php" method="POST">
        <label for="category">Categoría:</label>
        <input type="text" id="category" name="category" required>
        <br><br>
        <div id="subcategories">
            <label>Subcategorías:</label>
            <br>
            <input type="text" name="subcategories[]" placeholder="Subcategorías" required>
            <br>
        </div>
        <button type="button" onclick="addSubcategoryField()">Agregar subcategoría</button>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>