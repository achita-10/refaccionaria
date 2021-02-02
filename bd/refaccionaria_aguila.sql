-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2019 a las 23:45:31
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `refaccionaria_aguila`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicaciones`
--

CREATE TABLE `aplicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Articulo` bigint(20) UNSIGNED NOT NULL,
  `Modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ano` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Motor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Categoria` bigint(20) UNSIGNED NOT NULL,
  `Codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Precio_Venta` decimal(11,2) NOT NULL,
  `Precio_Compra` decimal(11,2) NOT NULL,
  `N_Parte` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `N_SAT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Stock` int(11) NOT NULL,
  `Imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `C_Unidad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `ID_Categoria`, `Codigo`, `Nombre`, `Precio_Venta`, `Precio_Compra`, `N_Parte`, `N_SAT`, `Stock`, `Imagen`, `Descripcion`, `C_Unidad`, `Condicion`, `created_at`, `updated_at`) VALUES
(1, 1, '84109210045', 'Aceite Repsol Moto', '100.00', '82.00', 'MA2', '15121501', 40, '1563838903_aceiterepsol.jpg', 'Aceite Repsol 1LT', NULL, 1, '2019-07-23 04:41:43', '2019-08-05 20:54:27'),
(2, 1, '75445644', 'Aceite Mobil Super 5W-30', '150.00', '100.00', '838383', '73737', 30, '1566845213_5.png', 'Aceite Para Motor 5LT', NULL, 1, '2019-07-23 04:46:34', '2019-08-26 23:46:53'),
(3, 2, '8656457428545', 'Bateria Gonher', '1590.00', '1212.00', 'G-58', '26111703', 2, '1565707104_cita-aurelia.png', 'bateria para carro', '32434232', 1, '2019-07-23 04:51:06', '2019-08-13 19:38:24'),
(4, 1, '78823872387', 'sdsadsadsa', '243.00', '322.00', 'sdsadsada', 'dsdasdas', 3, '', 'sddasdas', 'H87', 1, '2019-09-01 22:55:28', '2019-09-01 22:55:28'),
(5, 2, '21213232', 'sdsadasd', '212.00', '322.00', '121212', 'qawqwqw', 3, '', 'wqwqwqw', 'H87', 1, '2019-09-01 22:55:55', '2019-09-01 22:55:55'),
(6, 7, '23223213', 'asdasd', '23.00', '33.00', 'sdasda', 'dadasd', 2, '', 'dsds', 'H87', 1, '2019-09-01 22:57:51', '2019-09-01 22:57:51'),
(7, 10, '31312121', 'caada', '21.00', '434.00', 'saddas', 'sdsadsaa', 2, '', 'dadaa', 'H87', 1, '2019-09-01 22:58:11', '2019-09-01 22:58:11'),
(8, 3, '33232332', 'sdasdasd', '23.00', '444.00', 'sdadad', '3232', 2, '', 'sadda', 'H87', 1, '2019-09-01 22:58:39', '2019-09-01 22:58:39'),
(9, 4, '323232', 'dadas', '22.00', '232.00', 'asdsada', 'asddas', 4, '1567375701_Tulips.jpg', '2wewqeq', 'H87', 1, '2019-09-02 03:05:56', '2019-09-02 03:08:21'),
(10, 6, '232', 'sdad', '323.00', '23.00', 'sadasd', 'fsdfdf', 2, '', 'sdasdas', 'H87', 1, '2019-09-02 03:11:15', '2019-09-02 03:11:15'),
(11, 7, '937397', 'ttyt', '454.00', '454.00', '24234', 'dfsfd', 2, '', 'fdf', 'H87', 1, '2019-09-02 03:11:43', '2019-09-02 03:11:43'),
(12, 10, '4343', 'ddsad', '3232.00', '565.00', 'dasdas', 'dsda', 2, '', 'sdsd', 'H87', 1, '2019-09-02 03:12:09', '2019-09-02 03:12:09'),
(13, 8, '121132', 'eedfasd', '23.00', '32.00', 'asdsd', 'dsds', 2, '', 'dsd', 'H87', 1, '2019-09-02 03:16:40', '2019-09-02 03:16:40'),
(14, 8, '687657657', 'hjhkh', '45.00', '23.00', 'sdasdas', 'sdasd', 2, '', NULL, 'H87', 1, '2019-09-02 03:17:06', '2019-09-02 03:17:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `Nombre`, `Descripcion`, `Condicion`, `created_at`, `updated_at`) VALUES
(1, 'Aceites', 'Todo tipo de aceites', 1, '2019-07-23 04:07:39', '2019-07-23 04:07:39'),
(2, 'Baterias', 'Todo tipo de baterias', 1, '2019-07-23 04:07:55', '2019-07-23 04:07:55'),
(3, 'w12w11', NULL, 1, '2019-09-01 22:56:06', '2019-09-01 22:56:06'),
(4, '2wsdadad', 'sa', 1, '2019-09-01 22:56:13', '2019-09-01 22:56:13'),
(5, '212112sdsada', NULL, 1, '2019-09-01 22:56:19', '2019-09-01 22:56:19'),
(6, 'sdsadsa23221', NULL, 1, '2019-09-01 22:56:25', '2019-09-01 22:56:25'),
(7, 'sdsada131dw', NULL, 1, '2019-09-01 22:56:31', '2019-09-01 22:56:31'),
(8, 'ewedwqdscds', NULL, 1, '2019-09-01 22:56:37', '2019-09-01 22:56:37'),
(9, 'asdasasda', NULL, 1, '2019-09-01 22:56:42', '2019-09-01 22:56:42'),
(10, 'rwerr', NULL, 1, '2019-09-01 22:56:48', '2019-09-01 22:56:48'),
(11, 'dsadasdas', NULL, 1, '2019-09-01 22:56:53', '2019-09-01 22:56:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ingresos`
--

CREATE TABLE `detalles_ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Ingreso` bigint(20) UNSIGNED NOT NULL,
  `ID_Articulo` bigint(20) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_ingresos`
--

INSERT INTO `detalles_ingresos` (`id`, `ID_Ingreso`, `ID_Articulo`, `Cantidad`, `Precio`) VALUES
(1, 1, 1, 10, '82.00'),
(2, 1, 3, 2, '1212.00'),
(3, 1, 2, 20, '100.00'),
(4, 2, 2, 25, '100.00'),
(5, 2, 1, 30, '82.00');

--
-- Disparadores `detalles_ingresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalles_ingresos` FOR EACH ROW BEGIN

	UPDATE articulos SET stock = stock + NEW.Cantidad

	WHERE articulos.id = NEW.ID_Articulo;

	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Venta` bigint(20) UNSIGNED NOT NULL,
  `ID_Articulo` bigint(20) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(11,2) NOT NULL,
  `Descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `ID_Venta`, `ID_Articulo`, `Cantidad`, `Precio`, `Descuento`) VALUES
(1, 1, 2, 10, '150.00', '0.00'),
(2, 1, 1, 15, '100.00', '0.00'),
(3, 2, 3, 1, '1590.00', '0.00'),
(4, 2, 1, 5, '100.00', '0.00'),
(5, 3, 3, 1, '1590.00', '0.00'),
(6, 3, 1, 10, '100.00', '0.00');

--
-- Disparadores `detalle_ventas`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_ventas` FOR EACH ROW BEGIN

	UPDATE articulos SET stock = stock - NEW.Cantidad

	WHERE articulos.id = NEW.ID_Articulo;

	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Venta` bigint(20) UNSIGNED NOT NULL,
  `ID_Cliente` bigint(20) UNSIGNED NOT NULL,
  `ID_Usuario` bigint(20) UNSIGNED NOT NULL,
  `Uso` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Impuesto` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipo_Comprobante` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Num_Comprobante` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Moneda` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Forma_Pago` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Metodo_Pago` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Regimen` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fecha_Hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `ID_Venta`, `ID_Cliente`, `ID_Usuario`, `Uso`, `Impuesto`, `Tipo_Comprobante`, `Num_Comprobante`, `Moneda`, `Forma_Pago`, `Metodo_Pago`, `Regimen`, `Fecha_Hora`) VALUES
(1, 1, 4, 1, 'G01', '002', 'I', '876444', 'MXN', '01', 'PUE', '621', '2019-08-02 21:40:17'),
(2, 3, 3, 1, 'G01', '002', 'I', '6438765454', 'MXN', '99', 'PPD', '601', '2019-08-05 13:42:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Proveedor` bigint(20) UNSIGNED NOT NULL,
  `ID_Usuario` bigint(20) UNSIGNED NOT NULL,
  `Tipo_Comprobante` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Num_Folio` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fecha_Hora` datetime NOT NULL,
  `Impuesto` decimal(4,2) NOT NULL,
  `Total` decimal(11,2) NOT NULL,
  `Estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `ID_Proveedor`, `ID_Usuario`, `Tipo_Comprobante`, `Num_Folio`, `Fecha_Hora`, `Impuesto`, `Total`, `Estado`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Factura', '998779768', '2019-07-29 12:58:00', '0.16', '5244.00', 'Anulado', '2019-07-29 22:58:00', '2019-07-29 23:01:43'),
(2, 3, 1, 'Factura', '0002', '2019-07-29 13:04:55', '0.16', '4960.00', 'Registrado', '2019-07-29 23:04:55', '2019-07-29 23:04:55');

--
-- Disparadores `ingresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngresoAnular` AFTER UPDATE ON `ingresos` FOR EACH ROW BEGIN

		UPDATE articulos a

		JOIN detalles_ingresos di

		ON di.ID_Articulo = a.id

		AND di.ID_Ingreso = new.id

		set a.stock = a.stock - di.cantidad;

	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_06_20_002411_create_categorias_table', 1),
(2, '2019_06_23_151218_create_articulos_table', 1),
(3, '2019_06_26_042731_create_personas_table', 1),
(4, '2019_06_28_032249_create_proveedores_table', 1),
(5, '2019_06_30_013523_create_roles_table', 1),
(6, '2019_07_01_000000_create_users_table', 1),
(7, '2019_07_04_020842_create_ingresos_table', 1),
(8, '2019_07_04_020914_create_detalles_ingresos_table', 1),
(9, '2019_07_08_020936_create_aplicaciones_table', 1),
(10, '2019_07_28_195710_create_ventas_table', 2),
(11, '2019_07_28_195845_create_detalle_ventas_table', 2),
(13, '2019_08_03_002405_create_facturas_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipo_Documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Num_Documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `Nombre`, `Tipo_Documento`, `Num_Documento`, `Direccion`, `Telefono`, `Email`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Nombre: MORSA S.A DE C.V', 'RFC', '128293k28ks89', 'Veracruz', '229167263', NULL, '2019-07-23 04:05:47', '2019-07-23 04:05:47'),
(3, 'Yazmin Mariela', 'RFC', '2728937399327', 'Liborio F. Chigo', '2941827974', NULL, '2019-07-23 04:06:38', '2019-07-23 04:06:38'),
(4, 'David Gallardo Bustamante', 'RFC', '19281928718', 'Cedros Esquina Pinos', '2941228046', 'david@gmail.com', '2019-07-29 23:18:55', '2019-07-29 23:18:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Contacto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telefono_Contacto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `Contacto`, `Telefono_Contacto`) VALUES
(2, NULL, NULL),
(3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `Nombre`, `Descripcion`, `Condicion`) VALUES
(1, 'Administrador', 'Administradores de Área', 1),
(2, 'Vendedor', 'Vendedor Área Venta', 1),
(3, 'Almacenero', 'Almacenero Área Compras', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Condicion` tinyint(1) NOT NULL DEFAULT '1',
  `ID_Rol` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `Condicion`, `ID_Rol`, `remember_token`) VALUES
(1, 'admin', '$2y$10$ubvFnlk6t3r.u7IOlJ2bp.tdhzx90OPCQISVfZ3WoH24HAZRwX33S', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Usuario` bigint(20) UNSIGNED NOT NULL,
  `Fecha_Hora` datetime NOT NULL,
  `Impuesto` decimal(4,2) NOT NULL,
  `Total` decimal(11,2) NOT NULL,
  `Estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `ID_Usuario`, `Fecha_Hora`, `Impuesto`, `Total`, `Estado`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-31 14:32:31', '0.16', '3000.00', 'Registrado', '2019-08-01 00:32:32', '2019-08-01 00:32:32'),
(2, 1, '2019-08-02 21:55:39', '0.16', '2090.00', 'Registrado', '2019-08-03 07:55:40', '2019-08-03 07:55:40'),
(3, 1, '2019-08-05 13:32:05', '0.16', '2590.00', 'Registrado', '2019-08-05 23:32:05', '2019-08-05 23:32:05');

--
-- Disparadores `ventas`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVentaAnular` AFTER UPDATE ON `ventas` FOR EACH ROW BEGIN

		UPDATE articulos a

		JOIN detalle_ventas dv

		ON dv.ID_Articulo = a.id

		AND dv.ID_Venta = new.id

		set a.stock = a.stock + dv.cantidad;

	END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aplicaciones_id_articulo_foreign` (`ID_Articulo`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articulos_nombre_unique` (`Nombre`),
  ADD KEY `articulos_id_categoria_foreign` (`ID_Categoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_ingresos_id_ingreso_foreign` (`ID_Ingreso`),
  ADD KEY `detalles_ingresos_id_articulo_foreign` (`ID_Articulo`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_id_venta_foreign` (`ID_Venta`),
  ADD KEY `detalle_ventas_id_articulo_foreign` (`ID_Articulo`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id_venta_foreign` (`ID_Venta`),
  ADD KEY `facturas_id_cliente_foreign` (`ID_Cliente`),
  ADD KEY `facturas_id_usuario_foreign` (`ID_Usuario`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_id_proveedor_foreign` (`ID_Proveedor`),
  ADD KEY `ingresos_id_usuario_foreign` (`ID_Usuario`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_nombre_unique` (`Nombre`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD KEY `proveedores_id_foreign` (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`Nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_foreign` (`id`),
  ADD KEY `users_id_rol_foreign` (`ID_Rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_id_usuario_foreign` (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD CONSTRAINT `aplicaciones_id_articulo_foreign` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulos` (`id`);

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_id_categoria_foreign` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD CONSTRAINT `detalles_ingresos_id_articulo_foreign` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `detalles_ingresos_id_ingreso_foreign` FOREIGN KEY (`ID_Ingreso`) REFERENCES `ingresos` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_id_articulo_foreign` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `detalle_ventas_id_venta_foreign` FOREIGN KEY (`ID_Venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_id_cliente_foreign` FOREIGN KEY (`ID_Cliente`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `facturas_id_usuario_foreign` FOREIGN KEY (`ID_Usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `facturas_id_venta_foreign` FOREIGN KEY (`ID_Venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_id_proveedor_foreign` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `ingresos_id_usuario_foreign` FOREIGN KEY (`ID_Usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`ID_Rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_id_usuario_foreign` FOREIGN KEY (`ID_Usuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
