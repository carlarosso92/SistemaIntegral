<!DOCTYPE html>
<html>
<head>
    <title>Crear categorías y subcategorías</title>
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
    <h1>Crear categoría nueva y subcategorías de la misma</h1>
    
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