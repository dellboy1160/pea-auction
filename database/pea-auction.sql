-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 03:34 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pea-auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$WFHlp9WFIiknZHr9Bur13uGR7Rpcf7/fnbKSLKDB3uL.GaEqK/IGW');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `auctionID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `auctionTitle` varchar(100) NOT NULL,
  `auctionStartDate` datetime NOT NULL,
  `auctionEndDate` datetime NOT NULL,
  `auctionStartPrice` varchar(100) NOT NULL,
  `auctionDetail` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `dateUnactive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auctionID`, `auctionTitle`, `auctionStartDate`, `auctionEndDate`, `auctionStartPrice`, `auctionDetail`, `status`, `dateUnactive`) VALUES
(000047, 'ประมูลมิเตอร์', '2022-01-23 08:30:00', '2022-01-27 16:30:00', '1900', 'ประมูลมิเตอร์เก่าชำรุด จำนวน 3 รายการ', 'unActive', '2022-01-27 10:11:34'),
(000051, 'ประมูลมิเตอร์เก่าชำรุด', '2022-02-28 09:27:00', '2022-03-05 09:27:00', '1500', 'ประมูลมิเตอร์เก่าชำรุด จำนวน 3 รายการ', 'active', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `auction_detail`
--

CREATE TABLE `auction_detail` (
  `detailID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `auctionID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(6) NOT NULL,
  `signDate` datetime NOT NULL,
  `idCardImage` varchar(100) NOT NULL,
  `commercialRegistrationImage` varchar(100) NOT NULL,
  `auctionDetailStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction_detail`
--

INSERT INTO `auction_detail` (`detailID`, `auctionID`, `user_id`, `signDate`, `idCardImage`, `commercialRegistrationImage`, `auctionDetailStatus`) VALUES
(000145, 000049, 73, '2022-02-18 09:27:54', '16451512751.png', '', 'check'),
(000146, 000051, 69, '2022-02-28 15:32:05', '16460371261.jpg', '', 'check');

-- --------------------------------------------------------

--
-- Table structure for table `auction_image`
--

CREATE TABLE `auction_image` (
  `imageID` int(6) NOT NULL,
  `auctionID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `imageFile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction_image`
--

INSERT INTO `auction_image` (`imageID`, `auctionID`, `imageFile`) VALUES
(138, 000040, '1642385770600600p13231EDNmain24798.jpg'),
(139, 000040, '1642385770600600p13231EDNmain106135.jpg'),
(140, 000040, '1642385770600600p13231EDNmain112206.jpg'),
(141, 000042, '1642565053600600p13231EDNmain24798.jpg'),
(142, 000042, '1642565053600600p13231EDNmain106135.jpg'),
(143, 000042, '1642565053600600p13231EDNmain112206.jpg'),
(144, 000044, '1642747129600600p13231EDNmain24798.jpg'),
(145, 000044, '1642747129600600p13231EDNmain106135.jpg'),
(146, 000044, '1642747129600600p13231EDNmain112206.jpg'),
(147, 000045, '1642991602600600p13231EDNmain24798.jpg'),
(148, 000045, '1642991602600600p13231EDNmain106135.jpg'),
(149, 000045, '1642991602600600p13231EDNmain112206.jpg'),
(150, 000047, '1643252037600600p13231EDNmain24798.jpg'),
(151, 000047, '1643252037600600p13231EDNmain106135.jpg'),
(152, 000047, '1643252037600600p13231EDNmain112206.jpg'),
(153, 000048, '1643599099600600p13231EDNmain24798.jpg'),
(154, 000048, '1643599099600600p13231EDNmain106135.jpg'),
(155, 000048, '1643599099600600p13231EDNmain112206.jpg'),
(156, 000049, '1645080075A1.png'),
(157, 000049, '1645080075D1.png'),
(158, 000049, '1645080075D2.png'),
(159, 000051, '1646036220600600p13231EDNmain24798.jpg'),
(160, 000051, '1646036220600600p13231EDNmain106135.jpg'),
(161, 000051, '1646036220600600p13231EDNmain112206.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bankID` int(10) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankHolder` varchar(100) NOT NULL,
  `bankNumber` varchar(100) NOT NULL,
  `QRCode_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bankID`, `bankName`, `bankHolder`, `bankNumber`, `QRCode_image`) VALUES
(24, 'ไทยพาณิชย์', 'ประมูลมิเตอร์', '4089641843', '1645080045.png');

-- --------------------------------------------------------

--
-- Table structure for table `document_announce`
--

CREATE TABLE `document_announce` (
  `documentID` int(10) NOT NULL,
  `documentTitle` varchar(100) NOT NULL,
  `documentFile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_announce`
--

INSERT INTO `document_announce` (`documentID`, `documentTitle`, `documentFile`) VALUES
(72, 'ใบประกาศขาย', '1646034315.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `document_offerprice`
--

CREATE TABLE `document_offerprice` (
  `documentID` int(6) NOT NULL,
  `documentTitle` varchar(100) NOT NULL,
  `documentFile` varchar(100) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_offerprice`
--

INSERT INTO `document_offerprice` (`documentID`, `documentTitle`, `documentFile`, `startDate`, `endDate`) VALUES
(19, 'ใบเสนอราคา', '1646034328.pdf', '2022-02-28 14:45:00', '2022-03-05 14:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `offer_price`
--

CREATE TABLE `offer_price` (
  `offerID` int(6) NOT NULL,
  `detailID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `auctionID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `offerPriceDocImage` varchar(100) NOT NULL,
  `offerPriceDocImage2` varchar(100) NOT NULL,
  `offerPriceDocImage3` varchar(100) NOT NULL,
  `paymentImage` varchar(100) NOT NULL,
  `offerDate` datetime NOT NULL,
  `paymentStatus` varchar(100) NOT NULL,
  `auctionStatus` varchar(100) NOT NULL,
  `announceWonDate` date NOT NULL,
  `refundPaymentImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer_price`
--

INSERT INTO `offer_price` (`offerID`, `detailID`, `auctionID`, `offerPriceDocImage`, `offerPriceDocImage2`, `offerPriceDocImage3`, `paymentImage`, `offerDate`, `paymentStatus`, `auctionStatus`, `announceWonDate`, `refundPaymentImage`) VALUES
(107, 000146, 000051, '16460372041.png', '16460372042.png', '16460372043.png', '16460372044.jpg', '2022-02-28 15:33:24', 'check', 'won', '2022-02-28', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `line` varchar(100) NOT NULL,
  `Fname` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankHolder` varchar(100) NOT NULL,
  `bankNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `phone`, `line`, `Fname`, `Lname`, `bankName`, `bankHolder`, `bankNumber`) VALUES
(69, 'dellboy', '$2y$10$iXqGsvAGBM.vVVBsOcTDDO1bkRLtFz0vRbKZKjd2Oq5dTJL.ittMW', '091407069', '', 'สุทธิพงศ์', 'รักหนองแซง', 'test', 'testtest', 'test'),
(74, 'user', '$2y$10$85llDHczmcL096IM5e2GDu4njfEgKrvuz0OyzLDTdJDAoZleyRzYy', '0924070069', 'asd', 'asd', 'asd', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auctionID`);

--
-- Indexes for table `auction_detail`
--
ALTER TABLE `auction_detail`
  ADD PRIMARY KEY (`detailID`);

--
-- Indexes for table `auction_image`
--
ALTER TABLE `auction_image`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bankID`);

--
-- Indexes for table `document_announce`
--
ALTER TABLE `document_announce`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `document_offerprice`
--
ALTER TABLE `document_offerprice`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `offer_price`
--
ALTER TABLE `offer_price`
  ADD PRIMARY KEY (`offerID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `auctionID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `auction_detail`
--
ALTER TABLE `auction_detail`
  MODIFY `detailID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `auction_image`
--
ALTER TABLE `auction_image`
  MODIFY `imageID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bankID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `document_announce`
--
ALTER TABLE `document_announce`
  MODIFY `documentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `document_offerprice`
--
ALTER TABLE `document_offerprice`
  MODIFY `documentID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `offer_price`
--
ALTER TABLE `offer_price`
  MODIFY `offerID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
