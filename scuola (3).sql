-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2018 at 11:15 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scuola`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `idprof` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `admin`, `idprof`) VALUES
(2, 'lol', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL),
(3, 'mem', 'd41d8cd98f00b204e9800998ecf8427e', 1, 1),
(6, 'sese', 'd41d8cd98f00b204e9800998ecf8427e', 1, NULL),
(7, 'giulio', '6dd1411a66159040b7fff30d0097dbe4', NULL, NULL),
(9, 'francuzzo', '189bbbb00c5f1fb7fba9ad9285f193d1', 1, NULL),
(10, 'fweffw', '9a70adefdd1226b08e2785798ca2b521', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classi`
--

CREATE TABLE IF NOT EXISTS `classi` (
  `idClassi` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `NStudenti` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classi`
--

INSERT INTO `classi` (`idClassi`, `Nome`, `NStudenti`) VALUES
(1, '5I1', 25),
(2, '5I2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `classi_prof`
--

CREATE TABLE IF NOT EXISTS `classi_prof` (
  `idClasse` int(11) DEFAULT NULL,
  `idProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entrate_posticipate`
--

CREATE TABLE IF NOT EXISTS `entrate_posticipate` (
  `id` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `idclasse` int(11) NOT NULL,
  `in_ora` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entrate_posticipate`
--

INSERT INTO `entrate_posticipate` (`id`, `giorno`, `idclasse`, `in_ora`) VALUES
(1, '2018-06-11', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `in_ora` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`id`, `tipo`, `in_ora`) VALUES
(1, 'assenza', NULL),
(2, 'ritardo', 2),
(3, 'ritardo', 3),
(4, 'breve', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `idmateria` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `motivazioni`
--

CREATE TABLE IF NOT EXISTS `motivazioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motivazioni`
--

INSERT INTO `motivazioni` (`id`, `nome`) VALUES
(1, 'famiglia'),
(2, 'salute');

-- --------------------------------------------------------

--
-- Table structure for table `presenze`
--

CREATE TABLE IF NOT EXISTS `presenze` (
  `id` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `id_studente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presenze`
--

INSERT INTO `presenze` (`id`, `giorno`, `id_studente`) VALUES
(14, '2018-06-05', 1),
(15, '2018-06-05', 3),
(16, '2018-06-05', 6),
(17, '2018-06-05', 7),
(18, '2018-06-05', 9),
(19, '2018-06-05', 10),
(20, '2018-06-05', 15),
(21, '2018-06-05', 11),
(22, '2018-06-05', 13),
(23, '2018-06-10', 13),
(24, '2018-06-11', 13),
(25, '2018-06-11', 12),
(26, '2018-06-11', 1),
(27, '2018-06-11', 2),
(28, '2018-06-11', 3),
(29, '2018-06-11', 4),
(30, '2018-06-11', 5),
(31, '2018-06-11', 6),
(32, '2018-06-11', 7),
(37, '2018-06-11', 8);

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

CREATE TABLE IF NOT EXISTS `prof` (
  `idprof` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Cognome` varchar(45) NOT NULL,
  `DataDiNascita` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prof`
--

INSERT INTO `prof` (`idprof`, `Nome`, `Cognome`, `DataDiNascita`) VALUES
(1, 'franco', 'franzi', '1999-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `prof_materia`
--

CREATE TABLE IF NOT EXISTS `prof_materia` (
  `idProf` int(11) DEFAULT NULL,
  `idMateria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stev`
--

CREATE TABLE IF NOT EXISTS `stev` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_studente` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `giustificato` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stev`
--

INSERT INTO `stev` (`id`, `id_evento`, `id_studente`, `giorno`, `giustificato`) VALUES
(1, 4, 11, '2018-06-05', 0),
(2, 2, 13, '2018-06-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

CREATE TABLE IF NOT EXISTS `studenti` (
  `idstudenti` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Cognome` varchar(45) NOT NULL,
  `DataDiNascita` date NOT NULL,
  `idClasse` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studenti`
--

INSERT INTO `studenti` (`idstudenti`, `Nome`, `Cognome`, `DataDiNascita`, `idClasse`) VALUES
(1, 'Luqman', 'Asghar', '1999-02-25', 1),
(2, 'Davide', 'Marchiori', '1999-04-02', 1),
(3, 'Andy', 'Valdivieso', '1999-05-23', 2),
(4, 'Fabio', 'Sampietro', '1998-02-24', 1),
(5, 'Gioele', 'Venenri', '1999-02-24', 1),
(6, 'Julian', 'Olivato', '1999-05-01', 1),
(7, 'Patrick', 'Frigati', '1999-07-03', 1),
(8, 'Napoli', 'Daniele', '1999-08-28', 1),
(9, 'Luca', 'Valendini', '1999-04-30', 1),
(10, 'Tommano', 'Maria Gatti', '1999-02-18', 1),
(11, 'Matteo', 'Impagnatiello', '1999-07-06', 1),
(12, 'Matteo', 'Oleoni', '1997-02-12', 1),
(13, 'Lorenzo ', 'Spinnato', '2000-08-23', 1),
(14, 'Andrea', 'Berzi', '2001-11-09', 1),
(15, 'Alessandro', 'Mori', '2000-12-25', 1),
(16, 'Fabio', 'Galli', '1988-06-16', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `idprof_idx` (`idprof`);

--
-- Indexes for table `classi`
--
ALTER TABLE `classi`
  ADD PRIMARY KEY (`idClassi`),
  ADD UNIQUE KEY `idClassi_UNIQUE` (`idClassi`);

--
-- Indexes for table `classi_prof`
--
ALTER TABLE `classi_prof`
  ADD KEY `idClasse_idx` (`idClasse`),
  ADD KEY `idProf_idx` (`idProf`);

--
-- Indexes for table `entrate_posticipate`
--
ALTER TABLE `entrate_posticipate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idclasse` (`idclasse`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`),
  ADD UNIQUE KEY `idmateria_UNIQUE` (`idmateria`);

--
-- Indexes for table `motivazioni`
--
ALTER TABLE `motivazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presenze`
--
ALTER TABLE `presenze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_studente` (`id_studente`);

--
-- Indexes for table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`idprof`),
  ADD UNIQUE KEY `idprof_UNIQUE` (`idprof`);

--
-- Indexes for table `prof_materia`
--
ALTER TABLE `prof_materia`
  ADD KEY `idProf_idx` (`idProf`),
  ADD KEY `idMateria_idx` (`idMateria`);

--
-- Indexes for table `stev`
--
ALTER TABLE `stev`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_studente` (`id_studente`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`idstudenti`),
  ADD UNIQUE KEY `idstudenti_UNIQUE` (`idstudenti`),
  ADD KEY `ideClasse_idx` (`idClasse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `classi`
--
ALTER TABLE `classi`
  MODIFY `idClassi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `entrate_posticipate`
--
ALTER TABLE `entrate_posticipate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `motivazioni`
--
ALTER TABLE `motivazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `presenze`
--
ALTER TABLE `presenze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `prof`
--
ALTER TABLE `prof`
  MODIFY `idprof` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stev`
--
ALTER TABLE `stev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studenti`
--
ALTER TABLE `studenti`
  MODIFY `idstudenti` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`idprof`) REFERENCES `prof` (`idprof`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`idprof`) REFERENCES `prof` (`idprof`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `classi_prof`
--
ALTER TABLE `classi_prof`
  ADD CONSTRAINT `idClasse` FOREIGN KEY (`idClasse`) REFERENCES `classi` (`idClassi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `idProf` FOREIGN KEY (`idProf`) REFERENCES `prof` (`idprof`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `entrate_posticipate`
--
ALTER TABLE `entrate_posticipate`
  ADD CONSTRAINT `entrate_posticipate_ibfk_1` FOREIGN KEY (`idclasse`) REFERENCES `classi` (`idClassi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presenze`
--
ALTER TABLE `presenze`
  ADD CONSTRAINT `presenze_ibfk_1` FOREIGN KEY (`id_studente`) REFERENCES `studenti` (`idstudenti`);

--
-- Constraints for table `prof_materia`
--
ALTER TABLE `prof_materia`
  ADD CONSTRAINT `ideMateria` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idmateria`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ideProf` FOREIGN KEY (`idProf`) REFERENCES `prof` (`idprof`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `stev`
--
ALTER TABLE `stev`
  ADD CONSTRAINT `stev_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stev_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stev_ibfk_3` FOREIGN KEY (`id_studente`) REFERENCES `studenti` (`idstudenti`) ON UPDATE CASCADE;

--
-- Constraints for table `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `ideClasse` FOREIGN KEY (`idClasse`) REFERENCES `classi` (`idClassi`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
