-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2024 a las 15:29:40
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaintegralperico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario_id`, `empleado_id`) VALUES
(1, 1, 1),
(2, 12, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre_categoria`) VALUES
(10, 'Artículos de Aseo Personal'),
(3, 'Bebidas Alcohólicas'),
(4, 'Bebidas no Alcohólicas'),
(2, 'Carnes'),
(7, 'Congelados'),
(9, 'Frutas y Verduras'),
(1, 'Lácteos'),
(13, 'No perecibles'),
(8, 'Panadería'),
(6, 'Productos de Limpieza'),
(5, 'Snacks');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario_id`, `direccion`, `telefono`) VALUES
(1, 8, 'Cardenal samore 2171', '949145227');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `tipo_descuento` enum('categoria','producto','marca','dia') NOT NULL,
  `valor_descuento` decimal(5,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `producto_id`, `tipo_descuento`, `valor_descuento`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 2, 'producto', 15.00, '2024-07-11', '2024-07-12'),
(3, 5, 'dia', 20.00, '2024-07-12', '2024-07-13'),
(6, 21, 'producto', 15.00, '2024-07-13', '2024-08-03'),
(7, 15, 'producto', 20.00, '2024-07-13', '2024-07-24'),
(8, 10, 'marca', 5.00, '2024-07-15', '2024-07-24'),
(11, 2, 'categoria', 20.00, '2024-07-15', '2024-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reservas`
--

