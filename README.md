Sistema Integral

Este proyecto es un sistema integral para la gestión de un minimarket que vende productos lácteos, carnes, bebidas alcohólicas y productos de limpieza.

Contenido del Repositorio

 Estructura del Proyecto

- **css/**: Contiene los archivos CSS para el diseño y estilo de la aplicación.
- **html/**: Contiene archivos HTML estáticos.
- **img/**: Contiene imágenes utilizadas en la aplicación.
- **inventario/**: Contiene archivos relacionados con la gestión de inventario.
  - **config/**: Configuración específica del inventario.
  - **css/**: Archivos CSS específicos para las páginas de inventario.
- **js/**: Contiene archivos JavaScript para la funcionalidad dinámica.
- **php/**: Contiene todos los archivos PHP necesarios para el backend del sistema.
- **Proveedores/**: Contiene archivos relacionados con la gestión de proveedores.
  - **config/**: Configuración específica de los proveedores.
- **scriptsql/**: Contiene scripts SQL para la creación y manipulación de la base de datos.
- **vendor/**: Contiene bibliotecas de terceros y dependencias del proyecto.
  - **composer/**: Archivos relacionados con Composer.
  - **picqer/php-barcode-generator/**: Biblioteca para la generación de códigos de barras.

Funcionalidades Principales

- **Gestión de Usuarios**: Sistema de inicio de sesión y gestión de usuarios.
- **Gestión de Productos**: Interfaz para agregar, editar y eliminar productos.
- **Gestión de Categorías y Proveedores**: Interfaz para la gestión de categorías de productos y proveedores.
- **Carrito de Compras**: Funcionalidad para agregar productos al carrito y realizar compras.
- **AJAX**: Uso de AJAX para la carga dinámica de subcategorías y proveedores.

Configuración

1. Clona el repositorio en tu máquina local.
   bash
   git clone https://github.com/carlarosso92/SistemaIntegral.git
   
2.Configura el archivo de conexión a la base de datos.

Edita php/config.php con los datos de tu servidor MySQL.

3.Importa la base de datos.

Utiliza el archivo scriptsql/database.sql para crear las tablas necesarias en tu base de datos MySQL.

4.Inicia el servidor local con XAMPP o cualquier otro servidor web compatible con PHP y MySQL.

Uso
Accede a la página principal en http://localhost/SistemaIntegral/index.php.
Inicia sesión con las credenciales de un usuario registrado.
Gestiona productos, categorías y proveedores a través de la interfaz del sistema.
Contacto
Para cualquier duda o problema, puedes contactar al desarrollador en...
