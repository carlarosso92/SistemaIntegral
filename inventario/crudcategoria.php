<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear categorías y subcategorías</title>
    <link rel="icon" href="img/logo2.png" type="image/png">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #F2EDD0;
        }

        form {
            max-width: 500px;
            margin: auto;
            margin-top: 8em;
            padding: 20px;
            border: 1px solid #72A603;
            border-radius: 10px;
            background-color: #E4F2B5;
        }

        h2 {
            padding: 10px;
            font-style: normal;
            text-align: center;
            margin: 0;
            color: #72A603;
            background-color: #E4F2B5;
            border-radius: 10px;
        }

        h2:hover {
            background-color: #D3E1A4;
            color: #61A502;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="number"],
        form input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }

        form input[type="submit"] {
            background-color: #72A603;
            color: white;
            cursor: pointer;
            margin-bottom: 20px;
        }

        form input[type="submit"]:hover {
            background-color: #EAF207;
            color: #72A603;
        }

        form button {
            margin-top: 1.5em;
            background-color: #72A603;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #EAF207;
            color: #72A603;
        }

        #category {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #72A603;
            border-radius: 20px;
        }
    </style>
    <script>
        function addSubcategoryField() {
            const subcategoriesDiv = document.getElementById('subcategories');
            const newField = document.createElement('input');
            newField.type = 'text';
            newField.name = 'subcategories[]';
            newField.placeholder = 'Subcategoría';
            newField.style.width = "calc(100% - 22px)";
            newField.style.padding = "10px";
            newField.style.marginTop = "8px";
            newField.style.marginBottom = "20px";
            newField.style.border = "1px solid #72A603";
            newField.style.borderRadius = "20px";
            subcategoriesDiv.appendChild(newField);
            subcategoriesDiv.appendChild(document.createElement('br'));
        }
    </script>
</head>
<body>
    <form action="process_category.php" method="POST">
        <table>
            <tr>
                <td colspan="2">
                    <h2>Crear categoría nueva y subcategorías de la misma</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2"><label for="category">Categoría:</label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" id="category" name="category" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="subcategories">
                        <label>Subcategorías:</label>
                        <br>
                        <input type="text" name="subcategories[]" placeholder="Subcategoría" required>
                        <br>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="button" onclick="addSubcategoryField()" style="float: left;">Agregar subcategoría</button>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding-top: 20px;">
                    <input type="submit" value="Agregar">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
