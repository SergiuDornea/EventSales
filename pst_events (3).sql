-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 05:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pst_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ID` int(11) NOT NULL,
  `ID_SPEAKER` int(11) NOT NULL,
  `ID_EVENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID`, `ID_SPEAKER`, `ID_EVENT`) VALUES
(5, 4, 17),
(6, 3, 18),
(7, 6, 18),
(8, 7, 19),
(9, 8, 20),
(10, 9, 20),
(11, 5, 20),
(13, 11, 21),
(14, 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE `cos` (
  `ID` int(11) NOT NULL,
  `ID_TICKET` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `titlu` varchar(50) NOT NULL,
  `descriere` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `contact` varchar(50) NOT NULL,
  `ID_PARTENER` int(11) NOT NULL,
  `ID_SPONSOR` int(11) NOT NULL,
  `locatie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `titlu`, `descriere`, `date`, `contact`, `ID_PARTENER`, `ID_SPONSOR`, `locatie`) VALUES
(17, 'Navigating Chaos: Jordan Peterson&#039;s Insightfu', 'Join us for a transformative experience at the &quot;Navigating Chaos&quot; conference featuring the acclaimed speaker, Dr. Jordan Peterson. In this engaging event, Dr. Peterson will delve into the in', '2023-11-24 22:33:00', 'admin@gmail.com', 2, 5, 'Budatpest HU'),
(18, 'Wealth, Wisdom, and Wellness: A Dynamic Conversati', ' Prepare for an extraordinary event as two influential figures, Joe Rogan and Robert Kiyosaki, come together for an enlightening conference on &quot;Wealth, Wisdom, and Wellness.&quot; Join us for a d', '2023-11-30 19:34:00', 'admin@gmail.com', 4, 4, 'Cluj-Napoca RO'),
(19, 'Financial Freedom: A Masterclass with Dave Ramsey', 'Immerse yourself in an exclusive masterclass with the financial guru, Dave Ramsey, at the &quot;Financial Freedom&quot; conference. Join us for a day of empowering discussions and practical insights t', '2023-11-28 22:00:00', 'admin@gmail.com', 8, 5, 'Los Angeles US'),
(20, 'Empower, Lead, Succeed: A Confluence of Wisdom wit', 'Brace yourself for a unique gathering of visionaries at the &quot;Empower, Lead, Succeed&quot; conference, featuring the dynamic trio of Barbara Corcoran, Leslie Maxie, and Traian Băsescu. Join us for', '2023-12-01 20:00:00', 'admin@gmail.com', 7, 10, 'Bucharest RO'),
(21, 'Radical Resilience: Unleashing Potential with Tara', 'Prepare for an immersive experience at the &quot;Radical Resilience&quot; conference, featuring the insightful and empowering Tara Schuster. Join us for a day of transformative discussions and practic', '2023-12-06 22:30:00', 'admin@gmail.com', 8, 11, 'London UK'),
(22, 'Unfiltered Wisdom: A Day with Joe Rogan', 'Get ready for an unfiltered and unparalleled experience at the &quot;Unfiltered Wisdom&quot; conference, featuring the one and only Joe Rogan. Join us for a day of candid conversations, thought-provok', '2023-12-09 17:46:00', 'admin@gmail.com', 7, 8, 'Berlin DE');

-- --------------------------------------------------------

--
-- Table structure for table `parteneri`
--

CREATE TABLE `parteneri` (
  `ID` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parteneri`
--

INSERT INTO `parteneri` (`ID`, `nume`) VALUES
(2, 'Michael Adams'),
(3, 'Jeremy'),
(4, 'Maria Gonzalez'),
(5, 'Frederic III'),
(6, 'Serena Jefferson'),
(7, 'Williams Rafael'),
(8, 'Charles JR.');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `date` datetime NOT NULL,
  `ID_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `amount`, `date`, `ID_USER`) VALUES
