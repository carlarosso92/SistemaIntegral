<?php
// Conectar a la base de datos
$server="localhost";
$usuario = "root";
$contraseña="";
$db="sistemaintegralperico";

$conn = mysqli_connect($server,$usuario,$contraseña,$db)or die("Error en la conexion");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the category from POST data
    $category = $conn->real_escape_string($_POST['category']);
    // Get the subcategories from POST data
    $subcategories = $_POST['subcategories'];

    // Insert the category into the database
    $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$category')";
    if ($conn->query($sql) === TRUE) {
        $category_id = $conn->insert_id; // Get the last inserted ID

        // Insert each subcategory into the database
        foreach ($subcategories as $subcategory) {
            $subcategory = $conn->real_escape_string($subcategory);
            $sql = "INSERT INTO subcategorias (id_categoria, nombre_subcategoria) VALUES ('$category_id', '$subcategory')";
            $conn->query($sql);
        }
        
        echo "Categoría y subcategorías agregadas correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
