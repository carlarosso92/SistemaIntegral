<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Aquí puedes agregar la lógica para procesar el formulario,
    // como enviar un email o guardar los datos en una base de datos.

    echo "Gracias por tu mensaje, $nombre. Nos pondremos en contacto contigo pronto.";
}
?>
