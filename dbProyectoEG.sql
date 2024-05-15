-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2024 at 02:28 PM
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
(7, 'tomduenitoLocalsito', 'allaporalla', 'indumentaria', 19);

-- --------------------------------------------------------

--
-- Table structure for table `novedades`
--

CREATE TABLE `novedades` (
  `codNovedad` int(11) NOT NULL,
  `textoNovedad` varchar(200) NOT NULL,
  `fechaDesdeNovedad` date NOT NULL,
  `fechaHastaNovedad` date NOT NULL,
  `tipoUsuario` enum('administrador','dueno de local','cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 'cuartaPromo', '2024-05-16', '2024-08-02', 'Medium', '[\"lunes\",\"martes\",\"jueves\",\"sabado\"]', 'aprobada', 6),
(28, 'primerPromo', '2024-05-15', '2024-05-17', 'Premium', '[\"viernes\"]', 'aprobada', 4),
(29, 'segundaPromo', '2024-05-16', '2024-05-24', 'Medium', '[\"jueves\"]', 'aprobada', 6),
(30, 'quintaPromo', '2024-05-09', '2024-05-16', 'Premium', '[\"martes\"]', 'aprobada', 7),
(31, 'promoinciailes', '2024-05-09', '2200-01-01', 'Inicial', '[\"lunes\",\"martes\",\"miercoles\",\"jueves\",\"viernes\"]', 'aprobada', 5);

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
(11, 'tomcliente@gmail.com', '123', 'cliente', 'Inicial', NULL),
(19, 'tomduenito@gmail.com', '123', 'dueno de local', '', NULL),
(20, 'tomduenaso@gmail.com', '123', 'dueno de local', '', NULL),
(21, 'tomduenotoken@gmail.com', '123', 'dueno de local', '', NULL),
(22, 'tomclientetoken@gmail.com', '123', 'cliente', 'Inicial', NULL),
(40, 'tomaspinolini2003@gmail.com', '123', 'cliente', 'Inicial', NULL),
(41, 'tomadmin@gmail.com', '123', 'administrador', '', NULL);

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
  MODIFY `codLocal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `novedades`
--
ALTER TABLE `novedades`
  MODIFY `codNovedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promociones`
--
ALTER TABLE `promociones`
  MODIFY `codPromo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
