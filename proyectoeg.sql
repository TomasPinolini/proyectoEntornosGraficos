-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2024 at 12:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyectoeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE `locales` (
  `codLocal` int(11) NOT NULL,
  `nombreLocal` varchar(100) NOT NULL,
  `ubicacionLocal` varchar(50) NOT NULL,
  `rubroLocal` varchar(20) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`codLocal`, `nombreLocal`, `ubicacionLocal`, `rubroLocal`, `codUsuario`) VALUES
(4, 'primer localsito', 'alla', 'gastronomia', 10),
(5, 'segundo localsito', 'alla', 'gastronomia', 10),
(6, 'tercerLocalsito', 'acanomas', 'perfumeria', 20),
(7, 'tomduenitoLocalsito', 'allaporalla', 'indumentaria', 19),
(8, 'Cuarto Local', 'aqui', 'indumentaria', 10),
(9, 'Quinto Local', 'alla', 'gastronomia', 20),
(10, 'Sexto Local', 'aca', 'perfumeria', 19),
(11, 'Septimo Local', 'poralla', 'indumentaria', 21);

-- --------------------------------------------------------

--
-- Table structure for table `novedades`
--

CREATE TABLE `novedades` (
  `codNovedad` int(11) NOT NULL,
  `textoNovedad` varchar(200) NOT NULL,
  `fechaDesdeNovedad` date NOT NULL,
  `fechaHastaNovedad` date NOT NULL,
  `tipoUsuario` enum('administrador','dueno de local','Premium','Medium','Inicial') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `novedades`
--

INSERT INTO `novedades` (`codNovedad`, `textoNovedad`, `fechaDesdeNovedad`, `fechaHastaNovedad`, `tipoUsuario`) VALUES
(1, 'Primera Novedadd!', '2024-05-15', '2024-06-08', 'Premium'),
(3, 'Primera novedad para dueños!!!', '2024-05-15', '2024-05-16', 'dueno de local'),
(4, 'Primera novedad para administradores!!!', '2024-05-15', '2024-05-25', 'administrador'),
(5, 'deeeee\r\n', '2024-05-16', '2024-05-31', 'dueno de local'),
(6, 'Not medium', '2024-05-17', '2024-05-24', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `promociones`
--

CREATE TABLE `promociones` (
  `codPromo` int(11) NOT NULL,
  `textoPromo` varchar(200) NOT NULL,
  `fechaDesdePromo` date NOT NULL,
  `fechaHastaPromo` date NOT NULL,
  `categoria_cliente` enum('Inicial','Medium','Premium') NOT NULL,
  `diasSemana` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`diasSemana`)),
  `estadoPromo` enum('pendiente','aprobada','denegada') NOT NULL,
  `codLocal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promociones`
--

INSERT INTO `promociones` (`codPromo`, `textoPromo`, `fechaDesdePromo`, `fechaHastaPromo`, `categoria_cliente`, `diasSemana`, `estadoPromo`, `codLocal`) VALUES
(32, 'Special discount on Tuesday', '2024-05-16', '2024-05-27', 'Inicial', '[\"martes\"]', 'aprobada', 4),
(33, 'Buy one get one free on Fridays', '2024-05-16', '2024-06-22', 'Premium', '[\"viernes\"]', 'aprobada', 5),
(34, '20% off on electronics', '2024-05-16', '2024-06-01', 'Medium', '[\"lunes\",\"miércoles\",\"jueves\"]', 'aprobada', 6),
(35, 'Free dessert with every meal on Wednesdays', '2024-05-16', '2024-06-20', 'Inicial', '[\"miércoles\"]', 'aprobada', 5),
(36, '30% off on all perfumes on Mondays', '2024-05-16', '2024-06-22', 'Premium', '[\"lunes\"]', 'aprobada', 6),
(37, 'Buy two, get one free on clothing on Saturdays', '2024-05-16', '2024-07-18', 'Medium', '[\"sábado\"]', 'aprobada', 4),
(38, '15% off on all gastronomia items on Thursdays', '2024-05-16', '2024-06-25', 'Inicial', '[\"jueves\"]', 'aprobada', 5),
(39, 'Special discount on indumentaria on Sundays', '2024-05-16', '2024-06-21', 'Premium', '[\"domingo\"]', 'aprobada', 4),
(40, '10% off on all purchases', '2024-05-16', '2024-06-10', 'Medium', '[\"lunes\", \"miércoles\", \"viernes\"]', 'aprobada', 7),
(41, 'Free appetizer with every main course on Wednesdays', '2024-05-16', '2024-06-26', 'Inicial', '[\"miércoles\"]', 'aprobada', 5),
(42, 'Buy one get one free on pizzas on Thursdays', '2024-05-16', '2024-06-21', 'Premium', '[\"jueves\"]', 'aprobada', 9),
(43, '25% off on all bebidas on Tuesdays', '2024-05-16', '2024-05-31', 'Medium', '[\"martes\"]', 'aprobada', 4),
(44, 'Special discount for Mother\'s Day (May 26th)', '2024-05-16', '2024-05-26', 'Inicial', '[\"domingo\"]', 'aprobada', 8),
(45, '15% off on all clothing for Father\'s Day (June 16th)', '2024-05-16', '2024-06-16', 'Premium', '[\"domingo\"]', 'aprobada', 6),
(46, 'Weekend breakfast buffet promotion (Saturdays and Sundays)', '2024-05-16', '2024-06-30', 'Medium', '[\"sábado\", \"domingo\"]', 'aprobada', 11),
(47, 'Free movie ticket with every purchase over $50', '2024-05-16', '2024-06-03', 'Inicial', '[\"viernes\", \"sábado\", \"domingo\"]', 'aprobada', 4),
(48, 'Buy a coffee, get a pastry for half price on Mondays', '2024-05-16', '2024-06-17', 'Premium', '[\"lunes\"]', 'aprobada', 7),
(49, 'Flash sale: 30% off on electronics for 24 hours only (starting May 27th, 10:00 AM)', '2024-05-16', '2024-05-27', 'Medium', '[\"lunes\"]', 'aprobada', 5),
(50, 'Double points for loyalty members on Tuesdays and Wednesdays', '2024-05-16', '2024-06-19', 'Inicial', '[\"martes\", \"miércoles\"]', 'aprobada', 9),
(51, 'Tuesday morning discount (10% off) on all bakery items', '2024-05-16', '2024-06-18', 'Medium', '[\"martes\"]', 'aprobada', 6),
(52, 'Student discount (15% off) on weekdays', '2024-05-16', '2024-06-14', 'Inicial', '[\"lunes\", \"martes\", \"miercoles\", \"jueves\", \"viernes\"]', 'aprobada', 10),
(53, 'Happy Hour! Buy one beer, get one free (Fridays 5PM-7PM)', '2024-05-16', '2024-06-28', 'Premium', '[\"viernes\"]', 'aprobada', 8),
(54, 'Free delivery on orders over $30 (except Sundays)', '2024-05-16', '2024-06-20', 'Inicial', '[\"lunes\", \"martes\", \"miercoles\", \"jueves\", \"viernes\", \"sabado\"]', 'aprobada', 4),
(55, 'Triple points for loyalty members on weekends', '2024-05-16', '2024-06-30', 'Medium', '[\"sabado\", \"domingo\"]', 'aprobada', 11),
(56, 'Senior citizen discount (20% off) on Tuesdays and Thursdays', '2024-05-16', '2024-06-27', 'Premium', '[\"martes\", \"jueves\"]', 'aprobada', 5),
(57, 'Birthday week promotion (10% off entire purchase)', '2024-05-16', '2024-06-01', 'Inicial', '[\"lunes\", \"martes\", \"miercoles\", \"jueves\", \"viernes\", \"sabado\", \"domingo\"]', 'aprobada', 9),
(58, 'Free gift with every purchase over $50 (while supplies last)', '2024-05-16', '2024-06-08', 'Medium', '[\"todos\"]', 'aprobada', 7),
(59, 'Bring a friend, get 10% off for both (on Wednesdays)', '2024-05-16', '2024-06-26', 'Premium', '[\"miercoles\"]', 'aprobada', 6),
(60, 'End-of-season sale: Up to 50% off on selected items', '2024-05-16', '2024-06-23', 'Inicial', '[\"todos\"]', 'aprobada', 6);

-- --------------------------------------------------------

--
-- Table structure for table `usos_promociones`
--

CREATE TABLE `usos_promociones` (
  `codCliente` int(11) NOT NULL,
  `codPromo` int(11) NOT NULL,
  `fechaUsoPromo` date NOT NULL,
  `estado` enum('enviada','aceptada','rechazada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usos_promociones`
--

INSERT INTO `usos_promociones` (`codCliente`, `codPromo`, `fechaUsoPromo`, `estado`) VALUES
(11, 32, '2024-05-21', 'aceptada'),
(22, 33, '2024-05-23', 'aceptada'),
(40, 34, '2024-05-24', 'aceptada'),
(11, 35, '2024-05-25', 'aceptada'),
(22, 36, '2024-05-26', 'aceptada'),
(11, 35, '2024-05-15', 'aceptada'),
(11, 38, '2024-05-15', 'aceptada'),
(11, 41, '2024-05-15', 'aceptada'),
(11, 35, '2024-05-15', 'aceptada'),
(40, 32, '2024-05-15', 'aceptada'),
(40, 32, '2024-05-15', 'aceptada'),
(40, 47, '2024-05-15', 'aceptada'),
(40, 54, '2024-05-15', 'aceptada'),
(11, 42, '2024-05-16', 'aceptada');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `codUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `claveUsuario` varchar(8) NOT NULL,
  `tipoUsuario` enum('administrador','dueno de local','cliente') NOT NULL,
  `categoria_cliente` varchar(10) NOT NULL,
  `token_activation` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`codUsuario`, `nombreUsuario`, `claveUsuario`, `tipoUsuario`, `categoria_cliente`, `token_activation`) VALUES
(10, 'tomdueno@gmail.com', '123', 'dueno de local', '', NULL),
(11, 'tomcliente@gmail.com', '123', 'cliente', 'Premium', NULL),
(19, 'tomduenito@gmail.com', '123', 'dueno de local', '', NULL),
(20, 'tomduenaso@gmail.com', '123', 'dueno de local', '', NULL),
(21, 'tomduenotoken@gmail.com', '123', 'dueno de local', '', NULL),
(22, 'tomclientetoken@gmail.com', '123', 'cliente', 'Inicial', NULL),
(40, 'tomaspinolini2003@gmail.com', '123', 'cliente', 'Medium', NULL),
(41, 'tomadmin@gmail.com', '123', 'administrador', '', NULL),
(42, 'fiorellacassina@gmail.com', '123', 'cliente', 'Inicial', '6359bec2ea0f22ba3cd958463282d80c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`codLocal`),
  ADD KEY `locales_ibfk_1` (`codUsuario`);

--
-- Indexes for table `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`codNovedad`);

--
-- Indexes for table `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`codPromo`),
  ADD KEY `promociones_ibfk_1` (`codLocal`);

--
-- Indexes for table `usos_promociones`
--
ALTER TABLE `usos_promociones`
  ADD KEY `codCliente` (`codCliente`),
  ADD KEY `codPromo` (`codPromo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codUsuario`),
  ADD UNIQUE KEY `nombreUsuairo` (`nombreUsuario`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD UNIQUE KEY `token_activation` (`token_activation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `codLocal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `novedades`
--
ALTER TABLE `novedades`
  MODIFY `codNovedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promociones`
--
ALTER TABLE `promociones`
  MODIFY `codPromo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locales`
--
ALTER TABLE `locales`
  ADD CONSTRAINT `locales_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `usuarios` (`codUsuario`) ON DELETE CASCADE;

--
-- Constraints for table `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`codLocal`) REFERENCES `locales` (`codLocal`) ON DELETE CASCADE;

--
-- Constraints for table `usos_promociones`
--
ALTER TABLE `usos_promociones`
  ADD CONSTRAINT `usos_promociones_ibfk_1` FOREIGN KEY (`codCliente`) REFERENCES `usuarios` (`codUsuario`),
  ADD CONSTRAINT `usos_promociones_ibfk_2` FOREIGN KEY (`codPromo`) REFERENCES `promociones` (`codPromo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
