-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 12. Jan 2025 um 17:43
-- Server-Version: 8.0.35
-- PHP-Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `portfolio_jb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

CREATE TABLE `project` (
    `ID` int NOT NULL,
    `filepath` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `title` text NOT NULL,
    `description` varchar(150) NOT NULL,
    `created_by` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`ID`, `filepath`, `title`, `description`, `created_by`, `created_at`) VALUES
(17, 'image_slider_500w_2025-01-08-193901.png', 'Image Slider', 'Image Slider mit Start/Pause-Button und Pfeilen nach rechts und links mit Javascript', 'Janice', '2025-01-08 20:39:01'),
(19, 'portfolio_webseite_500w_2025-01-08-194131.png', 'Portfolio Webseite', 'Umsetzung meiner eigenen Webseite mit HTML & CSS', 'Janice', '2025-01-08 20:41:31'),
(21, 'screendesign_500w_2025-01-08-194525.png', 'Screendesign', 'Entwicklung von allen Screendesigns für diese Webseite', 'Janice', '2025-01-08 20:45:25'),
(22, 'redbull_redesign_logo_500w_2025-01-11-130423.png', 'Redesign Redbull Logo', 'Neues Design des Redbull Logos sowie erstellen einer Special Edition inkl. Dosen-Mockup in einer Gruppenarbeit', 'Admin', '2025-01-11 14:04:23'),
(23, 'alpenblick_logo_500w_2025-01-11-130536.png', 'Café Alpenblick', 'Erstellen eines Logos, Flyer und Instagram-Post-Mockups für das fiktive Café Alpenblick in einer Partnerarbeit', 'Admin', '2025-01-11 14:05:36'),
(24, 'logo_jb_500w_2025-01-11-130628.png', 'Logo Janice Bader', 'Prozess und Entwicklung meines eigenen Logos', 'Janice', '2025-01-11 14:06:28');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `project`
--
ALTER TABLE `project`
    DD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `project`
--
ALTER TABLE `project`
    MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
