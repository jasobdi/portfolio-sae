-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 08. Jan 2025 um 15:53
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
-- Tabellenstruktur für Tabelle `about`
--

CREATE TABLE `about` (
`ID` int NOT NULL,
`title` text NOT NULL,
`intro_1` text NOT NULL,
`desc_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`image_1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`intro_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`desc_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`image_2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `about`
--

INSERT INTO `about` (`ID`, `title`, `intro_1`, `desc_1`, `image_1`, `intro_2`, `desc_2`, `image_2`) VALUES
(1, 'About', 'Ich bin Janice.  Zurzeit absolviere ich meine Ausbildung im Bereich Webdesign und -Development am SAE Institut in Zürich. Nebenbei arbeite ich am Empfang eines internationalen Software-Unternehmens. Design, Programmieren und IT interessieren mich schon eine Weile, durch die SAE habe ich die Möglichkeit meine Interessen zum Beruf zu machen.', 'Junge Frau mit geraden blonden Haaren und Brille lächelt in einem Bewerbungsfoto', 'janice_bader_296w_2025-01-08-154544.png', 'In meiner Freizeit male und zeichne ich gerne, ausserdem spiele ich Unihockey und bewege mich viel im Ausgleich zum Alltag vor dem Bildschirm.', 'Junge Frau mit lockigen Haaren und Hut schaut auf die Seite', 'janice_black_white_296w_2025-01-08-154544.png');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `about`
--
ALTER TABLE `about`
ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `about`
--
ALTER TABLE `about`
MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
