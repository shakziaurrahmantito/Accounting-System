-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 12:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountingsystem`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectbusiness_type` ()  BEGIN
	SELECT * FROM business_type ORDER BY `Business_type_id` DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectcompany_type` ()  BEGIN
	SELECT * FROM company_type ORDER BY type_id DESC;  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branch_id` int(11) NOT NULL,
  `Company_id` varchar(50) DEFAULT NULL,
  `Country_id` varchar(50) DEFAULT NULL,
  `City_id` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Company_registration_no` varchar(50) DEFAULT NULL,
  `Registration_doc` varchar(255) DEFAULT NULL,
  `Tin` varchar(255) DEFAULT NULL,
  `Tin_doc` varchar(255) DEFAULT NULL,
  `Vat` varchar(50) DEFAULT NULL,
  `Vat_doc` varchar(255) DEFAULT NULL,
  `Trade_license` varchar(255) DEFAULT NULL,
  `Company_logo` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branch_id`, `Company_id`, `Country_id`, `City_id`, `Address`, `Phone`, `Company_registration_no`, `Registration_doc`, `Tin`, `Tin_doc`, `Vat`, `Vat_doc`, `Trade_license`, `Company_logo`) VALUES
(1, '1', 'Bangladesh', '1', 'Motijhil C/A', '89745858558', '1222224785', NULL, '4589658', NULL, '20', NULL, '4785978488', 0x75706c6f6164732f363162663037613530353631622e706e67),
(2, '1', 'Bangladesh', '2', 'Saturia/Manikganj', '97858485855', '1222224785', NULL, '4589658', NULL, '20', NULL, '4785978489', 0x75706c6f6164732f363162646530323230623339642e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `Budget_id` int(11) NOT NULL,
  `Branch_id` varchar(50) DEFAULT NULL,
  `Group_id` varchar(50) DEFAULT NULL,
  `Sub_group_id` varchar(50) DEFAULT NULL,
  `Posting_head_id` varchar(50) DEFAULT NULL,
  `Budget_type` varchar(50) DEFAULT NULL,
  `Month` varchar(50) DEFAULT NULL,
  `Amount` varchar(50) DEFAULT NULL,
  `User_id` varchar(10) DEFAULT NULL,
  `Date_time` datetime DEFAULT current_timestamp(),
  `Createion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`Budget_id`, `Branch_id`, `Group_id`, `Sub_group_id`, `Posting_head_id`, `Budget_type`, `Month`, `Amount`, `User_id`, `Date_time`, `Createion_date`) VALUES
(1, '1', '6', '10', '1', 'Year', '2021-12', '1000', '3', '2021-12-19 15:48:09', '2021-12-19'),
(2, '2', '2', '4', '5', 'Year', '2021-12', '10000', '3', '2021-12-19 15:48:31', '2021-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `Business_type_id` int(11) NOT NULL,
  `Business_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`Business_type_id`, `Business_type`) VALUES
(1, 'Corporate'),
(2, 'Private'),
(3, 'Partnership');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company_id` int(11) NOT NULL,
  `Company_type_id` varchar(50) DEFAULT NULL,
  `Business_type_id` varchar(50) DEFAULT NULL,
  `Country_name` varchar(50) DEFAULT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Company_registration_no` varchar(50) DEFAULT NULL,
  `Registration_doc` varchar(255) DEFAULT '0',
  `Tin` varchar(255) DEFAULT NULL,
  `Tin_doc` varchar(255) DEFAULT '0',
  `Vat` varchar(50) DEFAULT NULL,
  `Vat_doc` varchar(255) DEFAULT '0',
  `Trade_license` varchar(255) DEFAULT NULL,
  `Company_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_id`, `Company_type_id`, `Business_type_id`, `Country_name`, `Company_name`, `Address`, `Phone`, `Company_registration_no`, `Registration_doc`, `Tin`, `Tin_doc`, `Vat`, `Vat_doc`, `Trade_license`, `Company_logo`) VALUES
