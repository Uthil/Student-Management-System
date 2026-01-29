-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 05:04 PM
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
-- Database: `antoniou_137979`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Course_id` varchar(50) NOT NULL,
  `Course_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Course_id`, `Course_title`) VALUES
('ΠΛΣ50', '-Βασικές εξειδικεύσεις σε θεωρία και λογισμικό'),
('ΠΛΣ51', '-Βασικές εξειδικεύσεις σε Αρχιτεκτονική και Δίκτυα των Υπολογιστών'),
('ΠΛΣ60', '-Εξειδικεύσεις Τεχνολογίας Λογισμικού'),
('ΠΛΣ61', '-Σχεδιασμός και Διαχείριση Λογισμικού');

-- --------------------------------------------------------

--
-- Table structure for table `ekfonisiergasias`
--

CREATE TABLE `ekfonisiergasias` (
  `Essay_id` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Ekfonisi` text DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `Course_id` varchar(30) NOT NULL,
  `Userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekfonisiergasias`
--

INSERT INTO `ekfonisiergasias` (`Essay_id`, `Title`, `Ekfonisi`, `file`, `Course_id`, `Userid`) VALUES
(8, 'Εργασία 1', 'Στην εργασία αυτή θα εξασκηθείτε σε μερικές από τις απαραίτητες γνώσεις της γλώσσας προγραμματισμού Java. \r\n\r\nΠλήρης περιγραφή: \r\nΕιδικότερα, θα ασχοληθείτε με τύπους και μεταβλητές, τελεστές, εκφράσεις, είσοδο από το πληκτρολόγιο και έξοδο στην οθόνη, εντολές ελέγχου ροής και ανακύκλωσης, μονοδιάστατους πίνακες, ορισμό κλάσεων, μεθόδους και πέρασμα παραμέτρων, κατασκευαστές και αντικείμενα, και μαθηματικές συναρτήσεις.', 'ergasia.pdf', 'ΠΛΣ50', 5),
(9, 'Εργασία 2', 'Το μάθημα παρουσιάζει τις βασικές αρχές και τεχνικές των αλγορίθμων, και δομών δεδομένων, με έμφαση σε πραγματικά προβλήματα.\r\n\r\nΠλήρης περιγραφή: \r\nΣτην εργασία αυτή θα ασχοληθείτε με στοίβες-ουρές τόσο με πίνακα όσο και με συνδεδεμένη δομή, αλγορίθμους ταξινόμησης, ανάλυση αλγορίθμων και πολυπλοκότητα και, τέλος, σωρούς.', 'ergasia.pdf', 'ΠΛΣ50', 5),
(10, 'Εργασία 1', 'Το μάθημα παρουσιάζει τη δυαδική λογική, τις βασικές ­μεθόδους και διαδικασίες σχεδίασης ψηφιακών κυκλωμάτων καθώς και με τα βασικά χαρακτηριστικά και οργάνωση των δομικών μονάδων ενός Υπολογιστικού Συστήματος.\r\n\r\nΠλήρης περιγραφή: \r\nΕιδικότερα, θα ασχοληθείτε με τα αριθμητικά Συστήματα, Κώδικες Αναπαράστασης δεδομένων, Άλγεβρα Boole, και σχεδίαση συνδυαστικών κυκλωμάτων με λογικές πύλες.', 'ergasia.pdf', 'ΠΛΣ51', 7);

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE `teaching` (
  `Userid` int(11) NOT NULL,
  `Course_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `Userid` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Profession` varchar(100) DEFAULT NULL,
  `Linkedin` varchar(50) DEFAULT NULL,
  `Facebook` varchar(50) DEFAULT NULL,
  `YouTube` varchar(50) DEFAULT NULL,
  `Instagram` varchar(50) DEFAULT NULL,
  `Twitter` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`Userid`, `Name`, `Profession`, `Linkedin`, `Facebook`, `YouTube`, `Instagram`, `Twitter`) VALUES
(1, 'Νικος Μαθιουδακης', 'Φοιτητης', '', 'facebook', '', 'Instagram', ''),
(2, 'Γιώργος Αντωνίου', 'Ιδ.Υπάλληλος', '', 'facebook', 'YouTube', '', 'Twitter/X');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Userid` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Καθηγητής','Φοιτητής') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Userid`, `Email`, `Username`, `Password`, `Role`) VALUES
(1, 'std_user1@mail.com', 'std_user1', '$2y$10$4T9uscJkESsyw4bYcuu/huFhvJt6EBtK/yR491K3HjU3nLzqBANcu', 'Φοιτητής'),
(2, 'std_user2@mail.com', 'std_user2', '$2y$10$Brry9TIxzVvph/tSpGDOv.Lp8fm5OviLwlamSASEUzBoSFicuJH/y', 'Φοιτητής'),
(3, 'std_user3@mail.com', 'std_user3', '$2y$10$7uQN6GwLDD6/F5hCy5.kAukUkjvwZMqEx/mlRIZDX1YbitTsEKKfO', 'Φοιτητής'),
(5, 'tch_user1@mail.com', 'tch_user1', '$2y$10$MbFByknPWeY8Qek9W7aIROQdBrLokmwLD5JAxOJstoB8vzsnUmycO', 'Καθηγητής'),
(6, 'tch_user2@mail.com', 'tch_user2', '$2y$10$O84kvYsV7X77/Z7zEYTkoenVp9t2.5Di8v3AcFYgeE15Asm8bAB6a', 'Καθηγητής'),
(7, 'tch_user3@mail.com', 'tch_user3', '$2y$10$XEl9caYNyQTRx9cETKOt8.g48Jp7TLpXdi6P1E4YVGVSvUW9DscJ.', 'Καθηγητής');

