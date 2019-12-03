-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 01:57 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_adoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `Pet_id` int(11) DEFAULT NULL,
  `Breed` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `critter`
--

CREATE TABLE `critter` (
  `Pet_id` int(11) DEFAULT NULL,
  `Species` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `Pet_id` int(11) DEFAULT NULL,
  `Breed` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donate_to`
--

CREATE TABLE `donate_to` (
  `ID` int(11) DEFAULT NULL,
  `Snum` int(11) DEFAULT NULL,
  `Donation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `Pet_id` int(11) DEFAULT NULL,
  `Conditions` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `ID` int(11) NOT NULL,
  `Fname` varchar(65) NOT NULL,
  `Lname` varchar(65) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `Country` varchar(65) NOT NULL,
  `State` varchar(65) NOT NULL,
  `City` varchar(65) NOT NULL,
  `Address` varchar(65) NOT NULL,
  `Bdate` date NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`ID`, `Fname`, `Lname`, `Sex`, `Country`, `State`, `City`, `Address`, `Bdate`, `Phone`, `Email`) VALUES
(0, '', '', '', '', '', '', '', '0000-00-00', '', ''),
(12345678, 'Van', 'Darkholme', 'M', 'Cum Cave', '', '', '', '2019-11-13', '492-1231231', 'van@hotmail.com'),
(34280270, 'tranny', 'mcfatty', 'O', '', '', '', '', '0000-00-00', '', ''),
(74246654, 'hoe', 'bitch', 'F', '', '', '', '', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `Pet_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `Age` int(11) NOT NULL,
  `Appearance` varchar(100) NOT NULL,
  `Ready_to_adopt` varchar(1) NOT NULL,
  `Adopt_date` int(11) NOT NULL,
  `Donor_id` int(11) DEFAULT NULL,
  `Shelter_num` int(11) DEFAULT NULL,
  `Owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_id`, `Name`, `Sex`, `Age`, `Appearance`, `Ready_to_adopt`, `Adopt_date`, `Donor_id`, `Shelter_num`, `Owner_id`) VALUES
(321, 'Chris', 'M', 2, 'lol', 'T', 2018, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pet_donor`
--

CREATE TABLE `pet_donor` (
  `ID` int(11) DEFAULT NULL,
  `Reason` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pet_owner`
--

CREATE TABLE `pet_owner` (
  `ID` int(11) DEFAULT NULL,
  `Pet_num` int(11) DEFAULT NULL,
  `Pet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `previous_owner`
--

CREATE TABLE `previous_owner` (
  `Pet_id` int(11) DEFAULT NULL,
  `Owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `ID` int(11) DEFAULT NULL,
  `Pet_id` int(11) DEFAULT NULL,
  `Reserve_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `Snum` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Country` varchar(65) NOT NULL,
  `State` varchar(65) NOT NULL,
  `City` varchar(65) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `ID` int(11) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `ID` int(11) DEFAULT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `takes_care_of`
--

CREATE TABLE `takes_care_of` (
  `ID` int(11) DEFAULT NULL,
  `Pet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `ID` int(11) DEFAULT NULL,
  `StartDate` date NOT NULL,
  `Super_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_at`
--

CREATE TABLE `volunteer_at` (
  `ID` int(11) DEFAULT NULL,
  `Snum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD KEY `CAT_ID` (`Pet_id`);

--
-- Indexes for table `critter`
--
ALTER TABLE `critter`
  ADD KEY `CRITTER_ID` (`Pet_id`);

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD KEY `DOG_ID` (`Pet_id`);

--
-- Indexes for table `donate_to`
--
ALTER TABLE `donate_to`
  ADD KEY `DONATE_TO_ID` (`ID`),
  ADD KEY `DONATE_TO_SNUM` (`Snum`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD KEY `MEDICAL_PET_ID` (`Pet_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_id`),
  ADD UNIQUE KEY `Pet_id` (`Pet_id`),
  ADD KEY `PET_DONOR_ID` (`Donor_id`),
  ADD KEY `PET_SHELTER_NUM` (`Shelter_num`),
  ADD KEY `PET_OWNER_ID` (`Owner_id`);

--
-- Indexes for table `pet_donor`
--
ALTER TABLE `pet_donor`
  ADD KEY `DONOR_ID` (`ID`);

--
-- Indexes for table `pet_owner`
--
ALTER TABLE `pet_owner`
  ADD KEY `OWNER_ID` (`ID`),
  ADD KEY `OWNER_PET_ID` (`Pet_id`);

--
-- Indexes for table `previous_owner`
--
ALTER TABLE `previous_owner`
  ADD KEY `PREVIOUS_OWNER_ID` (`Owner_id`),
  ADD KEY `PREVIOUS_OWNER_PET_ID` (`Pet_id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD KEY `RESERVE_ID` (`ID`),
  ADD KEY `RESERVE_PET_ID` (`Pet_id`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`Snum`),
  ADD UNIQUE KEY `Snum` (`Snum`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD KEY `SPECIALIZATION_ID` (`ID`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD KEY `SUPERVISOR_ID` (`ID`);

--
-- Indexes for table `takes_care_of`
--
ALTER TABLE `takes_care_of`
  ADD KEY `TAKES_CARE_OF_ID` (`ID`),
  ADD KEY `TAKES_CARE_OF_PET_ID` (`Pet_id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD KEY `VOLUNTEER_ID` (`ID`),
  ADD KEY `SUPER_ID` (`Super_id`);

--
-- Indexes for table `volunteer_at`
--
ALTER TABLE `volunteer_at`
  ADD KEY `VOLUNTEER_AT_ID` (`ID`),
  ADD KEY `VOLUNTEER_AT_SNUM` (`Snum`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cat`
--
ALTER TABLE `cat`
  ADD CONSTRAINT `CAT_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `critter`
--
ALTER TABLE `critter`
  ADD CONSTRAINT `CRITTER_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dog`
--
ALTER TABLE `dog`
  ADD CONSTRAINT `DOG_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `donate_to`
--
ALTER TABLE `donate_to`
  ADD CONSTRAINT `DONATE_TO_ID` FOREIGN KEY (`ID`) REFERENCES `pet_donor` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `DONATE_TO_SNUM` FOREIGN KEY (`Snum`) REFERENCES `shelter` (`Snum`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `MEDICAL_PET_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `PET_DONOR_ID` FOREIGN KEY (`Donor_id`) REFERENCES `pet_donor` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `PET_OWNER_ID` FOREIGN KEY (`Owner_id`) REFERENCES `pet_owner` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `PET_SHELTER_NUM` FOREIGN KEY (`Shelter_num`) REFERENCES `shelter` (`Snum`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pet_donor`
--
ALTER TABLE `pet_donor`
  ADD CONSTRAINT `DONOR_ID` FOREIGN KEY (`ID`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pet_owner`
--
ALTER TABLE `pet_owner`
  ADD CONSTRAINT `OWNER_ID` FOREIGN KEY (`ID`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `OWNER_PET_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `previous_owner`
--
ALTER TABLE `previous_owner`
  ADD CONSTRAINT `PREVIOUS_OWNER_ID` FOREIGN KEY (`Owner_id`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `PREVIOUS_OWNER_PET_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `RESERVE_ID` FOREIGN KEY (`ID`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `RESERVE_PET_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `SPECIALIZATION_ID` FOREIGN KEY (`ID`) REFERENCES `volunteer` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `SUPERVISOR_ID` FOREIGN KEY (`ID`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `takes_care_of`
--
ALTER TABLE `takes_care_of`
  ADD CONSTRAINT `TAKES_CARE_OF_ID` FOREIGN KEY (`ID`) REFERENCES `volunteer` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `TAKES_CARE_OF_PET_ID` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `SUPER_ID` FOREIGN KEY (`Super_id`) REFERENCES `supervisor` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `VOLUNTEER_ID` FOREIGN KEY (`ID`) REFERENCES `person` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `volunteer_at`
--
ALTER TABLE `volunteer_at`
  ADD CONSTRAINT `VOLUNTEER_AT_ID` FOREIGN KEY (`ID`) REFERENCES `volunteer` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `VOLUNTEER_AT_SNUM` FOREIGN KEY (`Snum`) REFERENCES `shelter` (`Snum`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