(1, '2', '3', 'Bangladesh', 'ERP', 'Dhaka/Bangladesh', '98574585855', 'AS-4585855', '12', '857458578997', '0', '20', '0', 'BD-456789555', 'uploads/61bf07a50561b.png');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `type_id` int(11) NOT NULL,
  `company_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`type_id`, `company_type`) VALUES
(1, 'LTD'),
(2, 'Private'),
(3, 'Associate'),
(4, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countrycity`
--

CREATE TABLE `countrycity` (
  `c_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countrycity`
--

INSERT INTO `countrycity` (`c_id`, `country_name`, `city_name`) VALUES
(1, 'Bangladesh', 'Dhaka-1200'),
(2, 'Bangladesh', 'Manikganj-1800'),
(3, 'Bangladesh', 'Savar');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `division_id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lon` varchar(15) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd'),
(2, 1, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd'),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd'),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', '22.65561018', '92.17541121', 'www.rangamati.gov.bd'),
(5, 1, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd'),
(6, 1, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd'),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd'),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd'),
(9, 1, 'Coxsbazar', 'কক্সবাজার', '21.44315751', '91.97381741', 'www.coxsbazar.gov.bd'),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd'),
(11, 1, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd'),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd'),
(13, 2, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd'),
(14, 2, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd'),
(15, 2, 'Rajshahi', 'রাজশাহী', '24.37230298', '88.56307623', 'www.rajshahi.gov.bd'),
(16, 2, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd'),
(17, 2, 'Joypurhat', 'জয়পুরহাট', '25.09636876', '89.04004280', 'www.joypurhat.gov.bd'),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd'),
(19, 2, 'Naogaon', 'নওগাঁ', '24.83256191', '88.92485205', 'www.naogaon.gov.bd'),
(20, 3, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd'),
(21, 3, 'Satkhira', 'সাতক্ষীরা', NULL, NULL, 'www.satkhira.gov.bd'),
(22, 3, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd'),
(23, 3, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd'),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd'),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd'),
(26, 3, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd'),
(27, 3, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd'),
(28, 3, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd'),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd'),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL, 'www.jhalakathi.gov.bd'),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd'),
(32, 4, 'Pirojpur', 'পিরোজপুর', NULL, NULL, 'www.pirojpur.gov.bd'),
(33, 4, 'Barisal', 'বরিশাল', NULL, NULL, 'www.barisal.gov.bd'),
(34, 4, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd'),
(35, 4, 'Barguna', 'বরগুনা', NULL, NULL, 'www.barguna.gov.bd'),
(36, 5, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd'),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd'),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd'),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd'),
(40, 6, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd'),
(41, 6, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd'),
(42, 6, 'Shariatpur', 'শরীয়তপুর', NULL, NULL, 'www.shariatpur.gov.bd'),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd'),
(44, 6, 'Tangail', 'টাঙ্গাইল', '24.26361358', '89.91794786', 'www.tangail.gov.bd'),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd'),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL, 'www.manikganj.gov.bd'),
(47, 6, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd'),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL, 'www.munshiganj.gov.bd'),
(49, 6, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd'),
(50, 6, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd'),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd'),
(52, 6, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd'),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd'),
(54, 7, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd'),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL, 'www.lalmonirhat.gov.bd'),
(56, 7, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd'),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd'),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd'),
(59, 7, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd'),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd'),
(61, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd'),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', '24.7465670', '90.4072093', 'www.mymensingh.gov.bd'),
(63, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd'),
(64, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year`
--

CREATE TABLE `fiscal_year` (
  `id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_type`
--

CREATE TABLE `group_type` (
  `group_type_id` int(11) NOT NULL,
  `group_type_name` varchar(255) DEFAULT NULL,
  `debit_credit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_type`
--

INSERT INTO `group_type` (`group_type_id`, `group_type_name`, `debit_credit`) VALUES
(1, 'Assets', 'dr'),
(2, 'Liabilities', 'cr'),
(3, 'Equity', 'cr');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_group`
--

CREATE TABLE `ledger_group` (
  `ledger_id` int(11) NOT NULL,
  `ledger_name` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_group`
--

INSERT INTO `ledger_group` (`ledger_id`, `ledger_name`, `group_id`) VALUES
(1, 'Current Assets', 1),
(2, 'Fixed Assets', 1),
(4, 'Shareholder Equity', 3),
(5, 'Contingent liabilities', 2),
(6, 'Non-current liabilities', 2),
(7, 'test', 1),
(8, 'Current Liabilities', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_posting_head`
--

CREATE TABLE `ledger_posting_head` (
  `ledger_posting_head_id` int(11) NOT NULL,
  `ledger_sub_group_id` varchar(255) DEFAULT NULL,
  `ledger_group_id` int(11) DEFAULT NULL,
  `posting_head_name` varchar(255) DEFAULT NULL,
  `posting_head_date` date DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_posting_head`
--

INSERT INTO `ledger_posting_head` (`ledger_posting_head_id`, `ledger_sub_group_id`, `ledger_group_id`, `posting_head_name`, `posting_head_date`, `status`) VALUES
(1, '10', 6, 'Internet Bill', '2021-12-18', 1),
(2, '10', 6, 'Electric Bill', '2021-12-18', 1),
(3, '1', 1, 'Cash on Hand', '2021-12-18', 1),
(4, '1', 1, 'Cash in bank', '2021-12-18', 1),
(5, '4', 2, 'Office Building', '2021-12-18', 1),
(6, '4', 2, 'Factory Building', '2021-12-18', 1),
(7, '4', 2, 'Warehouse', '2021-12-18', 1),
(8, '4', 2, 'Garage', '2021-12-18', 1),
(9, '6', 2, 'Chairs', '2021-12-18', 1),
(10, '6', 2, 'Desks', '2021-12-18', 1),
(11, '6', 2, 'Bookcases', '2021-12-18', 1),
(12, '11', 5, 'Income from Salary', '2021-12-19', 1),
(13, '11', 5, 'Income from House Property', '2021-12-19', 1),
(14, '8', 4, 'Sales Revenues', '2021-12-19', 1),
(15, '12', 7, 'Posting Head Test', '2021-12-19', 1),
(16, '14', 8, 'Bill Payable', '2021-12-21', 1),
(17, '14', 8, 'trade payables', '2021-12-21', 1),
(18, '14', 8, 'non-trade payables', '2021-12-21', 1),
(19, '14', 8, 'taxes payable', '2021-12-21', 1),
(20, '14', 8, 'loans payable', '2021-12-21', 1),
(21, '14', 8, 'wages payable', '2021-12-21', 1),
(22, '15', 8, 'Simple Interest', '2021-12-21', 1),
(23, '15', 8, 'Fixed Interest', '2021-12-21', 1),
(24, '15', 8, 'Variable Interest', '2021-12-21', 1),
(25, '16', 8, 'Payday Loans', '2021-12-21', 1),
(26, '16', 8, 'Merchant', '2021-12-21', 1),
(27, '16', 8, 'advances', '2021-12-21', 1),
(28, '17', 8, 'Income Taxes', '2021-12-21', 1),
(29, '18', 8, 'Bonus', '2021-12-21', 1),
(30, '18', 8, 'Depreciation Cost', '2021-12-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_sub_group`
--

CREATE TABLE `ledger_sub_group` (
  `ledger_sub_group_id` int(11) NOT NULL,
  `ledger_sub_group_name` varchar(255) DEFAULT NULL,
  `ledger_sub_group_date` date DEFAULT current_timestamp(),
  `ledger_sub_group_parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_sub_group`
--

INSERT INTO `ledger_sub_group` (`ledger_sub_group_id`, `ledger_sub_group_name`, `ledger_sub_group_date`, `ledger_sub_group_parent_id`) VALUES
(1, 'Cash', '2021-12-18', 1),
(2, 'Inventory', '2021-12-18', 1),
(3, 'Stock', '2021-12-18', 1),
(4, 'Buildings', '2021-12-18', 2),
(5, 'Land', '2021-12-18', 2),
(6, 'Furniture', '2021-12-18', 2),
(7, 'Common Stock', '2021-12-18', 4),
(8, 'Revenues', '2021-12-18', 4),
(9, 'Interest', '2021-12-18', 4),
(11, 'Vat', '2021-12-19', 5),
(12, 'Test Group', '2021-12-19', 7),
(13, 'Account Receivable', '2021-12-21', 1),
(14, 'Account Payable', '2021-12-21', 8),
(15, 'Interest payable.', '2021-12-21', 8),
(16, 'Short-term loans', '2021-12-21', 8),
(17, 'Income taxes payable.', '2021-12-21', 8),
(18, 'Accrued expenses', '2021-12-21', 8),
(19, 'Bonds payable', '2021-12-21', 6),
(20, 'Long-term notes payable', '2021-12-21', 6),
(21, 'Deferred tax liabilities', '2021-12-21', 6),
(22, 'Mortgage payable', '2021-12-21', 6),
(23, 'Capital leases', '2021-12-21', 6),
(24, 'Lawsuits', '2021-12-21', 5),
(25, 'Product warranties', '2021-12-21', 5);

-- --------------------------------------------------------

--
-- Table structure for table `log_table`
--

CREATE TABLE `log_table` (
  `Log_id` int(11) NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Login_time` time DEFAULT current_timestamp(),
  `Logout_time` varchar(20) DEFAULT NULL,
  `RecentDate` date DEFAULT current_timestamp(),
  `User_ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_table`
--

INSERT INTO `log_table` (`Log_id`, `User_id`, `Login_time`, `Logout_time`, `RecentDate`, `User_ip`) VALUES
(1, 3, '20:52:36', '08:52:42 PM', '2021-12-18', '::1'),
(2, 3, '20:52:48', '09:41:55 PM', '2021-12-18', '::1'),
(3, 3, '09:42:36', '09:42:45 AM', '2021-12-19', '::1'),
(4, 4, '09:44:18', '09:49:13 AM', '2021-12-19', '::1'),
(5, 4, '14:10:32', '02:15:47 PM', '2021-12-19', '::1'),
(6, 3, '14:15:51', '02:56:40 PM', '2021-12-19', '::1'),
(7, 3, '15:16:20', '03:50:11 PM', '2021-12-19', '::1'),
(8, 5, '15:18:02', '03:18:12 PM', '2021-12-19', '127.0.0.1'),
(9, 5, '15:18:16', '03:18:18 PM', '2021-12-19', '127.0.0.1'),
(10, 6, '15:18:51', '03:18:55 PM', '2021-12-19', '127.0.0.1'),
(11, 5, '15:19:02', '03:19:04 PM', '2021-12-19', '127.0.0.1'),
(12, 3, '16:00:38', '04:17:52 PM', '2021-12-19', '::1'),
(13, 3, '16:18:13', '04:26:26 PM', '2021-12-19', '::1'),
(14, 3, '16:26:45', '04:26:51 PM', '2021-12-19', '::1'),
(15, 3, '16:59:52', '07:32:40 PM', '2021-12-19', '::1'),
(16, 3, '22:01:12', NULL, '2021-12-19', '::1'),
(17, 3, '10:33:10', NULL, '2021-12-20', '::1'),
(18, 3, '11:51:16', NULL, '2021-12-20', '::1'),
(19, 3, '14:56:52', '06:14:38 PM', '2021-12-20', '::1'),
(20, 3, '18:14:55', '06:15:28 PM', '2021-12-20', '::1'),
(21, 3, '18:25:13', '07:00:08 PM', '2021-12-20', '::1'),
(22, 3, '12:13:23', NULL, '2021-12-21', '::1'),
(23, 3, '15:00:39', NULL, '2021-12-21', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `opening_balance`
--

CREATE TABLE `opening_balance` (
  `Sl` int(11) NOT NULL,
  `Voucher_no` varchar(50) DEFAULT NULL,
  `ledger_id` varchar(50) DEFAULT NULL,
  `Sub_group_id` varchar(50) DEFAULT NULL,
  `Posting_head_id` varchar(50) DEFAULT NULL,
  `Op_date` date DEFAULT current_timestamp(),
  `Debit_credit` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `bl_type` varchar(50) DEFAULT NULL,
  `Date_time` datetime DEFAULT current_timestamp(),
  `Createion_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opening_balance`
--

INSERT INTO `opening_balance` (`Sl`, `Voucher_no`, `ledger_id`, `Sub_group_id`, `Posting_head_id`, `Op_date`, `Debit_credit`, `Amount`, `bl_type`, `Date_time`, `Createion_date`) VALUES
(1, 'B12021120000', '6', '10', '1', '2021-12-21', 'cr', '100.00', NULL, '2021-12-21 12:55:48', '2021-12-21'),
(2, 'B12021120000', '6', '10', '3', '2021-12-21', 'dr', '100.00', NULL, '2021-12-21 12:55:51', '2021-12-21'),
(3, 'B12021120001', '1', '1', '3', '2021-12-21', 'dr', '2000.00', NULL, '2021-12-21 12:57:48', '2021-12-21'),
(4, 'B12021120001', '1', '1', '2', '2021-12-21', 'cr', '2000.00', NULL, '2021-12-21 12:57:51', '2021-12-21'),
(5, 'B12021120002', '2', '4', '5', '2021-12-21', 'dr', '4000.00', NULL, '2021-12-21 13:06:55', '2021-12-21'),
(6, 'B12021120002', '2', '4', '16', '2021-12-21', 'cr', '4000.00', NULL, '2021-12-21 13:06:57', '2021-12-21'),
(7, 'B22021120000', '4', '8', '14', '2021-12-21', 'cr', '450000.00', NULL, '2021-12-21 13:08:33', '2021-12-21'),
(8, 'B22021120000', '4', '8', '4', '2021-12-21', 'dr', '450000.00', NULL, '2021-12-21 13:08:35', '2021-12-21'),
(9, 'B12021120003', '8', '14', '16', '2021-12-21', 'cr', '1000.00', NULL, '2021-12-21 13:48:47', '2021-12-21'),
(10, 'B12021120003', '8', '14', '26', '2021-12-21', 'dr', '1000.00', NULL, '2021-12-21 13:48:49', '2021-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `account_creation_date` date DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1,
  `user_image` varchar(255) NOT NULL,
  `otp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `full_name`, `email`, `phone`, `password`, `role_id`, `account_creation_date`, `status`, `user_image`, `otp`) VALUES
(3, 'jiya', 'Md. Ziaur Rahman', 'shakziaurrahmantito@gmail.com', '01798659666', 'e10adc3949ba59abbe56e057f20f883e', '1', '2021-11-20', 1, 'uploads/fc4351b97fa49bd3c753f7280fb3785c.jpg', ''),
(4, 'saadrabbani', 'Saad Rabbani', 'saadbinrabbani@gmail.com', '01738707539', 'e10adc3949ba59abbe56e057f20f883e', '2', '2021-11-21', 1, 'uploads/4d7ce5256068cdd2cf52767b5fdfed3a.jpg', ''),
(5, 'rafsantaher', 'Rafsan Taher', 'rafsantaher13@gmail.com', '01798659666', '202cb962ac59075b964b07152d234b70', '2', '2021-11-21', 1, 'uploads/68361a83ef881818eec89695a3539df8.jpg', ''),
(6, 'mdmostakimhossain', 'Md Mostakims Hossain', 'mdmustak2456@gmail.com', '01798659666', '202cb962ac59075b964b07152d234b70', '3', '2021-11-21', 0, 'uploads/6141329ec857e0ca8f33cfb2cc899ef4.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `sl_no` int(11) NOT NULL,
  `voucher_no` varchar(50) DEFAULT NULL,
  `voucher_date` date DEFAULT current_timestamp(),
  `group_id` int(10) DEFAULT NULL,
  `ledger_id` int(11) NOT NULL,
  `sub_goup_id` int(10) DEFAULT NULL,
  `phosting_head_id` int(10) DEFAULT NULL,
  `debit_amount` varchar(255) DEFAULT NULL,
  `Credit_amount` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `entry_datetime` datetime DEFAULT current_timestamp(),
  `branch_id` int(10) DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  `check_no` varchar(255) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `voucher_type` varchar(255) DEFAULT NULL,
  `prepared_by` varchar(255) DEFAULT NULL,
  `modify_count` int(100) DEFAULT 0,
  `voucher_status` varchar(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`sl_no`, `voucher_no`, `voucher_date`, `group_id`, `ledger_id`, `sub_goup_id`, `phosting_head_id`, `debit_amount`, `Credit_amount`, `user_id`, `entry_datetime`, `branch_id`, `company_id`, `check_no`, `check_date`, `voucher_type`, `prepared_by`, `modify_count`, `voucher_status`) VALUES
(1, 'B12021120000', '2021-12-21', 2, 6, 10, 1, NULL, '100', 0, '2021-12-21 12:55:27', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '3', 'jiya', 0, '0'),
(2, 'B12021120000', '2021-12-21', 2, 6, 10, 3, '100', NULL, 0, '2021-12-21 12:55:27', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(3, 'B12021120001', '2021-12-21', 1, 1, 1, 3, '2000', NULL, 0, '2021-12-21 12:57:43', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '2', 'jiya', 0, '0'),
(4, 'B12021120001', '2021-12-21', 1, 1, 1, 2, NULL, '2000', 0, '2021-12-21 12:57:43', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(5, 'B12021120002', '2021-12-21', 1, 2, 4, 5, '4000', NULL, 0, '2021-12-21 13:06:47', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '2', 'jiya', 0, '0'),
(6, 'B12021120002', '2021-12-21', 1, 2, 4, 16, NULL, '4000', 0, '2021-12-21 13:06:47', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(7, 'B22021120000', '2021-12-21', 3, 4, 8, 14, NULL, '450000', 0, '2021-12-21 13:08:27', 2, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(8, 'B22021120000', '2021-12-21', 3, 4, 8, 4, '450000', NULL, 0, '2021-12-21 13:08:27', 2, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(9, 'B12021120003', '2021-12-21', 2, 8, 14, 16, NULL, '1000', 0, '2021-12-21 13:48:42', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', '4', 'jiya', 0, '0'),
(10, 'B12021120003', '2021-12-21', 2, 8, 14, 26, '1000', NULL, 0, '2021-12-21 13:48:42', 1, 1, 'xxxx-xxxxx-xxxxx', '2021-12-21', 'in', 'jiya', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_type`
--

CREATE TABLE `voucher_type` (
  `voucher_type_id` int(11) NOT NULL,
  `voucher_type_name` varchar(40) NOT NULL,
  `voucher_type_nature` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher_type`
--

INSERT INTO `voucher_type` (`voucher_type_id`, `voucher_type_name`, `voucher_type_nature`) VALUES
(1, 'Cash Payment', 'out'),
(2, 'Bank Payment', 'out'),
(3, 'Cash Sales', 'in'),
(4, 'Bank Sales', 'in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`Budget_id`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`Business_type_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_id`);

--
-- Indexes for table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `countrycity`
--
ALTER TABLE `countrycity`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_type`
--
ALTER TABLE `group_type`
  ADD PRIMARY KEY (`group_type_id`);

--
-- Indexes for table `ledger_group`
--
ALTER TABLE `ledger_group`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `ledger_posting_head`
--
ALTER TABLE `ledger_posting_head`
  ADD PRIMARY KEY (`ledger_posting_head_id`);

--
-- Indexes for table `ledger_sub_group`
--
ALTER TABLE `ledger_sub_group`
  ADD PRIMARY KEY (`ledger_sub_group_id`);

--
-- Indexes for table `log_table`
--
ALTER TABLE `log_table`
  ADD PRIMARY KEY (`Log_id`);

--
-- Indexes for table `opening_balance`
--
ALTER TABLE `opening_balance`
  ADD PRIMARY KEY (`Sl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `voucher_type`
--
ALTER TABLE `voucher_type`
  ADD PRIMARY KEY (`voucher_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `Branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `Budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `Business_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countrycity`
--
ALTER TABLE `countrycity`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_type`
--
ALTER TABLE `group_type`
  MODIFY `group_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledger_group`
--
ALTER TABLE `ledger_group`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ledger_posting_head`
--
ALTER TABLE `ledger_posting_head`
  MODIFY `ledger_posting_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ledger_sub_group`
--
ALTER TABLE `ledger_sub_group`
  MODIFY `ledger_sub_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `log_table`
--
ALTER TABLE `log_table`
  MODIFY `Log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `opening_balance`
--
ALTER TABLE `opening_balance`
  MODIFY `Sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `voucher_type`
--
ALTER TABLE `voucher_type`
  MODIFY `voucher_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
