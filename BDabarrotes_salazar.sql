-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2025 a las 23:30:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `contrasena`) VALUES
(1, '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactanos`
--

CREATE TABLE `contactanos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `motivo` enum('realizar un pedido','soy proveedor','solicitar información') NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactanos`
--

INSERT INTO `contactanos` (`id`, `nombre`, `apellidos`, `correo`, `telefono`, `motivo`, `mensaje`, `fecha`) VALUES
(1, 'ANDREA', 'SANCHEZ PEREZ', 'andrea_sanchez_perez_26@outlook.com', 2147483647, 'soy proveedor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-17 13:23:07'),
(2, 'ANDREA', 'SANCHEZ PEREZ', 'andrea_sanchez_perez_26@outlook.com', 2147483647, 'realizar un pedido', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-17 13:23:38'),
(3, 'ANDREA', 'SANCHEZ PEREZ', 'andrea_sanchez_perez_26@outlook.com', 2147483647, 'solicitar información', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-17 13:23:55'),
(4, 'ANDREA', 'SANCHEZ PEREZ', 'andrea_sanchez_perez_26@outlook.com', 2147483647, 'solicitar información', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-17 13:25:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `imagen` text DEFAULT NULL,
  `alterno` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('disponible','agotado') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `proveedor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `imagen`, `alterno`, `descripcion`, `estado`, `precio`, `categoria`, `cantidad`, `proveedor`) VALUES
(1, 'Manzanas Verde', 'img/productos/manzana.jpg', 'Frutas frescas', 'Manzanas rojas frescas de granja', 'disponible', 25.00, 'fresco', 80, 'rancho salazar'),
(2, 'Atún enlatado', 'img/productos/atun.jpg', 'Atún en aceite', 'Lata de atún en aceite de oliva', 'disponible', 35.00, 'enlatado', 90, 'dolores'),
(3, 'Jugo de Naranja', 'img/productos/jugo.jpg', 'Bebida de naranja', 'Jugo natural sin conservantes', 'disponible', 20.00, 'bebidas', 90, 'coca'),
(4, 'Papas Fritas', 'img/productos/sabritas.jpg', 'Snack crujiente', 'Bolsa de papas fritas con sal', 'disponible', 15.00, 'snacks', 67, 'sabritas'),
(5, 'Detergente Líquido', 'img/productos/detergente.jpg', 'Limpieza profunda', 'Detergente líquido para ropa', 'disponible', 80.00, 'limpieza', 100, 'ace'),
(6, 'Pan Integral', 'img/productos/produ_alter.jpg', 'Pan saludable', 'Pan integral de trigo 100%', 'disponible', 40.00, 'fresco', 100, 'bimbo'),
(9, 'Yogurt Natural', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt natural sin azúcar', 'disponible', 30.00, 'fresco', 100, 'lala'),
(10, 'Cereal de Maíz', 'img/productos/produ_alter.jpg', 'Desayuno nutritivo', 'Cereal de maíz fortificado', 'disponible', 55.00, 'fresco', 100, 'kelloggs'),
(11, 'Chiles Jalapeños', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles jalapeños en escabeche', 'disponible', 35.00, 'enlatado', 100, 'la costeña'),
(12, 'Salsa de Tomate', 'img/productos/produ_alter.jpg', 'Base para cocina', 'Salsa de tomate natural enlatada', 'disponible', 28.00, 'enlatado', 100, 'grupo corona'),
(13, 'Maíz enlatado', 'img/productos/produ_alter.jpg', 'Vegetales', 'Granos de maíz en almíbar', 'disponible', 22.00, 'enlatado', 100, 'tiarosa'),
(14, 'Frijoles Refritos', 'img/productos/produ_alter.jpg', 'Acompañamiento', 'Frijoles refritos enlatados', 'disponible', 30.00, 'enlatado', 100, 'kelloggs'),
(15, 'Leche Condensada', 'img/productos/produ_alter.jpg', 'Lácteos en conserva', 'Leche condensada en lata', 'disponible', 40.00, 'enlatado', 100, 'alpura'),
(16, 'Refresco de Tamarindo', 'img/productos/produ_alter.jpg', 'Refresco saborizado', 'Refresco sabor tamarindo', 'disponible', 18.00, 'bebidas', 100, 'jarritos'),
(17, 'Refresco de Cola', 'img/productos/produ_alter.jpg', 'Bebida carbonatada', 'Refresco de cola clásico', 'disponible', 20.00, 'bebidas', 90, 'coca'),
(18, 'Cerveza Lager', 'img/productos/produ_alter.jpg', 'Bebida alcohólica', 'Cerveza clara lager', 'disponible', 35.00, 'bebidas', 100, 'grupo corona'),
(19, 'Batido de Chocolate', 'img/productos/produ_alter.jpg', 'Bebida láctea', 'Bebida de chocolate lista para tomar', 'disponible', 25.00, 'bebidas', 100, 'alpura'),
(20, 'Bebida de Fresa', 'img/productos/produ_alter.jpg', 'Bebida láctea', 'Batido de fresa pasteurizado', 'disponible', 27.00, 'bebidas', 100, 'lala'),
(21, 'Galletas de Chocolate', 'img/productos/produ_alter.jpg', 'Postre dulce', 'Galletas con chispas de chocolate', 'disponible', 35.00, 'snacks', 100, 'marinela'),
(22, 'Chips de Queso', 'img/productos/produ_alter.jpg', 'Snack salado', 'Chips crujientes con sabor a queso', 'disponible', 25.00, 'snacks', 100, 'sabritas'),
(23, 'Panquecito de Vainilla', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Panquecito de vainilla con relleno', 'disponible', 20.00, 'snacks', 100, 'bimbo'),
(24, 'Papas con Chile', 'img/productos/produ_alter.jpg', 'Snack picante', 'Papas fritas con chile', 'disponible', 30.00, 'snacks', 100, 'grupo corona'),
(25, 'Cereal de Chocolate', 'img/productos/produ_alter.jpg', 'Cereal crujiente', 'Cereal con sabor a chocolate', 'disponible', 50.00, 'snacks', 100, 'kelloggs'),
(26, 'Detergente en Polvo', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente en polvo para ropa', 'disponible', 90.00, 'limpieza', 87, 'ariel'),
(27, 'Suavizante de Telas', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Suavizante para ropa con aroma', 'disponible', 70.00, 'limpieza', 100, 'ace'),
(28, 'Jabón Líquido para Manos', 'img/productos/produ_alter.jpg', 'Higiene personal', 'Jabón antibacterial para manos', 'disponible', 45.00, 'limpieza', 100, 'lala'),
(29, 'Desinfectante Multiusos', 'img/productos/produ_alter.jpg', 'Limpieza general', 'Desinfectante para superficies', 'disponible', 65.00, 'limpieza', 100, 'tiarosa'),
(30, 'Blanqueador para Ropa', 'img/productos/produ_alter.jpg', 'Quitamanchas', 'Blanqueador líquido para ropa', 'disponible', 55.00, 'limpieza', 100, 'alpura'),
(31, 'Manzanas Rojas', 'img/productos/produ_alter.jpg', 'Frutas frescas', 'Manzanas rojas jugosas y dulces', 'disponible', 27.00, 'fresco', 100, 'rancho salazar'),
(32, 'Sardinas enlatadas', 'img/productos/produ_alter.jpg', 'Pescado en conserva', 'Sardinas enlatadas en aceite', 'disponible', 30.00, 'enlatado', 100, 'dolores'),
(33, 'Agua Mineral', 'img/productos/produ_alter.jpg', 'Bebida refrescante', 'Agua mineral con gas', 'disponible', 15.00, 'bebidas', 100, 'coca'),
(34, 'Galletas Saladas', 'img/productos/produ_alter.jpg', 'Snack ligero', 'Galletas saladas horneadas', 'disponible', 20.00, 'snacks', 100, 'marinela'),
(35, 'Jabón en Barra', 'img/productos/produ_alter.jpg', 'Higiene personal', 'Jabón de tocador con aroma', 'disponible', 30.00, 'limpieza', 100, 'ace'),
(36, 'Pan Dulce', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Pan dulce con azúcar glas', 'disponible', 18.00, 'fresco', 100, 'bimbo'),
(37, 'Queso Manchego', 'img/productos/produ_alter.jpg', 'Queso madurado', 'Queso manchego semicurado', 'disponible', 85.00, 'fresco', 100, 'tiarosa'),
(38, 'Leche Deslactosada', 'img/productos/produ_alter.jpg', 'Lácteos ligeros', 'Leche deslactosada sin azúcar', 'disponible', 27.00, 'fresco', 100, 'alpura'),
(39, 'Yogurt de Fresa', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt natural con fresa', 'disponible', 32.00, 'fresco', 100, 'lala'),
(40, 'Cereal Integral', 'img/productos/produ_alter.jpg', 'Desayuno saludable', 'Cereal integral con fibra', 'disponible', 60.00, 'fresco', 100, 'kelloggs'),
(41, 'Aceitunas enlatadas', 'img/productos/produ_alter.jpg', 'Conservas', 'Aceitunas verdes en salmuera', 'disponible', 38.00, 'enlatado', 100, 'la costeña'),
(42, 'Salsa Picante', 'img/productos/produ_alter.jpg', 'Condimentos', 'Salsa picante con chiles naturales', 'disponible', 25.00, 'enlatado', 100, 'grupo corona'),
(43, 'Chícharos enlatados', 'img/productos/produ_alter.jpg', 'Vegetales en conserva', 'Chícharos verdes enlatados', 'disponible', 22.00, 'enlatado', 100, 'tiarosa'),
(44, 'Arroz en bolsa', 'img/productos/produ_alter.jpg', 'Acompañamiento', 'Arroz blanco de grano largo', 'disponible', 35.00, 'enlatado', 100, 'kelloggs'),
(45, 'Leche Evaporada', 'img/productos/produ_alter.jpg', 'Lácteos enlatados', 'Leche evaporada en lata', 'disponible', 42.00, 'enlatado', 100, 'alpura'),
(46, 'Refresco de Limón', 'img/productos/produ_alter.jpg', 'Bebida gaseosa', 'Refresco sabor limón', 'disponible', 18.00, 'bebidas', 100, 'jarritos'),
(47, 'Refresco de Naranja', 'img/productos/produ_alter.jpg', 'Bebida carbonatada', 'Refresco de naranja natural', 'disponible', 22.00, 'bebidas', 100, 'coca'),
(48, 'Cerveza Oscura', 'img/productos/produ_alter.jpg', 'Bebida alcohólica', 'Cerveza oscura tipo stout', 'disponible', 40.00, 'bebidas', 100, 'grupo corona'),
(49, 'Malteada de Vainilla', 'img/productos/produ_alter.jpg', 'Bebida láctea', 'Bebida de vainilla lista para tomar', 'disponible', 28.00, 'bebidas', 100, 'alpura'),
(50, 'Bebida de Mango', 'img/productos/produ_alter.jpg', 'Bebida tropical', 'Jugo de mango natural', 'disponible', 30.00, 'bebidas', 100, 'lala'),
(51, 'Galletas de Avena', 'img/productos/produ_alter.jpg', 'Snack nutritivo', 'Galletas horneadas de avena', 'disponible', 38.00, 'snacks', 100, 'marinela'),
(52, 'Palomitas de Mantequilla', 'img/productos/produ_alter.jpg', 'Snack de maíz', 'Palomitas con mantequilla', 'disponible', 28.00, 'snacks', 100, 'sabritas'),
(53, 'Panqué de Chocolate', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Panqué esponjoso de chocolate', 'disponible', 24.00, 'snacks', 100, 'bimbo'),
(54, 'Papas con Queso', 'img/productos/produ_alter.jpg', 'Snack sabroso', 'Papas fritas sabor queso', 'disponible', 32.00, 'snacks', 100, 'grupo corona'),
(55, 'Granola con Miel', 'img/productos/produ_alter.jpg', 'Cereal saludable', 'Granola con miel y frutos secos', 'disponible', 55.00, 'snacks', 100, 'kelloggs'),
(56, 'Blanqueador en Polvo', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Blanqueador en polvo para ropa', 'disponible', 95.00, 'limpieza', 100, 'ariel'),
(57, 'Aromatizante para Ropa', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Aromatizante en spray para ropa', 'disponible', 65.00, 'limpieza', 100, 'ace'),
(58, 'Gel Antibacterial', 'img/productos/produ_alter.jpg', 'Higiene personal', 'Gel antibacterial para manos', 'disponible', 50.00, 'limpieza', 100, 'lala'),
(59, 'Limpiador Multiusos', 'img/productos/produ_alter.jpg', 'Limpieza general', 'Limpiador en spray para superficies', 'disponible', 70.00, 'limpieza', 100, 'tiarosa'),
(60, 'Detergente para Trastes', 'img/productos/produ_alter.jpg', 'Lavado de vajilla', 'Detergente líquido para trastes', 'disponible', 60.00, 'limpieza', 100, 'alpura'),
(61, 'Peras Verdes', 'img/productos/produ_alter.jpg', 'Frutas frescas', 'Peras verdes jugosas y dulces', 'disponible', 28.00, 'fresco', 100, 'rancho salazar'),
(62, 'Plátanos', 'img/productos/produ_alter.jpg', 'Frutas tropicales', 'Plátanos frescos maduros', 'disponible', 22.00, 'fresco', 100, 'rancho salazar'),
(63, 'Uvas Rojas', 'img/productos/produ_alter.jpg', 'Frutas dulces', 'Racimos de uvas rojas sin semillas', 'disponible', 35.00, 'fresco', 100, 'rancho salazar'),
(64, 'Fresas', 'img/productos/produ_alter.jpg', 'Frutas del bosque', 'Fresas frescas de temporada', 'disponible', 40.00, 'fresco', 100, 'rancho salazar'),
(65, 'Zanahorias', 'img/productos/produ_alter.jpg', 'Verduras frescas', 'Zanahorias orgánicas sin conservantes', 'disponible', 18.00, 'fresco', 100, 'rancho salazar'),
(66, 'Espinacas', 'img/productos/produ_alter.jpg', 'Verduras de hoja', 'Espinacas frescas de huerto', 'disponible', 25.00, 'fresco', 100, 'rancho salazar'),
(67, 'Jitomates', 'img/productos/produ_alter.jpg', 'Vegetales frescos', 'Jitomates bola rojos maduros', 'disponible', 30.00, 'fresco', 100, 'rancho salazar'),
(68, 'Cebollas Moradas', 'img/productos/produ_alter.jpg', 'Vegetales aromáticos', 'Cebollas moradas frescas', 'disponible', 22.00, 'fresco', 100, 'rancho salazar'),
(69, 'Aguacates', 'img/productos/produ_alter.jpg', 'Frutas cremosas', 'Aguacates Hass frescos', 'disponible', 50.00, 'fresco', 100, 'rancho salazar'),
(70, 'Pimientos Verdes', 'img/productos/produ_alter.jpg', 'Vegetales crujientes', 'Pimientos verdes frescos', 'disponible', 28.00, 'fresco', 100, 'rancho salazar'),
(71, 'Mejillones enlatados', 'img/productos/produ_alter.jpg', 'Mariscos en conserva', 'Mejillones enlatados al natural', 'disponible', 45.00, 'enlatado', 100, 'dolores'),
(72, 'Salmón enlatado', 'img/productos/produ_alter.jpg', 'Pescado premium', 'Salmón rosado enlatado', 'disponible', 75.00, 'enlatado', 100, 'dolores'),
(73, 'Pulpo enlatado', 'img/productos/produ_alter.jpg', 'Mariscos', 'Pulpo enlatado en su jugo', 'disponible', 65.00, 'enlatado', 100, 'dolores'),
(74, 'Calamares en su tinta', 'img/productos/produ_alter.jpg', 'Mariscos gourmet', 'Calamares enlatados en su tinta', 'disponible', 55.00, 'enlatado', 100, 'dolores'),
(75, 'Pimientos en conserva', 'img/productos/produ_alter.jpg', 'Vegetales enlatados', 'Pimientos morrones enlatados', 'disponible', 32.00, 'enlatado', 100, 'dolores'),
(76, 'Garbanzos enlatados', 'img/productos/produ_alter.jpg', 'Legumbres enlatadas', 'Garbanzos precocidos en lata', 'disponible', 28.00, 'enlatado', 100, 'dolores'),
(77, 'Lentejas enlatadas', 'img/productos/produ_alter.jpg', 'Legumbres', 'Lentejas listas para cocinar', 'disponible', 30.00, 'enlatado', 100, 'dolores'),
(78, 'Alcachofas enlatadas', 'img/productos/produ_alter.jpg', 'Vegetales', 'Corazones de alcachofa en salmuera', 'disponible', 40.00, 'enlatado', 100, 'dolores'),
(79, 'Chicharrón de atún', 'img/productos/produ_alter.jpg', 'Pescado deshidratado', 'Chicharrón de atún en bolsa', 'disponible', 50.00, 'enlatado', 100, 'dolores'),
(80, 'Ensalada de mariscos', 'img/productos/produ_alter.jpg', 'Comida lista', 'Mezcla de mariscos en conserva', 'disponible', 60.00, 'enlatado', 100, 'dolores'),
(81, 'Té helado de durazno', 'img/productos/produ_alter.jpg', 'Bebida refrescante', 'Té helado sabor durazno', 'disponible', 22.00, 'bebidas', 100, 'coca'),
(82, 'Té verde con limón', 'img/productos/produ_alter.jpg', 'Bebida antioxidante', 'Té verde con limón sin azúcar', 'disponible', 20.00, 'bebidas', 100, 'coca'),
(83, 'Bebida energética', 'img/productos/produ_alter.jpg', 'Bebida estimulante', 'Bebida con cafeína y vitaminas', 'disponible', 35.00, 'bebidas', 100, 'coca'),
(84, 'Jugo de zanahoria', 'img/productos/produ_alter.jpg', 'Bebida natural', 'Jugo natural de zanahoria sin azúcar', 'disponible', 25.00, 'bebidas', 100, 'coca'),
(85, 'Refresco de manzana', 'img/productos/produ_alter.jpg', 'Bebida gaseosa', 'Refresco sabor manzana', 'disponible', 18.00, 'bebidas', 100, 'coca'),
(86, 'Agua saborizada', 'img/productos/produ_alter.jpg', 'Bebida ligera', 'Agua saborizada sin gas', 'disponible', 15.00, 'bebidas', 100, 'coca'),
(87, 'Bebida de coco', 'img/productos/produ_alter.jpg', 'Bebida tropical', 'Bebida refrescante de coco', 'disponible', 32.00, 'bebidas', 100, 'coca'),
(88, 'Limonada natural', 'img/productos/produ_alter.jpg', 'Bebida cítrica', 'Limonada natural endulzada', 'disponible', 20.00, 'bebidas', 100, 'coca'),
(89, 'Jugo de piña', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Jugo natural de piña', 'disponible', 25.00, 'bebidas', 100, 'coca'),
(90, 'Bebida de sandía', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Bebida refrescante sabor sandía', 'disponible', 28.00, 'bebidas', 100, 'coca'),
(91, 'Crujitos', 'img/productos/produ_alter.jpg', 'Botana picante', 'Crujientes palitos de maíz con chile', 'disponible', 18.00, 'snacks', 100, 'sabritas'),
(92, 'Rancheritos', 'img/productos/produ_alter.jpg', 'Botana crujiente', 'Snack de maíz con especias', 'disponible', 20.00, 'snacks', 100, 'sabritas'),
(93, 'Cacahuates Japoneses', 'img/productos/produ_alter.jpg', 'Snack salado', 'Cacahuates con cobertura crujiente', 'disponible', 25.00, 'snacks', 100, 'sabritas'),
(94, 'Totis', 'img/productos/produ_alter.jpg', 'Botana de maíz', 'Palomitas de maíz sabor queso', 'disponible', 15.00, 'snacks', 100, 'sabritas'),
(95, 'Chicharrones de harina', 'img/productos/produ_alter.jpg', 'Snack crujiente', 'Chicharrones de harina con limón y chile', 'disponible', 22.00, 'snacks', 100, 'sabritas'),
(96, 'Doritos Flamin Hot', 'img/productos/produ_alter.jpg', 'Botana picosa', 'Doritos con extra picante', 'disponible', 28.00, 'snacks', 100, 'sabritas'),
(97, 'Papas Onduladas', 'img/productos/produ_alter.jpg', 'Botana crujiente', 'Papas fritas con textura ondulada', 'disponible', 30.00, 'snacks', 100, 'sabritas'),
(98, 'Habanero Mix', 'img/productos/produ_alter.jpg', 'Snack mixto', 'Mezcla de frituras con habanero', 'disponible', 32.00, 'snacks', 100, 'sabritas'),
(99, 'Cheetos Torciditos', 'img/productos/produ_alter.jpg', 'Snack de queso', 'Crujientes torciditos sabor queso', 'disponible', 18.00, 'snacks', 100, 'sabritas'),
(100, 'Takis Fuego', 'img/productos/produ_alter.jpg', 'Botana extrema', 'Rollo de maíz con chile en polvo', 'disponible', 25.00, 'snacks', 100, 'sabritas'),
(101, 'Donas Espolvoreadas', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Donas con azúcar glass', 'disponible', 28.00, 'snacks', 100, 'bimbo'),
(102, 'Conchas', 'img/productos/produ_alter.jpg', 'Pan dulce', 'Pan con costra de azúcar sabor vainilla', 'disponible', 25.00, 'snacks', 100, 'bimbo'),
(103, 'Roles de Canela', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Roles con canela y glaseado', 'disponible', 35.00, 'snacks', 100, 'bimbo'),
(104, 'Mantecadas', 'img/productos/produ_alter.jpg', 'Panquecito esponjoso', 'Panques con sabor a naranja', 'disponible', 30.00, 'snacks', 100, 'bimbo'),
(105, 'Pingüinos', 'img/productos/produ_alter.jpg', 'Pan relleno', 'Pastelitos de chocolate con crema', 'disponible', 38.00, 'snacks', 100, 'bimbo'),
(106, 'Tostadas horneadas', 'img/productos/produ_alter.jpg', 'Pan crujiente', 'Tostadas de maíz horneadas', 'disponible', 20.00, 'snacks', 100, 'bimbo'),
(107, 'Medias Noches', 'img/productos/produ_alter.jpg', 'Pan para hot dogs', 'Bollos suaves para hot dogs', 'disponible', 22.00, 'snacks', 100, 'bimbo'),
(108, 'Cuernitos', 'img/productos/produ_alter.jpg', 'Pan para bocadillos', 'Cuernitos de mantequilla', 'disponible', 27.00, 'snacks', 100, 'bimbo'),
(109, 'Galletas Integrales', 'img/productos/produ_alter.jpg', 'Snack saludable', 'Galletas de avena y trigo', 'disponible', 33.00, 'snacks', 100, 'bimbo'),
(110, 'Bisquets', 'img/productos/produ_alter.jpg', 'Pan para desayuno', 'Panecillos suaves tipo bisquet', 'disponible', 29.00, 'snacks', 100, 'bimbo'),
(111, 'Corn Flakes', 'img/productos/produ_alter.jpg', 'Cereal clásico', 'Hojuelas de maíz tostadas', 'disponible', 55.00, 'fresco', 100, 'kelloggs'),
(112, 'Zucaritas', 'img/productos/produ_alter.jpg', 'Cereal azucarado', 'Hojuelas de maíz con azúcar', 'disponible', 60.00, 'fresco', 100, 'kelloggs'),
(113, 'Special K', 'img/productos/produ_alter.jpg', 'Cereal saludable', 'Hojuelas integrales bajas en grasa', 'disponible', 70.00, 'fresco', 100, 'kelloggs'),
(114, 'All Bran', 'img/productos/produ_alter.jpg', 'Cereal alto en fibra', 'Cereal de salvado de trigo', 'disponible', 65.00, 'fresco', 100, 'kelloggs'),
(115, 'Rice Krispies', 'img/productos/produ_alter.jpg', 'Cereal crujiente', 'Cereal de arroz inflado', 'disponible', 50.00, 'fresco', 100, 'kelloggs'),
(116, 'Froot Loops', 'img/productos/produ_alter.jpg', 'Cereal de colores', 'Aros de colores sabor frutas', 'disponible', 62.00, 'fresco', 100, 'kelloggs'),
(117, 'Choco Krispis', 'img/productos/produ_alter.jpg', 'Cereal con chocolate', 'Hojuelas de arroz con cacao', 'disponible', 58.00, 'fresco', 100, 'kelloggs'),
(118, 'Miel Pops', 'img/productos/produ_alter.jpg', 'Cereal con miel', 'Bolas de maíz cubiertas con miel', 'disponible', 63.00, 'fresco', 100, 'kelloggs'),
(119, 'Frosted Mini Wheats', 'img/productos/produ_alter.jpg', 'Cereal de trigo', 'Bocadillos de trigo con azúcar glas', 'disponible', 68.00, 'fresco', 100, 'kelloggs'),
(120, 'Granola Kelloggs', 'img/productos/produ_alter.jpg', 'Cereal saludable', 'Granola con almendras y miel', 'disponible', 75.00, 'fresco', 100, 'kelloggs'),
(121, 'Leche Deslactosada', 'img/productos/produ_alter.jpg', 'Lácteos frescos', 'Leche deslactosada pasteurizada', 'disponible', 28.00, 'fresco', 100, 'alpura'),
(122, 'Yogurt con Fresas', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt con trozos de fresa', 'disponible', 32.00, 'fresco', 100, 'alpura'),
(123, 'Crema Ácida', 'img/productos/produ_alter.jpg', 'Lácteos frescos', 'Crema entera para platillos', 'disponible', 40.00, 'fresco', 100, 'alpura'),
(124, 'Mantequilla sin Sal', 'img/productos/produ_alter.jpg', 'Lácteos frescos', 'Mantequilla sin sal para cocinar', 'disponible', 50.00, 'fresco', 100, 'alpura'),
(125, 'Queso Panela', 'img/productos/produ_alter.jpg', 'Queso fresco', 'Queso panela sin conservantes', 'disponible', 65.00, 'fresco', 100, 'alpura'),
(126, 'Bebida de Almendra', 'img/productos/produ_alter.jpg', 'Alternativa láctea', 'Bebida vegetal de almendra', 'disponible', 55.00, 'bebidas', 100, 'alpura'),
(127, 'Bebida de Coco', 'img/productos/produ_alter.jpg', 'Alternativa láctea', 'Bebida vegetal de coco', 'disponible', 50.00, 'bebidas', 100, 'alpura'),
(128, 'Bebida de Avena', 'img/productos/produ_alter.jpg', 'Alternativa láctea', 'Bebida de avena sin azúcar', 'disponible', 48.00, 'bebidas', 100, 'alpura'),
(129, 'Yogurt Griego Natural', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt griego sin azúcar', 'disponible', 45.00, 'fresco', 100, 'alpura'),
(130, 'Leche en Polvo', 'img/productos/produ_alter.jpg', 'Lácteos en polvo', 'Leche entera en polvo', 'disponible', 70.00, 'fresco', 100, 'alpura'),
(131, 'Yogurt con Durazno', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt con trozos de durazno', 'disponible', 35.00, 'fresco', 100, 'lala'),
(132, 'Leche Evaporada', 'img/productos/produ_alter.jpg', 'Lácteos en conserva', 'Leche evaporada enlatada', 'disponible', 40.00, 'enlatado', 100, 'lala'),
(133, 'Queso Manchego', 'img/productos/produ_alter.jpg', 'Queso madurado', 'Queso manchego semicurado', 'disponible', 75.00, 'fresco', 100, 'lala'),
(134, 'Queso Gouda', 'img/productos/produ_alter.jpg', 'Queso madurado', 'Queso gouda semiduro', 'disponible', 85.00, 'fresco', 100, 'lala'),
(135, 'Mantequilla con Sal', 'img/productos/produ_alter.jpg', 'Lácteos frescos', 'Mantequilla con sal de mar', 'disponible', 55.00, 'fresco', 100, 'lala'),
(136, 'Crema para Café', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Crema líquida para café', 'disponible', 45.00, 'fresco', 100, 'lala'),
(137, 'Bebida de Soya', 'img/productos/produ_alter.jpg', 'Alternativa láctea', 'Bebida vegetal de soya', 'disponible', 50.00, 'bebidas', 100, 'lala'),
(138, 'Yogurt con Mango', 'img/productos/produ_alter.jpg', 'Producto lácteo', 'Yogurt con trozos de mango', 'disponible', 37.00, 'fresco', 100, 'lala'),
(139, 'Queso Ricotta', 'img/productos/produ_alter.jpg', 'Queso fresco', 'Queso ricotta suave y cremoso', 'disponible', 70.00, 'fresco', 100, 'lala'),
(140, 'Leche Orgánica', 'img/productos/produ_alter.jpg', 'Lácteos frescos', 'Leche de vacas alimentadas con pasto', 'disponible', 60.00, 'fresco', 100, 'lala'),
(141, 'Chiles Serranos en Escabeche', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles serranos encurtidos en vinagre', 'disponible', 38.00, 'enlatado', 100, 'tiarosa'),
(142, 'Ejotes enlatados', 'img/productos/produ_alter.jpg', 'Vegetales en conserva', 'Ejotes enlatados con agua y sal', 'disponible', 28.00, 'enlatado', 100, 'tiarosa'),
(143, 'Zanahorias en Conserva', 'img/productos/produ_alter.jpg', 'Vegetales', 'Zanahorias baby en vinagre', 'disponible', 32.00, 'enlatado', 100, 'tiarosa'),
(144, 'Pimientos Morrones en Lata', 'img/productos/produ_alter.jpg', 'Conservas', 'Pimientos rojos asados enlatados', 'disponible', 45.00, 'enlatado', 100, 'tiarosa'),
(145, 'Puré de Tomate', 'img/productos/produ_alter.jpg', 'Base para cocina', 'Puré de tomate natural sin conservadores', 'disponible', 30.00, 'enlatado', 100, 'tiarosa'),
(146, 'Aceitunas Negras en Salmuera', 'img/productos/produ_alter.jpg', 'Conservas', 'Aceitunas negras enteras', 'disponible', 50.00, 'enlatado', 100, 'tiarosa'),
(147, 'Espárragos en Conserva', 'img/productos/produ_alter.jpg', 'Vegetales', 'Espárragos blancos enlatados', 'disponible', 55.00, 'enlatado', 100, 'tiarosa'),
(148, 'Chicharos con Zanahoria', 'img/productos/produ_alter.jpg', 'Vegetales', 'Mezcla de chícharos y zanahorias en conserva', 'disponible', 27.00, 'enlatado', 100, 'tiarosa'),
(149, 'Frutas en Almíbar', 'img/productos/produ_alter.jpg', 'Dulce en conserva', 'Mezcla de frutas en almíbar ligero', 'disponible', 45.00, 'enlatado', 100, 'tiarosa'),
(150, 'Ensalada de Verduras', 'img/productos/produ_alter.jpg', 'Conservas', 'Ensalada de elote, chícharo y zanahoria', 'disponible', 40.00, 'enlatado', 100, 'tiarosa'),
(151, 'Salsa Picante', 'img/productos/produ_alter.jpg', 'Condimento', 'Salsa picante roja para acompañar comidas', 'disponible', 20.00, 'enlatado', 100, 'grupo corona'),
(152, 'Puré de Mango', 'img/productos/produ_alter.jpg', 'Fruta procesada', 'Puré de mango 100% natural', 'disponible', 35.00, 'enlatado', 100, 'grupo corona'),
(153, 'Aderezo de Queso Azul', 'img/productos/produ_alter.jpg', 'Salsas y aderezos', 'Aderezo cremoso de queso azul', 'disponible', 50.00, 'enlatado', 100, 'grupo corona'),
(154, 'Pimientos en Vinagre', 'img/productos/produ_alter.jpg', 'Vegetales en conserva', 'Pimientos verdes encurtidos', 'disponible', 30.00, 'enlatado', 100, 'grupo corona'),
(155, 'Jitomates Pelados en Lata', 'img/productos/produ_alter.jpg', 'Base para cocina', 'Jitomates pelados en su jugo', 'disponible', 28.00, 'enlatado', 100, 'grupo corona'),
(156, 'Sopa en Lata', 'img/productos/produ_alter.jpg', 'Comida preparada', 'Sopa de fideos enlatada', 'disponible', 40.00, 'enlatado', 100, 'grupo corona'),
(157, 'Garbanzos en Conserva', 'img/productos/produ_alter.jpg', 'Legumbres', 'Garbanzos cocidos en lata', 'disponible', 33.00, 'enlatado', 100, 'grupo corona'),
(158, 'Mermelada de Fresa', 'img/productos/produ_alter.jpg', 'Dulce en conserva', 'Mermelada de fresa sin conservadores', 'disponible', 45.00, 'enlatado', 100, 'grupo corona'),
(159, 'Chiles Habaneros en Vinagre', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles habaneros encurtidos', 'disponible', 38.00, 'enlatado', 100, 'grupo corona'),
(160, 'Maíz Blanco en Lata', 'img/productos/produ_alter.jpg', 'Granos en conserva', 'Granos de maíz blanco en almíbar', 'disponible', 30.00, 'enlatado', 100, 'grupo corona'),
(161, 'Palomitas de Mantequilla', 'img/productos/produ_alter.jpg', 'Snack crujiente', 'Palomitas con sabor a mantequilla', 'disponible', 25.00, 'snacks', 100, 'sabritas'),
(162, 'Doritos Nacho', 'img/productos/produ_alter.jpg', 'Botana de maíz', 'Totopos de maíz con queso', 'disponible', 35.00, 'snacks', 100, 'sabritas'),
(163, 'Cacahuates Enchilados', 'img/productos/produ_alter.jpg', 'Botana salada', 'Cacahuates cubiertos con chile en polvo', 'disponible', 30.00, 'snacks', 100, 'sabritas'),
(164, 'Crujitos de Queso', 'img/productos/produ_alter.jpg', 'Snack horneado', 'Crujitos sabor queso', 'disponible', 28.00, 'snacks', 100, 'sabritas'),
(165, 'Ruffles de Queso', 'img/productos/produ_alter.jpg', 'Snack crujiente', 'Papas fritas con queso', 'disponible', 40.00, 'snacks', 100, 'sabritas'),
(166, 'Papas Adobadas', 'img/productos/produ_alter.jpg', 'Botana picante', 'Papas fritas con adobo', 'disponible', 32.00, 'snacks', 100, 'sabritas'),
(167, 'Cheetos Torciditos', 'img/productos/produ_alter.jpg', 'Snack horneado', 'Crujientes de queso torciditos', 'disponible', 38.00, 'snacks', 100, 'sabritas'),
(168, 'Tostitos Salsa Verde', 'img/productos/produ_alter.jpg', 'Totopos de maíz', 'Totopos con toque de salsa verde', 'disponible', 45.00, 'snacks', 100, 'sabritas'),
(169, 'Takis Fuego', 'img/productos/produ_alter.jpg', 'Snack picante', 'Rolitos de maíz sabor chile-limón', 'disponible', 42.00, 'snacks', 100, 'sabritas'),
(170, 'Mix de Botanas', 'img/productos/produ_alter.jpg', 'Snack variado', 'Mezcla de papas, chicharrón y cacahuates', 'disponible', 50.00, 'snacks', 100, 'sabritas'),
(171, 'Cereal de Avena', 'img/productos/produ_alter.jpg', 'Cereal nutritivo', 'Cereal de avena con miel', 'disponible', 50.00, 'snacks', 100, 'kelloggs'),
(172, 'Barra de Granola', 'img/productos/produ_alter.jpg', 'Snack saludable', 'Barra de granola con frutos secos', 'disponible', 35.00, 'snacks', 100, 'kelloggs'),
(173, 'Cereal de Trigo', 'img/productos/produ_alter.jpg', 'Desayuno fortificado', 'Cereal de trigo integral', 'disponible', 55.00, 'snacks', 100, 'kelloggs'),
(174, 'Cereal Integral', 'img/productos/produ_alter.jpg', 'Cereal nutritivo', 'Cereal integral sin azúcar', 'disponible', 45.00, 'snacks', 100, 'kelloggs'),
(175, 'Galletas de Salvado', 'img/productos/produ_alter.jpg', 'Snack saludable', 'Galletas ricas en fibra', 'disponible', 30.00, 'snacks', 100, 'kelloggs'),
(176, 'Cereal con Frutas', 'img/productos/produ_alter.jpg', 'Desayuno saludable', 'Cereal con trozos de fruta', 'disponible', 60.00, 'snacks', 100, 'kelloggs'),
(177, 'Barras Energéticas', 'img/productos/produ_alter.jpg', 'Snack nutritivo', 'Barras energéticas con miel y frutos secos', 'disponible', 40.00, 'snacks', 100, 'kelloggs'),
(178, 'Cereal para Niños', 'img/productos/produ_alter.jpg', 'Cereal dulce', 'Cereal con colores y formas divertidas', 'disponible', 50.00, 'snacks', 100, 'kelloggs'),
(179, 'Granola con Almendras', 'img/productos/produ_alter.jpg', 'Desayuno saludable', 'Granola con almendras y miel', 'disponible', 55.00, 'snacks', 100, 'kelloggs'),
(180, 'Avena Instantánea', 'img/productos/produ_alter.jpg', 'Desayuno rápido', 'Avena instantánea lista para preparar', 'disponible', 30.00, 'snacks', 100, 'kelloggs'),
(181, 'Galletas de Avena', 'img/productos/produ_alter.jpg', 'Galletas saludables', 'Galletas de avena con miel', 'disponible', 30.00, 'snacks', 100, 'marinela'),
(182, 'Galletas de Coco', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Galletas con trozos de coco', 'disponible', 28.00, 'snacks', 100, 'marinela'),
(183, 'Panqué de Chocolate', 'img/productos/produ_alter.jpg', 'Postre dulce', 'Panqué esponjoso con chispas de chocolate', 'disponible', 35.00, 'snacks', 100, 'marinela'),
(184, 'Galletas de Canela', 'img/productos/produ_alter.jpg', 'Galletas tradicionales', 'Galletas crujientes con sabor a canela', 'disponible', 25.00, 'snacks', 100, 'marinela'),
(185, 'Brownies de Chocolate', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Brownies de chocolate con nuez', 'disponible', 40.00, 'snacks', 100, 'marinela'),
(186, 'Pastelito Relleno de Crema', 'img/productos/produ_alter.jpg', 'Pastel individual', 'Pastelito de vainilla relleno de crema', 'disponible', 38.00, 'snacks', 100, 'marinela'),
(187, 'Panqué de Nuez', 'img/productos/produ_alter.jpg', 'Postre dulce', 'Panqué de vainilla con trozos de nuez', 'disponible', 42.00, 'snacks', 100, 'marinela'),
(188, 'Galletas de Almendra', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Galletas de mantequilla con almendras', 'disponible', 34.00, 'snacks', 100, 'marinela'),
(189, 'Panqué de Zanahoria', 'img/productos/produ_alter.jpg', 'Dulce saludable', 'Panqué de zanahoria con especias', 'disponible', 45.00, 'snacks', 100, 'marinela'),
(190, 'Rollitos de Canela', 'img/productos/produ_alter.jpg', 'Dulce horneado', 'Rollitos de canela con glaseado', 'disponible', 50.00, 'snacks', 100, 'marinela'),
(191, 'Chiles Serranos en Escabeche', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles serranos en escabeche con zanahorias', 'disponible', 32.00, 'enlatado', 100, 'la costeña'),
(192, 'Frijoles Negros Enteros', 'img/productos/produ_alter.jpg', 'Alimento enlatado', 'Frijoles negros cocidos listos para servir', 'disponible', 28.00, 'enlatado', 100, 'la costeña'),
(193, 'Salsa Verde', 'img/productos/produ_alter.jpg', 'Salsa picante', 'Salsa verde de tomatillo con chile', 'disponible', 24.00, 'enlatado', 100, 'la costeña'),
(194, 'Salsa Roja', 'img/productos/produ_alter.jpg', 'Salsa tradicional', 'Salsa roja de jitomate y chile de árbol', 'disponible', 26.00, 'enlatado', 100, 'la costeña'),
(195, 'Chiles Chipotles Adobados', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles chipotles en adobo listos para cocinar', 'disponible', 30.00, 'enlatado', 100, 'la costeña'),
(196, 'Puré de Tomate', 'img/productos/produ_alter.jpg', 'Base para cocina', 'Puré de tomate natural para salsas y guisos', 'disponible', 22.00, 'enlatado', 100, 'la costeña'),
(197, 'Chiles Jalapeños Rellenos', 'img/productos/produ_alter.jpg', 'Acompañamiento', 'Chiles jalapeños rellenos de queso en escabeche', 'disponible', 38.00, 'enlatado', 100, 'la costeña'),
(198, 'Elotes en Grano', 'img/productos/produ_alter.jpg', 'Vegetales enlatados', 'Elotes dulces en conserva', 'disponible', 27.00, 'enlatado', 100, 'la costeña'),
(199, 'Coctel de Frutas', 'img/productos/produ_alter.jpg', 'Postre enlatado', 'Mezcla de frutas en almíbar', 'disponible', 40.00, 'enlatado', 100, 'la costeña'),
(200, 'Chiles Manzanos en Vinagre', 'img/productos/produ_alter.jpg', 'Conservas', 'Chiles manzanos en vinagre con zanahorias', 'disponible', 35.00, 'enlatado', 100, 'la costeña'),
(201, 'Refresco de Naranja', 'img/productos/produ_alter.jpg', 'Bebida carbonatada', 'Refresco de naranja con gas', 'disponible', 22.00, 'bebidas', 100, 'jarritos'),
(202, 'Refresco de Piña', 'img/productos/produ_alter.jpg', 'Bebida saborizada', 'Refresco de piña con gas', 'disponible', 23.00, 'bebidas', 100, 'jarritos'),
(203, 'Refresco de Mandarina', 'img/productos/produ_alter.jpg', 'Bebida carbonatada', 'Refresco de mandarina con gas', 'disponible', 24.00, 'bebidas', 100, 'jarritos'),
(204, 'Refresco de Toronja', 'img/productos/produ_alter.jpg', 'Bebida cítrica', 'Refresco de toronja con gas', 'disponible', 25.00, 'bebidas', 100, 'jarritos'),
(205, 'Refresco de Mora', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Refresco de mora con gas', 'disponible', 26.00, 'bebidas', 100, 'jarritos'),
(206, 'Refresco de Manzana', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Refresco de manzana con gas', 'disponible', 27.00, 'bebidas', 100, 'jarritos'),
(207, 'Refresco de Uva', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Refresco de uva con gas', 'disponible', 28.00, 'bebidas', 100, 'jarritos'),
(208, 'Refresco de Frambuesa', 'img/productos/produ_alter.jpg', 'Bebida saborizada', 'Refresco de frambuesa con gas', 'disponible', 30.00, 'bebidas', 100, 'jarritos'),
(209, 'Refresco de Guava', 'img/productos/produ_alter.jpg', 'Bebida frutal', 'Refresco de guanábana con gas', 'disponible', 32.00, 'bebidas', 100, 'jarritos'),
(210, 'Refresco de Limón', 'img/productos/produ_alter.jpg', 'Bebida cítrica', 'Refresco de limón con gas', 'disponible', 21.00, 'bebidas', 100, 'jarritos'),
(211, 'Detergente en Polvo', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente en polvo para lavar ropa', 'disponible', 75.00, 'limpieza', 100, 'ace'),
(212, 'Suavizante de Telas', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Suavizante de telas con aroma a flores', 'disponible', 45.00, 'limpieza', 100, 'ace'),
(213, 'Limpiador Multiusos', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Limpiador multiusos para superficies', 'disponible', 60.00, 'limpieza', 100, 'ace'),
(214, 'Desinfectante en Gel', 'img/productos/produ_alter.jpg', 'Desinfección', 'Gel desinfectante para manos', 'disponible', 35.00, 'limpieza', 100, 'ace'),
(215, 'Jabón para Ropa', 'img/productos/produ_alter.jpg', 'Limpieza', 'Jabón líquido para lavar ropa', 'disponible', 50.00, 'limpieza', 100, 'ace'),
(216, 'Detergente Líquido', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente líquido para lavar ropa delicada', 'disponible', 80.00, 'limpieza', 100, 'ace'),
(217, 'Limpiador de Pisos', 'img/productos/produ_alter.jpg', 'Limpieza', 'Limpiador para pisos con fragancia fresca', 'disponible', 55.00, 'limpieza', 100, 'ace'),
(218, 'Desinfectante para Cocina', 'img/productos/produ_alter.jpg', 'Desinfección', 'Desinfectante para superficies de cocina', 'disponible', 40.00, 'limpieza', 100, 'ace'),
(219, 'Limpiador de Vidrios', 'img/productos/produ_alter.jpg', 'Limpieza', 'Limpiador especial para vidrios y cristales', 'disponible', 38.00, 'limpieza', 100, 'ace'),
(220, 'Toallitas Antibacteriales', 'img/productos/produ_alter.jpg', 'Higiene personal', 'Toallitas antibacteriales para manos', 'disponible', 28.00, 'limpieza', 100, 'ace'),
(221, 'Detergente en Polvo', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente en polvo para lavar ropa', 'disponible', 75.00, 'limpieza', 100, 'ace'),
(222, 'Suavizante de Telas', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Suavizante de telas con aroma a flores', 'disponible', 45.00, 'limpieza', 100, 'ace'),
(223, 'Limpiador Multiusos', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Limpiador multiusos para superficies', 'disponible', 60.00, 'limpieza', 100, 'ace'),
(224, 'Desinfectante en Gel', 'img/productos/produ_alter.jpg', 'Desinfección', 'Gel desinfectante para manos', 'disponible', 35.00, 'limpieza', 100, 'ace'),
(225, 'Jabón para Ropa', 'img/productos/produ_alter.jpg', 'Limpieza', 'Jabón líquido para lavar ropa', 'disponible', 50.00, 'limpieza', 100, 'ace'),
(226, 'Detergente Líquido', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente líquido para lavar ropa delicada', 'disponible', 80.00, 'limpieza', 100, 'ace'),
(227, 'Limpiador de Pisos', 'img/productos/produ_alter.jpg', 'Limpieza', 'Limpiador para pisos con fragancia fresca', 'disponible', 55.00, 'limpieza', 100, 'ace'),
(228, 'Desinfectante para Cocina', 'img/productos/produ_alter.jpg', 'Desinfección', 'Desinfectante para superficies de cocina', 'disponible', 40.00, 'limpieza', 100, 'ace'),
(229, 'Limpiador de Vidrios', 'img/productos/produ_alter.jpg', 'Limpieza', 'Limpiador especial para vidrios y cristales', 'disponible', 38.00, 'limpieza', 100, 'ace'),
(230, 'Toallitas Antibacteriales', 'img/productos/produ_alter.jpg', 'Higiene personal', 'Toallitas antibacteriales para manos', 'disponible', 28.00, 'limpieza', 100, 'ace'),
(231, 'Detergente en Polvo Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente en polvo Ariel para ropa blanca y de color', 'disponible', 85.00, 'limpieza', 100, 'ariel'),
(232, 'Detergente Líquido Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente líquido Ariel para todo tipo de ropa', 'disponible', 90.00, 'limpieza', 100, 'ariel'),
(233, 'Ariel Pods', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Capsulas de detergente Ariel para lavado de ropa', 'disponible', 95.00, 'limpieza', 100, 'ariel'),
(234, 'Suavizante Ariel', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Suavizante de telas Ariel con fragancia fresca', 'disponible', 60.00, 'limpieza', 100, 'ariel'),
(235, 'Desinfectante Ariel', 'img/productos/produ_alter.jpg', 'Desinfección', 'Desinfectante líquido para ropa Ariel', 'disponible', 55.00, 'limpieza', 100, 'ariel'),
(236, 'Jabón Líquido Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Jabón líquido Ariel para manos y superficies', 'disponible', 40.00, 'limpieza', 100, 'ariel'),
(237, 'Limpiador Multiusos Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Limpiador multiusos Ariel con acción antibacteriana', 'disponible', 45.00, 'limpieza', 100, 'ariel'),
(238, 'Ariel para Ropa Oscura', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente especial para ropa oscura Ariel', 'disponible', 80.00, 'limpieza', 100, 'ariel'),
(239, 'Ariel Gel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Gel de detergente Ariel para lavadora', 'disponible', 70.00, 'limpieza', 100, 'ariel'),
(240, 'Ariel Detergente para Ropa de Cama', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente Ariel especial para ropa de cama', 'disponible', 85.00, 'limpieza', 100, 'ariel'),
(241, 'Detergente en Polvo Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente en polvo Ariel para ropa blanca y de color', 'disponible', 85.00, 'limpieza', 100, 'ariel'),
(242, 'Detergente Líquido Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente líquido Ariel para todo tipo de ropa', 'disponible', 90.00, 'limpieza', 100, 'ariel'),
(243, 'Ariel Pods', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Capsulas de detergente Ariel para lavado de ropa', 'disponible', 95.00, 'limpieza', 100, 'ariel'),
(244, 'Suavizante Ariel', 'img/productos/produ_alter.jpg', 'Cuidado de la ropa', 'Suavizante de telas Ariel con fragancia fresca', 'disponible', 60.00, 'limpieza', 100, 'ariel'),
(245, 'Desinfectante Ariel', 'img/productos/produ_alter.jpg', 'Desinfección', 'Desinfectante líquido para ropa Ariel', 'disponible', 55.00, 'limpieza', 100, 'ariel'),
(246, 'Jabón Líquido Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Jabón líquido Ariel para manos y superficies', 'disponible', 40.00, 'limpieza', 100, 'ariel'),
(247, 'Limpiador Multiusos Ariel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Limpiador multiusos Ariel con acción antibacteriana', 'disponible', 45.00, 'limpieza', 100, 'ariel'),
(248, 'Ariel para Ropa Oscura', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Detergente especial para ropa oscura Ariel', 'disponible', 80.00, 'limpieza', 100, 'ariel'),
(249, 'Ariel Gel', 'img/productos/produ_alter.jpg', 'Limpieza profunda', 'Gel de detergente Ariel para lavadora', 'disponible', 70.00, 'limpieza', 100, 'ariel'),
(253, 'Queso Oaxaca', 'img/productos/produ_alter.jpg', 'Esto es queso', 'Queso muy rico', 'disponible', 12.50, 'fresco', 100, 'rancho salazar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `opinion` text NOT NULL,
  `puntaje` int(11) DEFAULT NULL CHECK (`puntaje` between 1 and 5),
  `producto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`id`, `cliente`, `opinion`, `puntaje`, `producto`) VALUES
(1, 'Carla', '', 3, 'Manzanas Rojas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `confi_correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confi_password` varchar(255) NOT NULL,
  `tipo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `confi_correo`, `password`, `confi_password`, `tipo`) VALUES
(4, 'Andrea', 'Sánchez Pérez', 'andy@gmail.com', 'andy@gmail.com', '1234', '1234', 'administrador'),
(5, 'Carla', 'Sánchez Garcia', 'carla@gmail.com', 'carla@gmail.com', '1234', '1234', 'cliente'),
(6, 'Oscar', 'Sánchez Pérez', 'oscar@gmail.com', 'oscar@gmail.com', '1234', '1234', 'cliente'),
(7, 'Hector', 'Sanchez Garcia', 'hector@gmail.com', 'hector@gmail.com', '1234', '1234', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `total` double NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('carro','pendiente','entregado') NOT NULL DEFAULT 'carro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `id_producto`, `cantidad`, `precio`, `total`, `fecha`, `estado`) VALUES
(2, 4, 1, 20, 25.5, 510, '2025-03-17 01:08:37', 'entregado'),
(3, 4, 1, 10, 25.5, 255, '2025-03-17 01:09:32', 'entregado'),
(4, 4, 1, 10, 25.5, 255, '2025-03-17 02:04:54', 'entregado'),
(8, 4, 1, 10, 25.5, 255, '2025-03-17 02:12:30', 'entregado'),
(9, 4, 3, 10, 20, 200, '2025-03-17 02:12:37', 'entregado'),
(10, 4, 1, 10, 25.5, 255, '2025-03-17 02:12:48', 'entregado'),
(11, 4, 4, 15, 15, 225, '2025-03-17 02:12:57', 'entregado'),
(12, 5, 1, 10, 25.5, 255, '2025-03-17 02:14:05', 'entregado'),
(13, 4, 1, 10, 25.5, 255, '2025-03-17 13:31:33', 'pendiente'),
(14, 4, 17, 10, 20, 200, '2025-03-17 13:31:42', 'pendiente'),
(16, 6, 1, 21, 25.5, 535.5, '2025-03-17 13:33:20', 'entregado'),
(17, 6, 4, 10, 15, 150, '2025-03-17 13:33:26', 'entregado'),
(19, 6, 4, 8, 15, 120, '2025-03-17 13:33:52', 'carro'),
(20, 5, 2, 10, 35, 350, '2025-03-17 13:34:48', 'pendiente'),
(21, 5, 26, 13, 90, 1170, '2025-03-17 13:34:57', 'carro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactanos`
--
ALTER TABLE `contactanos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contactanos`
--
ALTER TABLE `contactanos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
