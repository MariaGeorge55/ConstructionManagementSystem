-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 08:10 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountype`
--

CREATE TABLE `accountype` (
  `acctype` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `pagename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountype`
--

INSERT INTO `accountype` (`acctype`, `page`, `pagename`) VALUES
('Admin', 'Admin.php', 'View Employees'),
('Contract Manager', 'Contract.php', 'View Contracts'),
('Engineer', 'Engineer.php', 'View Invoices'),
('Technical Manager', 'techmanagerinvoices.html', 'Manage Invoices');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contractID` int(100) NOT NULL,
  `issuedate` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'ongoing',
  `downpayment` int(100) NOT NULL,
  `totalprice` int(100) NOT NULL,
  `retention` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `engID` varchar(100) NOT NULL,
  `clientname` varchar(100) NOT NULL,
  `taxfileno` varchar(100) NOT NULL,
  `creatorID` varchar(100) NOT NULL,
  `downpaymentpercentage` double(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contractID`, `issuedate`, `status`, `downpayment`, `totalprice`, `retention`, `duration`, `engID`, `clientname`, `taxfileno`, `creatorID`, `downpaymentpercentage`) VALUES
(1, '0000-00-00', 'Error', 4000, 25, '12', '176', 'zahwa', 'the square', '77654', 'zeyad', 16000),
(4, '2020-05-03', 'ongoing', 2000000, 30354150, '13', '1987', 'khazbakkkkk', 'square', '55447621', 'zahwa', 7),
(5, '2020-05-02', 'ongoing', 4000000, 9270144, '12', '1984', 'khazbakkkkk', 'mountain view', '556634', 'zahwa', 43),
(6, '2020-05-02', 'ongoing', 230, 6600, '14', '1984', 'khazbakkkkk', 'hydepark', '63323', 'zahwa', 3),
(7, '2020-05-02', 'ongoing', 2000, 22000, '12', '2020-05-20', 'khazbakkkkk', 'rehab', '65431', 'zahwa', 9),
(11, '2020-05-29', 'ongoing', 2000000, 5520000, '12', '1982', 'khazbakkkkk', 'october ', '76757656', 'zahwa', 36);

-- --------------------------------------------------------

--
-- Table structure for table `invoicedescriptionamount`
--

CREATE TABLE `invoicedescriptionamount` (
  `invoiceID` int(100) NOT NULL,
  `contractID` int(100) NOT NULL,
  `totalprice` int(100) NOT NULL,
  `issuedate` date NOT NULL,
  `totalvat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedescriptionamount`
--

INSERT INTO `invoicedescriptionamount` (`invoiceID`, `contractID`, `totalprice`, `issuedate`, `totalvat`) VALUES
(1, 4, 0, '2020-05-20', 0),
(2, 5, 0, '2020-05-20', 0),
(3, 4, 20, '0000-00-00', 5.8);

-- --------------------------------------------------------

--
-- Table structure for table `invoicedescriptionitems`
--

CREATE TABLE `invoicedescriptionitems` (
  `invoiceID` int(100) NOT NULL,
  `contractID` int(100) NOT NULL,
  `itemID` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `previousquantity` int(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'onhold'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedescriptionitems`
--

INSERT INTO `invoicedescriptionitems` (`invoiceID`, `contractID`, `itemID`, `quantity`, `previousquantity`, `date`, `status`) VALUES
(1, 4, 13, 60000, 0, '0000-00-00', 'onhold'),
(1, 4, 14, 2, 0, '0000-00-00', 'onhold'),
(2, 5, 15, 4, 0, '0000-00-00', 'onhold'),
(3, 4, 13, 4444, 6, '2020-06-13', 'onhold'),
(3, 4, 14, 3000, 60000, '2020-05-15', 'onhold');

-- --------------------------------------------------------

--
-- Table structure for table `invoicesummary`
--

CREATE TABLE `invoicesummary` (
  `summaryID` int(100) NOT NULL,
  `contractID` int(100) NOT NULL,
  `totalaprice` int(100) NOT NULL,
  `date` date NOT NULL,
  `VAT` int(100) NOT NULL,
  `previouslypaid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `contractID` int(100) NOT NULL,
  `itemID` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `vat` int(100) NOT NULL,
  `testing` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`contractID`, `itemID`, `name`, `quantity`, `price`, `unit`, `vat`, `testing`) VALUES
(1, 2, 'uuuuu', 1, 25, 'm', 44, 52),
(4, 13, 'rocks', 30084, 1000, 'meter squared', 12, 12),
(4, 14, 'iron 2cm', 5403, 50, 'meter', 12, 11),
(5, 15, 'pipes', 3000, 3090, 'meter squared', 11, 15),
(5, 16, 'dsa', 12, 12, '12', 12, 12),
(6, 17, 'paint ', 90, 50, 'meter', 30, 12),
(6, 18, 'pipes', 70, 30, 'meter squared', 12, 12),
(7, 19, 'wires', 400, 30, 'meter', 12, 21),
(7, 20, 'iron 4cm', 1000, 10, 'meter', 11, 16),
(11, 22, 'wires ', 80000, 69, 'meter', 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `senderID` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `message` text NOT NULL,
  `subject` text NOT NULL,
  `receiverID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acctype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `acctype`) VALUES
('khazbakkkkk', 'khazbakkhazbak', 'Engineer'),
('maria', 'mariamaria', 'Technical Manager'),
('noran', 'norannoran', 'Engineer'),
('zahwa', 'zahwazahwa', 'Contract Manager'),
('zeyad', 'zeyadzeyad', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountype`
--
ALTER TABLE `accountype`
  ADD PRIMARY KEY (`acctype`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contractID`),
  ADD KEY `Eng-ID` (`engID`),
  ADD KEY `creator null` (`creatorID`);

--
-- Indexes for table `invoicedescriptionamount`
--
ALTER TABLE `invoicedescriptionamount`
  ADD PRIMARY KEY (`invoiceID`,`contractID`) USING BTREE,
  ADD KEY `contractiddesamount` (`contractID`) USING BTREE;

--
-- Indexes for table `invoicedescriptionitems`
--
ALTER TABLE `invoicedescriptionitems`
  ADD PRIMARY KEY (`invoiceID`,`itemID`) USING BTREE,
  ADD KEY `itemID` (`itemID`),
  ADD KEY `foreignkey` (`contractID`,`invoiceID`) USING BTREE;

--
-- Indexes for table `invoicesummary`
--
ALTER TABLE `invoicesummary`
  ADD PRIMARY KEY (`summaryID`),
  ADD KEY `FOREIGN KEY` (`contractID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `Contract-Id` (`contractID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `FOREIGN KEY` (`receiverID`) USING BTREE,
  ADD KEY `FOREIGN KEYY` (`senderID`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `acctype` (`acctype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contractID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invoicesummary`
--
ALTER TABLE `invoicesummary`
  MODIFY `summaryID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `creator null` FOREIGN KEY (`creatorID`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `engineer null` FOREIGN KEY (`engID`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoicedescriptionamount`
--
ALTER TABLE `invoicedescriptionamount`
  ADD CONSTRAINT `contractiddesamount` FOREIGN KEY (`contractID`) REFERENCES `contract` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoicedescriptionitems`
--
ALTER TABLE `invoicedescriptionitems`
  ADD CONSTRAINT `contractidindesitem` FOREIGN KEY (`contractID`) REFERENCES `contract` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoicedescriptionitems_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`),
  ADD CONSTRAINT `invoicedescriptionitems_ibfk_2` FOREIGN KEY (`invoiceID`) REFERENCES `invoicedescriptionamount` (`invoiceID`);

--
-- Constraints for table `invoicesummary`
--
ALTER TABLE `invoicesummary`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`contractID`) REFERENCES `contract` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`contractID`) REFERENCES `contract` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`receiverID`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`senderID`) REFERENCES `user` (`username`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`acctype`) REFERENCES `accountype` (`acctype`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
