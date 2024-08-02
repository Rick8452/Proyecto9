-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307:3307
-- Tiempo de generación: 19-07-2024 a las 01:38:21
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
-- Base de datos: `tiendavirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idcliente` int(12) DEFAULT NULL,
  `idproducto` int(12) DEFAULT NULL,
  `cantidad` int(12) DEFAULT NULL,
  `precio` float(12,2) DEFAULT NULL,
  `fechahora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idcliente`, `idproducto`, `cantidad`, `precio`, `fechahora`) VALUES
(1, 4, 1, 70.00, 2024),
(2, 4, 1, 70.00, 2024),
(1, 3, 1, 60.00, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `descripcion`) VALUES
(1, 'Trabajos en acrílico'),
(2, 'Trabajos en madera'),
(3, 'Trabajos en metal'),
(4, 'Trabajos en plastico'),
(5, 'Trabajos en triplay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `idchat` int(12) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `idcliente` int(12) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT '1 enviado por el cliente 2\r\nrespuesta',
  `mensaje` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`idchat`, `fecha`, `idcliente`, `tipo`, `mensaje`) VALUES
(24, '2024-07-19 00:21:43', 0, 0, 'hola pedro'),
(25, '2024-07-18 16:28:51', 0, 0, 'que paso pedro'),
(26, '2024-07-19 00:32:06', 0, 0, 'Hola pedro'),
(27, '2024-07-18 16:32:22', 0, 0, '25\r\n'),
(28, '2024-07-18 16:41:24', 2, 0, 'hola'),
(29, '2024-07-18 16:42:11', 1, 0, 'hola'),
(31, '2024-07-18 17:26:53', 1, 1, 'Mensaje de prueba para el admin de parte de Jorge.'),
(32, '2024-07-18 17:29:13', 1, 1, ' Mensaje de prueba para el admin de parte de Jorge. '),
(33, '2024-07-18 17:33:24', 1, 2, 'hola soy el administrador que necesitas jorge?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fechaalta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `email`, `password`, `nombre`, `fechaalta`) VALUES
(1, 'r@a.com', '12345', 'roman', NULL),
(2, 'jose@u.com', '12345', 'Jose Garcia', NULL),
(3, 'admin@a.com', '12345', 'admin', NULL),
(4, 'a@admin.com', '12345', 'admin', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `comentarios` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`nombre`, `email`, `telefono`, `comentarios`) VALUES
('roman', 'r@a.com', 2147483647, 'opopip0kojjvbhcgcg'),
('roman', 'r@a.com', 2147483647, 'opopip0kojjvbhcgcg'),
('Jorge Sanchez', 'Jorge@a.com', 2147483647, 'Este mensaje es de prueba para mostrar el funcionamiento correcto del contacto.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idpedido` int(12) DEFAULT NULL,
  `idproducto` int(12) DEFAULT NULL,
  `cantidad` int(2) DEFAULT NULL,
  `precio` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idpedido`, `idproducto`, `cantidad`, `precio`) VALUES
(1, 7, 1, 50.00),
(1, 11, 1, 90.00),
(2, 6, 1, 90.00),
(2, 7, 1, 50.00),
(3, 3, 1, 60.00),
(3, 4, 1, 70.00),
(4, 3, 1, 60.00),
(4, 4, 1, 70.00),
(5, 3, 1, 60.00),
(5, 4, 1, 70.00),
(6, 4, 1, 70.00),
(6, 7, 1, 50.00),
(6, 3, 1, 60.00),
(6, 6, 1, 90.00),
(8, 4, 1, 70.00),
(8, 3, 1, 60.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(12) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `idcliente` int(12) DEFAULT NULL,
  `recibe` varchar(200) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `fecha`, `idcliente`, `recibe`, `calle`, `colonia`, `estado`, `municipio`, `cp`, `telefono`) VALUES
(1, '2024-07-04 23:30:27', 1, '', '', '', '', '', '', ''),
(2, '2024-07-04 23:36:11', 1, 'jose', 'j', 'chacon', 'hidalgo', 'pachuca', '42000', '5520330500'),
(3, '2024-07-04 23:39:36', 1, 'jose', 'a', 'chacon', 'Hgo.', 'pachuca', '42186', '12345679890'),
(4, '2024-07-04 23:41:10', 1, 'jose', 'a', 'chacon', 'Hgo.', 'pachuca', '42083', '12345679890'),
(5, '2024-07-05 00:41:26', 1, 'Jose Romero', 'centro', 'Centro', 'Hidalgo', 'Pachuca de soto', '42000', '771123 4567'),
(6, '2024-07-12 01:23:49', 1, 'pedro', 'k', 'k', 'j', 'k', 'k', 'n'),
(7, '2024-07-12 01:24:27', 1, 'pedro', 'k', 'k', 'j', 'k', 'k', 'n'),
(8, '2024-07-12 01:28:07', 2, 'h', 'h', 'h', 'h', 'h', 'h', 'h');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float(15,2) NOT NULL,
  `urlimagen` varchar(1000) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `descripcion`, `precio`, `urlimagen`, `idcategoria`) VALUES
(2, 'Caja acrilico', 50.00, 'http://localhost:8080/proyecto9/img/imagen1.jpg', 1),
(3, 'Bases para celular acrilico', 60.00, 'http://localhost:8080/proyecto9/img/imagen2.jpg', 1),
(4, 'Organizador de acrilico', 70.00, 'http://localhost:8080/proyecto9/img/imagen3.jpg', 1),
(5, 'Recuerdos de acrilico', 80.00, 'http://localhost:8080/proyecto9/img/imagen4.jpg', 1),
(6, 'Buzon de acrilico', 90.00, 'http://localhost:8080/proyecto9/img/imagen5.jpg', 1),
(7, 'Cuadro relieve de madera', 50.00, 'http://localhost:8080/proyecto9/img/imagen6.jpg', 2),
(8, 'Escudos de equipos de madera', 60.00, 'http://localhost:8080/proyecto9/img/imagen7.jpg', 2),
(9, 'Silla de madera', 70.00, 'http://localhost:8080/proyecto9/img/imagen8.jpg', 2),
(10, 'Cuadro caballo de madera', 80.00, 'http://localhost:8080/proyecto9/img/imagen9.jpg', 2),
(11, 'Recuerdos de madera', 90.00, 'http://localhost:8080/proyecto9/img/imagen10.jpg', 2),
(12, 'Grabado de metal', 50.00, 'http://localhost:8080/proyecto9/img/imagen11.jpg', 3),
(13, 'Estrella de metal', 60.00, 'http://localhost:8080/proyecto9/img/imagen12.jpg', 3),
(14, 'Letras en metal', 70.00, 'http://localhost:8080/proyecto9/img/imagen13.jpg', 3),
(15, 'Soportes de metal', 80.00, 'http://localhost:8080/proyecto9/img/imagen14.jpg', 3),
(16, 'Engranajes de metal', 90.00, 'http://localhost:8080/proyecto9/img/imagen15.jpg', 3),
(17, 'Recuerdos de plastico\r\n', 50.00, 'http://localhost:8080/proyecto9/img/imagen16.jpg', 4),
(18, 'Separador de plastico', 60.00, 'http://localhost:8080/proyecto9/img/imagen17.jpg', 4),
(19, 'Letras de plastico', 70.00, 'http://localhost:8080/proyecto9/img/imagen18.jpg', 4),
(20, 'Piezas de plastico', 80.00, 'http://localhost:8080/proyecto9/img/imagen19.jpg', 4),
(21, 'Organizador de plastico', 90.00, 'http://localhost:8080/proyecto9/img/imagen20.jpg', 4),
(22, 'Letras de triplay', 50.00, 'http://localhost:8080/proyecto9/img/imagen21.jpg', 5),
(23, 'Silla de triplay', 60.00, 'http://localhost:8080/proyecto9/img/imagen22.jpg', 5),
(24, 'Banco de triplay', 70.00, 'http://localhost:8080/proyecto9/img/imagen23.jpg', 5),
(25, 'Cuadro de triplay', 80.00, 'http://localhost:8080/proyecto9/img/imagen24.jpg', 5),
(26, 'Relieve en triplay', 90.00, 'http://localhost:8080/proyecto9/img/imagen25.jpg', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
