<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="icon" href="../img/logo2.png" type="image/png">
    <title>Formulario de Contacto</title>
</head>
<body>
    <!-- Formulario de contacto -->
    <div class="formulario-contacto">
        <h2>Formulario de Contacto</h2>
        <form id="contact-form" action="procesar_contacto.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Enlace al JavaScript -->
    <script>
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario

            const formData = new FormData(this);
            fetch('procesar_contacto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar el mensaje en una ventana emergente
                window.location.href = 'index.php'; // Redirigir al index
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
