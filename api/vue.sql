-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2022 at 09:58 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vue`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ID` int(11) NOT NULL,
  `intitule` text NOT NULL,
  `abr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ID`, `intitule`, `abr`) VALUES
(82, 'ddddd', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `ID` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `CIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`ID`, `nom`, `prenom`, `CIN`) VALUES
(3, 'chlendia', 'mohamed', 222),
(4, 'sdasd', 'mohamed', 222),
(5, 'sdasd', 'qscqsc', 222),
(6, 'asdasd', 'qscqsc', 222);

-- --------------------------------------------------------

--
-- Table structure for table `etudient`
--

CREATE TABLE `etudient` (
  `ID` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `CIN` int(8) NOT NULL,
  `class` int(11) DEFAULT NULL,
  `numIns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudient`
--

INSERT INTO `etudient` (`ID`, `nom`, `prenom`, `CIN`, `class`, `numIns`) VALUES
(1, 'charrads', 'mohamed youssef', 12345678, 2, 12345674),
(3, 'charrad', 'raed', 12345678, 1, 1234567),
(19, 'a', '98', 54, 21, 321788);

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `ID` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `idProf` int(11) DEFAULT NULL,
  `intitule` text NOT NULL,
  `coefficient` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`ID`, `idMatiere`, `idProf`, `intitule`, `coefficient`) VALUES
(1, 1, 1, 'ds', 2),
(2, 1, NULL, 'ds', 2),
(5, 45, 3, '3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `ID` int(11) NOT NULL,
  `intitule` text NOT NULL,
  `coefficient` float NOT NULL,
  `idProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`ID`, `intitule`, `coefficient`, `idProf`) VALUES
(1, 'POOs', 12, 2),
(3, 'java', 3, 2),
(5, 'php', 2.3, 27),
(8, 'a', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `etudient`
--
ALTER TABLE `etudient`
  ADD PRIMARY KEY (`ID`,`numIns`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `etudient`
--
ALTER TABLE `etudient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;