(3, 100.00, '2023-11-17 17:19:00', 16),
(4, 55.00, '2023-11-13 17:20:00', 17),
(5, 142.00, '2023-11-15 17:21:00', 18),
(6, 200.00, '2023-10-31 17:21:00', 17),
(7, 80.00, '2023-11-01 17:21:00', 16);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `ID` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `descriere` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`ID`, `nume`, `prenume`, `descriere`) VALUES
(3, 'Joe ', 'Rogan', 'Stand up comic, mixed martial arts fanatic, psychedelic adventurer, host of The Joe Rogan Experience podcast'),
(4, 'Jordan', 'Peterson', 'Jordan Bernt Peterson (born 12 June 1962) is a Canadian psychologist, author, and media commentator'),
(5, 'Traian', 'Basescu', 'Traian Băsescu is a Romanian conservative politician who served as President of Romania from 2004 to 2014.'),
(6, 'Robert', 'Kiyosaki', 'Robert Toru Kiyosaki (born April 8, 1947) is a Japanese-American entrepreneur, businessman and author.[1] Kiyosaki is the founder of Rich Global LLC and the Rich Dad Company, a private financial educa'),
(7, 'Dave ', 'Ramsey', 'David Ramsey is an American financial author, radio host, television personality, and motivational speaker'),
(8, 'Barbara ', 'Corcoran', 'Barbara Ann Corcoran (born March 10, 1949) is an American businesswoman, investor, syndicated columnist, and television personality.'),
(9, 'Leslie ', 'Maxie', 'Leslie Maxie (born January 4, 1967, in San Francisco, California) is a retired American track and field athlete and subsequently a television broadcast journalist.'),
(11, 'Tara ', 'Schuster', 'Tara Schuster, author and executive at Comedy Central, explores the world through travel and self-care.');

-- --------------------------------------------------------

--
-- Table structure for table `sponsori`
--

CREATE TABLE `sponsori` (
  `ID` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsori`
--

INSERT INTO `sponsori` (`ID`, `nume`) VALUES
(2, 'Rolex'),
(3, 'Mercedes'),
(4, 'Samsung'),
(5, 'Master Card'),
(6, 'Coca Cola'),
(7, 'Starbucks'),
(8, 'Quatar Airways'),
(9, 'Chase'),
(10, 'Hilton'),
(11, 'Subway');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_PAYMENT` int(11) NOT NULL,
  `ID_EVENT` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `nume`, `isAdmin`) VALUES
(13, 'admin', '$2y$10$wOYm3GctkPkeUs97al8s7uOVwN1POlw7TocBxM7T6sS73QCEtC2g2', 'admin@gmail.com', '', 1),
(16, 'sergiu', '$2y$10$EJ32.9KBKxetwhDk.BI15upMnr/sKS27yUgnynvq.RzNiScjnLATa', 'sergiu@gmail.com', '', 0),
(17, 'tudor', '$2y$10$37q/qJWph1sNOTvs5Z5Oxurpzdj.oybnveLLLNUFUFnKUvAAOHmdy', 'tudor@gmail.com', '', 0),
(18, 'paul', '$2y$10$XzhszAs.BC9iH.M59KC6bepV0OBEKz0a9jDU1WpuAWq5AWraRCax.', 'paul@gmail.com', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SPEAKER` (`ID_SPEAKER`),
  ADD KEY `ID_EVENT` (`ID_EVENT`);

--
-- Indexes for table `cos`
--
ALTER TABLE `cos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_TICKET` (`ID_TICKET`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PARTENER` (`ID_PARTENER`),
  ADD KEY `ID_SPONSOR` (`ID_SPONSOR`);

--
-- Indexes for table `parteneri`
--
ALTER TABLE `parteneri`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sponsori`
--
ALTER TABLE `sponsori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_PAYMENT` (`ID_PAYMENT`),
  ADD KEY `fk_tickets_id_event` (`ID_EVENT`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cos`
--
ALTER TABLE `cos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parteneri`
--
ALTER TABLE `parteneri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sponsori`
--
ALTER TABLE `sponsori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`ID_SPEAKER`) REFERENCES `speakers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ID_EVENT`) REFERENCES `events` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cos`
--
ALTER TABLE `cos`
  ADD CONSTRAINT `cos_ibfk_1` FOREIGN KEY (`ID_TICKET`) REFERENCES `tickets` (`ID`),
  ADD CONSTRAINT `cos_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`ID_PARTENER`) REFERENCES `parteneri` (`ID`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`ID_SPONSOR`) REFERENCES `sponsori` (`ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_id_event` FOREIGN KEY (`ID_EVENT`) REFERENCES `events` (`ID`),
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`ID_PAYMENT`) REFERENCES `payments` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