CREATE TABLE `detalle_reservas` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_reservas`
--

INSERT INTO `detalle_reservas` (`id`, `reserva_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(2, 10, 2, 6, 1200),
(4, 11, 2, 1, 1200),
(6, 12, 2, 5, 1200),
(7, 13, 2, 4, 1200),
(9, 14, 2, 4, 1200),
(10, 15, 2, 4, 1200),
(11, 17, 2, 10, 1200),
(12, 19, 2, 1, 1200),
(13, 20, 2, 4, 1200),
(16, 21, 2, 2, 1200),
(17, 22, 2, 8, 1200),
(20, 23, 2, 5, 1200),
(21, 24, 2, 3, 1200),
(22, 25, 2, 1, 1200),
(24, 29, 2, 6, 1200),
(26, 30, 2, 1, 1200),
(28, 31, 5, 1, 5000),
(29, 31, 21, 2, 4500),
(30, 31, 10, 1, 5000),
(31, 31, 15, 1, 1200),
(32, 32, 5, 1, 5000),
(33, 32, 10, 1, 5000),
(34, 32, 21, 1, 4500),
(35, 33, 10, 6, 5000),
(36, 33, 21, 1, 4500),
(37, 33, 15, 4, 1200),
(38, 34, 2, 1, 1200),
(39, 34, 5, 3, 5000),
(40, 34, 10, 4, 5000),
(41, 34, 21, 3, 4500),
(42, 34, 15, 2, 1200),
(43, 34, 9, 2, 10000),
(44, 34, 7, 1, 3500),
(45, 34, 8, 1, 2500),
(46, 35, 10, 1, 5000),
(47, 35, 13, 1, 1800),
(48, 35, 7, 1, 3500),
(49, 37, 21, 3, 4500),
(50, 37, 15, 2, 1200),
(51, 37, 2, 1, 1200),
(52, 37, 10, 1, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(4, 4, 2, 2, 1200),
(6, 5, 2, 4, 1200),
(7, 6, 2, 4, 1020),
(8, 7, 2, 1, 1020),
(9, 7, 5, 2, 4000),
(10, 8, 2, 1, 1020),
(11, 8, 5, 2, 4000),
(12, 9, 2, 1, 1200),
(13, 10, 2, 2, 1020),
(14, 10, 5, 4, 4000),
(15, 11, 2, 6, 1200),
(16, 12, 5, 1, 5000),
(17, 12, 21, 2, 4500),
(18, 12, 10, 1, 5000),
(19, 12, 15, 1, 1200),
(20, 13, 2, 1, 1020),
(21, 13, 5, 1, 4000),
(22, 13, 10, 1, 4500),
(23, 14, 2, 4, 1200),
(27, 15, 15, 1, 960),
(28, 15, 16, 1, 1500),
(30, 15, 5, 1, 4000),
(31, 15, 9, 1, 10000),
(32, 15, 10, 2, 4500),
(33, 15, 11, 1, 7000),
(34, 15, 21, 1, 3825),
(35, 15, 2, 2, 1020),
(36, 15, 7, 1, 3500),
(37, 15, 8, 1, 2500),
(38, 15, 22, 1, 1800),
(39, 15, 20, 1, 3500),
(40, 15, 18, 1, 2500),
(41, 15, 19, 1, 1800),
(46, 17, 13, 1, 1800),
(48, 18, 19, 1, 1800),
(49, 18, 18, 2, 2500),
(50, 18, 20, 2, 3500),
(51, 19, 19, 1, 1800),
(52, 19, 18, 1, 2500),
(53, 19, 20, 1, 3500),
(54, 20, 2, 1, 1200),
(55, 20, 5, 3, 5000),
(56, 20, 10, 4, 5000),
(57, 20, 21, 3, 4500),
(58, 20, 15, 2, 1200),
(59, 20, 9, 2, 10000),
(60, 20, 7, 1, 3500),
(61, 20, 8, 1, 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `monto_devuelto` decimal(10,2) DEFAULT NULL,
  `fecha_devolucion` datetime DEFAULT current_timestamp(),
  `motivo` varchar(255) DEFAULT NULL,
  `tipo_devolucion` enum('devolucion','cambio') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id`, `id_venta`, `id_producto`, `cantidad`, `monto_devuelto`, `fecha_devolucion`, `motivo`, `tipo_devolucion`) VALUES
(1, 15, 15, 2, 1500.00, '2024-07-18 01:42:04', 'estaba vencida', 'devolucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `sueldo` int(11) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `usuario_id`, `cargo`, `sueldo`, `telefono`) VALUES
(1, 1, 'Administrador', 2000000, '+56 949272162'),
(2, 2, 'Cajero', 450000, '+56 949272162'),
(5, 12, 'Administrador', 250000, '949145227');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_proveedores`
--

CREATE TABLE `facturas_proveedores` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `flagpagado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas_proveedores`
--

INSERT INTO `facturas_proveedores` (`id`, `proveedor_id`, `numero_factura`, `fecha_pago`, `descripcion`, `monto`, `flagpagado`) VALUES
(1, 3, 0, '2024-08-01', '545', NULL, 1),
(2, 5, 0, '2024-07-25', 'Pagar si o si', 454555, 1),
(3, 1, 0, '2024-07-28', 'Pagar si o si', 2000000, 1),
(4, 3, 0, '2024-08-17', 'Se  paga completo', 20000, 1),
(6, 2, 7777, '2024-08-17', 'Pagar si o si', 250000, 1),
(7, 14, 8888, '2024-07-17', 'todo correcto', 200000, 0),
(8, 4, 12345678, '2024-07-17', '', 0, 0),
(9, 4, 98765, '2024-07-17', '', 0, 0),
(10, 5, 345234, '2024-07-17', '', 0, 0),
(11, 7, 45654635, '2024-07-17', '', 0, 0),
(12, 4, 9866, '2024-07-17', '', 0, 0),
(13, 4, 9876543, '2024-07-17', '', 0, 0),
(14, 4, 9876543, '2024-07-17', '', 0, 0),
(15, 4, 234245546, '2024-07-17', '', 0, 0),
(16, 4, 234245546, '2024-07-17', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `precio` float NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `codigo_barras` varchar(11) NOT NULL,
  `factura_proveedor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `id_categoria`, `id_subcategoria`, `id_proveedor`, `precio`, `cantidad_stock`, `fecha_vencimiento`, `codigo_barras`, `factura_proveedor`) VALUES
(2, 'Leche entera 1lt Soprole', 'Leche entera de 1 litro', 1, 1, 1, 1200, 139, '2024-07-28', '2147483647', NULL),
(5, 'Carne mechada ', 'Carne mechada empaquetada', 2, 4, 6, 5000, 5, '2024-07-28', '00200400638', NULL),
(7, 'Queso gouda', 'Queso gouda de 500g', 1, 2, 2, 3500, 48, '2024-07-31', '00100200266', NULL),
(8, 'Yogurt natural', 'yogurt natural pack de 4 unidades', 1, 3, 3, 2500, 18, '2024-07-31', '00100300327', NULL),
(9, 'Vacuno filete', 'Filete de vacuno premium', 2, 4, 5, 10000, 7, '2024-07-31', '00200400580', NULL),
(10, 'Pollo entero', 'pollo entero gresco de granja', 2, 5, 5, 5000, -1, '2024-07-31', '00200500569', NULL),
(11, 'Cerdo costillas', 'Costillas de cerdo marinadas', 2, 6, 6, 7000, 11, '2024-07-25', '00200600620', NULL),
(13, 'Cerveza rubia', 'cerveza rubia artesanal de 500ml', 3, 8, 23, 1800, 39, '2024-07-30', '00300800239', NULL),
(15, 'Coca cola', 'coca cola zero', 4, 10, 13, 1200, 42, '2024-07-17', '00400100013', NULL),
(16, 'Jugo natural', 'jugo natural de manzana', 4, 11, 16, 1500, 29, '2024-07-23', '00400110016', NULL),
(18, 'papas fritas', 'papas fritas bolsa familiar', 5, 13, 9, 2500, 21, '2024-07-26', '00500130096', NULL),
(19, 'galletas de chocolate', 'galletas de chocolate en pack de 6 un', 5, 13, 3, 1800, 22, '2024-08-03', '00500130034', NULL),
(20, 'Detergente liquido', 'Detergente líquido para ropa de 1 litro.', 6, 16, 25, 3500, 16, '2024-08-01', '00600160025', NULL),
(21, 'pizza congelada', 'pizza de pepperoni congelada', 7, 21, 4, 4500, 1, '2024-07-26', '00700210046', NULL),
(22, 'Tortilla de harina', 'Tortillas de harina de trigo (10 unidades).', 8, 22, 22, 1800, 29, '2024-07-23', '00800220022', NULL),
(25, 'Agua mineral', 'Agua mineral sin gas en botella de 1.5 lt', 4, 12, 18, 700, 100, '2024-07-20', '00400120018', '00056'),
(26, 'Vino tinto', 'Vino en caja 1lt', 3, 7, 7, 800, 200, '2024-08-04', '00300700790', '12345'),
(27, 'Yogurt  griego', ' 240 gramos con trozos de durazno', 1, 3, 1, 1500, 100, '2024-07-28', '00100300186', '012345'),
(28, 'Filete de Cerdo', ' 1 kilo empaquetado', 2, 6, 6, 3500, 100, '2024-07-31', '00200600631', '4555'),
(29, 'Chuleta centro', ' 1 kilo empaquetado', 2, 6, 6, 3000, 100, '2024-07-28', '00200600668', '4555'),
(30, 'Chocolate Bitter Nestle', 'barra de 100 gramos', 5, 15, 3, 1000, 20, '2024-08-04', '00500150031', '6666'),
(31, 'Mckay Coco', 'galletitas de coco 100 gramos', 5, 14, 3, 1200, 20, '2024-08-04', '00500140032', '6666'),
(32, 'Fideo tallarín', 'paquete de 400 gramos ', 8, 22, 4, 1000, 50, '2024-07-20', '00800220043', '7777'),
(33, 'Tortillas para tacos', 'Pack fiesta 25 unidades ', 8, 24, 4, 2500, 50, '2024-07-31', '00800240042', '7777'),
(34, 'Leche sin lactosa', 'Leche en carton 1litro', 1, 1, 2, 1100, 100, '2024-08-11', '00100100228', '6'),
(35, 'Queso ranco colun', 'Queso laminado 250 gramos', 1, 2, 2, 3500, 100, '2024-08-11', '00100200261', '6'),
(36, 'Pepsi 0', 'botella de medio litro', 4, 10, 14, 1500, 100, '2024-08-10', '00400100014', '7'),
(37, 'Tropicana de frutilla', 'jugo en botella de medio litro', 4, 11, 14, 1000, 50, '2024-08-11', '00400110014', '7'),
(45, 'Arroz tucapel', 'Arroz de 1kg', 13, 36, 4, 2000, 21, '2024-08-10', '00130036004', '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `contacto_proveedor` varchar(255) DEFAULT NULL,
  `telefono_proveedor` varchar(255) DEFAULT NULL,
  `email_proveedor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre_proveedor`, `contacto_proveedor`, `telefono_proveedor`, `email_proveedor`) VALUES
(1, 'Soprole', 'Juan Pérez', '123456789', 'soprole@gmail.com'),
(2, 'Colún', 'Ana Gómez', '987654321', 'colun@gmail.com'),
(3, 'Nestlé', 'Carlos López', '456789123', 'nestle@gmail.com'),
(4, 'Carozzi', 'María Rodríguez', '789123456', 'carozzi@gmail.com'),
(5, 'Santa Isabel', 'Pedro Sánchez', '321654987', 'santaisabel@gmail.com'),
(6, 'Super Cerdo', 'Laura Fernández', '654987321', 'supercerdo@gmail.com'),
(7, 'Agrosuper', 'Diego González', '987321654', 'agrosuper@gmail.com'),
(8, 'Aconcagua Foods', 'Isabel Martínez', '654321987', 'aconcaguafoods@gmail.com'),
(9, 'Empresas Carozzi', 'Javier Torres', '321987654', 'empresascarozzi@gmail.com'),
(10, 'Viña Concha y Toro', 'Sofía Ramírez', '789654321', 'conchaytoro@gmail.com'),
(11, 'Compañía Cervecerías Unidas (CCU)', 'Pablo Hernández', '456123789', 'ccu@gmail.com'),
(12, 'Pisco Capel', 'Valentina Díaz', '987789456', 'capel@gmail.com'),
(13, 'Coca-Cola', 'Andrés Vargas', '321456789', 'cocacola@gmail.com'),
(14, 'Pepsi', 'Camila Flores', '654789321', 'pepsi@gmail.com'),
(15, 'Schweppes', 'Matías Muñoz', '123987456', 'schweppes@gmail.com'),
(16, 'Watt\'s', 'Francisca Morales', '789456123', 'watts@gmail.com'),
(17, 'Lay\'s', 'Gabriel Gutiérrez', '456123987', 'lays@gmail.com'),
(18, 'Unilever', 'Javiera Castro', '987456321', 'unilever@gmail.com'),
(19, 'Procter & Gamble', 'Vicente Rojas', '321789456', 'pg@gmail.com'),
(20, 'Kimberly-Clark', 'Antonia Herrera', '654321789', 'kimberlyclark@gmail.com'),
(21, 'SC Johnson', 'Maximiliano Valenzuela', '123789654', 'scjohnson@gmail.com'),
(22, 'Iansa', 'Constanza Fuentes', '789654123', 'iansa@gmail.com'),
(23, 'Cristal', 'Tomás Fernández', '456987789', 'cristal@gmail.com'),
(24, 'Cachantún', 'Emilia Pérez', '987123456', 'cachantun@gmail.com'),
(25, 'Biosalud', 'Nicolás González', '321654789', 'biosalud@gmail.com'),
(26, 'Ostermann', 'Josefina López', '654789123', 'ostermann@gmail.com'),
(27, 'Pescanova', 'Ignacio Rodríguez', '123456987', 'pescanova@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `hora_reserva` datetime DEFAULT NULL,
  `hora_retiro` datetime DEFAULT NULL,
  `total` float NOT NULL,
  `flg_activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `hora_reserva`, `hora_retiro`, `total`, `flg_activo`) VALUES
(10, 8, '2024-07-10 23:22:01', '0000-00-00 00:00:00', 38700, 0),
(11, 8, '2024-07-11 00:02:03', '0000-00-00 00:00:00', 5700, 0),
(12, 8, '2024-07-11 00:07:17', '0000-00-00 00:00:00', 15000, 0),
(13, 8, '2024-07-11 02:55:03', '0000-00-00 00:00:00', 18300, 0),
(14, 8, '2024-07-11 17:02:42', '0000-00-00 00:00:00', 4800, 0),
(15, 8, '2024-07-12 01:47:03', '0000-00-00 00:00:00', 4800, 0),
(17, 8, '2024-07-12 02:55:43', '0000-00-00 00:00:00', 12000, 0),
(19, 8, '2024-07-12 02:58:57', '0000-00-00 00:00:00', 1200, 0),
(20, 8, '2024-07-12 22:55:00', '2024-07-12 11:00:00', 7200, 0),
(21, 8, '2024-07-12 23:02:52', '2024-07-12 13:00:00', 4800, 0),
(22, 8, '2024-07-12 23:05:15', '2024-07-12 16:00:00', 10800, 0),
(23, 8, '2024-07-12 23:20:33', '2024-07-12 16:00:00', 10800, 0),
(24, 8, '2024-07-12 23:29:03', '2024-07-12 19:00:00', 3060, 0),
(25, 8, '2024-07-12 23:29:21', '2024-07-12 10:00:00', 2220, 1),
(29, 8, '2024-07-12 23:54:52', '2024-07-12 10:00:00', 19320, 1),
(30, 8, '2024-07-13 03:07:07', '2024-07-13 20:00:00', 2220, 1),
(31, 8, '2024-07-13 17:05:06', '2024-07-13 11:00:00', 17110, 0),
(32, 8, '2024-07-13 18:33:07', '2024-07-13 16:00:00', 12325, 1),
(33, 8, '2024-07-15 22:00:04', '2024-07-15 20:00:00', 34665, 1),
(34, 8, '2024-07-16 21:43:26', '2024-07-16 18:00:00', 73355, 0),
(35, 8, '2024-07-17 04:06:58', '2024-07-17 18:00:00', 9800, 0),
(37, 8, '2024-07-18 04:22:37', '2024-07-18 14:00:00', 19105, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_subcategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `nombre_subcategoria`) VALUES
(1, 1, 'Leche'),
(2, 1, 'Queso'),
(3, 1, 'Yogurt'),
(4, 2, 'Vacuno'),
(5, 2, 'Pollo'),
(6, 2, 'Cerdo'),
(7, 3, 'Vino'),
(8, 3, 'Cerveza'),
(9, 3, 'Pisco'),
(10, 4, 'Bebidas Gaseosas'),
(11, 4, 'Jugos'),
(12, 4, 'Agua'),
(13, 5, 'Papas Fritas'),
(14, 5, 'Galletas'),
(15, 5, 'Chocolate'),
(16, 6, 'Detergentes'),
(17, 6, 'Desinfectantes'),
(18, 6, 'Limpiadores'),
(19, 7, 'Helados'),
(20, 7, 'Pescados Congelados'),
(21, 7, 'Productos Congelados'),
(22, 8, 'Pan'),
(23, 8, 'Facturas'),
(24, 8, 'Tortillas'),
(25, 9, 'Frutas Frescas'),
(26, 9, 'Verduras Frescas'),
(27, 9, 'Ensaladas'),
(28, 10, 'Jabones'),
(29, 10, 'Shampoo'),
(30, 10, 'Cremas'),
(36, 13, 'arroz'),
(37, 13, 'fideos'),
(38, 13, 'legumbres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rut` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `email`, `contrasena`, `rut`) VALUES
(1, 'Juan Perico los Palotes', 'juanperico@gmail.com', '1111', '7.585.294-7'),
(2, 'Patricio Rojas', 'patricio@gmail.com', '2222', '25.555.581-2'),
(8, 'Pablo', 'p.maldonado.alborta@gmail.com', '6666', '18.033.470-k'),
(12, 'Nia Arrua', '', '77777', '25.555.581-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha_venta` date NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cliente_id`, `fecha_venta`, `total`) VALUES
(1, NULL, '2024-07-07', 3600),
(2, NULL, '2024-07-07', 6000),
(3, NULL, '2024-07-07', 110400),
(4, NULL, '2024-07-08', 15900),
(5, NULL, '2024-07-10', 4800),
(6, NULL, '2024-07-12', 4080),
(7, NULL, '2024-07-13', 9020),
(8, NULL, '2024-07-13', 9020),
(9, NULL, '2024-07-13', 5700),
(10, NULL, '2024-07-13', 18040),
(11, NULL, '2024-07-13', 38700),
(12, NULL, '2024-07-13', 17110),
(13, NULL, '2024-07-13', 9520),
(14, NULL, '2024-07-13', 18300),
(15, NULL, '2024-07-16', 71000),
(16, NULL, '2024-07-16', 7625),
(17, NULL, '2024-07-16', 26425),
(18, NULL, '2024-07-16', 13800),
(19, NULL, '2024-07-16', 7800),
(20, NULL, '2024-07-16', 73355);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `detalle_reservas`
--
ALTER TABLE `detalle_reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserva_id` (`reserva_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `facturas_proveedores`
--
ALTER TABLE `facturas_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_subcategoria` (`id_subcategoria`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `fk_factura_proveedor` (`factura_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_reservas`
--
ALTER TABLE `detalle_reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas_proveedores`
--
ALTER TABLE `facturas_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `administradores_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD CONSTRAINT `descuentos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_reservas`
--
ALTER TABLE `detalle_reservas`
  ADD CONSTRAINT `detalle_reservas_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_reservas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `facturas_proveedores`
--
ALTER TABLE `facturas_proveedores`
  ADD CONSTRAINT `facturas_proveedores_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `clientes` (`usuario_id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