-- --------------------------------------------------------

--
-- Table structure for table `ypovlithisaergasia`
--

CREATE TABLE `ypovlithisaergasia` (
  `Submission_id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `file` varchar(100) NOT NULL,
  `xronosimansi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Essay_id` int(11) NOT NULL,
  `Userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ypovlithisaergasia`
--

INSERT INTO `ypovlithisaergasia` (`Submission_id`, `Title`, `Description`, `file`, `xronosimansi`, `Essay_id`, `Userid`) VALUES
(5, '1η Γραπτή Εργασία ΠΛΣ 50', 'Θέμα 1: Λογαριασμός κινητής τηλεφωνίας\r\nΝα γράψετε πρόγραμμα Java που θα αποτελείται από μία κλάση με όνομα Mobile. Το πρόγραμμά σας:\r\n•Θα ζητά από τον χρήστη να εισάγει από το πληκτρολόγιο τον τετραψήφιο κωδικό πελάτη, τον χρό', 'std_user1.docx', '2025-06-03 14:23:13', 8, 1),
(6, '1η Γραπτή Εργασία ΠΛΣ 51', 'ΑΣΚΗΣΗ 1 \r\n\r\nΔίνονται οι αριθμοί: \r\nΝα αναπαραστήσετε τον x στο δυαδικό σύστημα, χρησιμοποιώντας για το μεν ακέραιο μέρος τα ελάχιστα δυαδικά ψηφία, για το δε κλασματικό 2 δυαδικά ψηφία. ii)  Να αναπαραστήσετε τον y στο δυαδικό και στο δεκαεξαδικό σύστημα', 'std_user1.docx', '2025-06-02 16:26:00', 10, 1),
(7, '1η Γραπτή Εργασία ΠΛΣ 50', 'Θέμα 1: Λογαριασμός κινητής τηλεφωνίας\r\nΝα γράψετε πρόγραμμα Java που θα αποτελείται από μία κλάση με όνομα Mobile. Το πρόγραμμά σας:\r\n•Θα ζητά από τον χρήστη να εισάγει από το πληκτρολόγιο τον τετραψήφιο κωδικό πελάτη, τον χρό', 'std_user2.docx', '2025-06-03 14:23:08', 8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Course_id`);

--
-- Indexes for table `ekfonisiergasias`
--
ALTER TABLE `ekfonisiergasias`
  ADD PRIMARY KEY (`Essay_id`),
  ADD KEY `Course_id` (`Course_id`),
  ADD KEY `Userid` (`Userid`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`Userid`,`Course_id`),
  ADD KEY `Course_id` (`Course_id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `ypovlithisaergasia`
--
ALTER TABLE `ypovlithisaergasia`
  ADD PRIMARY KEY (`Submission_id`),
  ADD KEY `Essay_id` (`Essay_id`),
  ADD KEY `Userid` (`Userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekfonisiergasias`
--
ALTER TABLE `ekfonisiergasias`
  MODIFY `Essay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ypovlithisaergasia`
--
ALTER TABLE `ypovlithisaergasia`
  MODIFY `Submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ekfonisiergasias`
--
ALTER TABLE `ekfonisiergasias`
  ADD CONSTRAINT `ekfonisiergasias_ibfk_1` FOREIGN KEY (`Course_id`) REFERENCES `courses` (`Course_id`),
  ADD CONSTRAINT `ekfonisiergasias_ibfk_2` FOREIGN KEY (`Userid`) REFERENCES `users` (`Userid`);

--
-- Constraints for table `teaching`
--
ALTER TABLE `teaching`
  ADD CONSTRAINT `teaching_ibfk_1` FOREIGN KEY (`Userid`) REFERENCES `users` (`Userid`),
  ADD CONSTRAINT `teaching_ibfk_2` FOREIGN KEY (`Course_id`) REFERENCES `courses` (`Course_id`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`Userid`) REFERENCES `users` (`Userid`);

--
-- Constraints for table `ypovlithisaergasia`
--
ALTER TABLE `ypovlithisaergasia`
  ADD CONSTRAINT `ypovlithisaergasia_ibfk_1` FOREIGN KEY (`Essay_id`) REFERENCES `ekfonisiergasias` (`Essay_id`),
  ADD CONSTRAINT `ypovlithisaergasia_ibfk_2` FOREIGN KEY (`Userid`) REFERENCES `users` (`Userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
