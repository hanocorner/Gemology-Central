--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for `Customer`
--

CREATE TABLE `tbl_customer` (
  `custid` int(6) ZEROFILL NOT NULL AUTO_INCREMENT,
  `cus_firstname` varchar(30) NOT NULL,
  `cus_lastname` varchar(30) NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_number` varchar(30) NOT NULL,
  `cus_address` varchar(50) NOT NULL,
  `cus_NIC` varchar(10) NOT NULL,
  PRIMARY KEY (`custid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Lab Report`
--
CREATE TABLE `tbl_labReport` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `rep_customerID` int(11) DEFAULT NULL,
  `rep_date` date NOT NULL,
  `rep_gemID` int(11) DEFAULT NULL,
  `rep_object` varchar(100) NOT NULL,
  `rep_type` varchar(20) NOT NULL,
  `rep_imagename` text NOT NULL,
  `rep_weight` decimal(4,2) NOT NULL,
  `rep_gemWidth` decimal(4,2) NOT NULL,
  `rep_gemHeight` decimal(4,2) NOT NULL,
  `rep_gemLength` decimal(4,2) NOT NULL,
  `rep_cut` varchar(100) NOT NULL,
  `rep_shape` varchar(30) NOT NULL,
  `rep_color` varchar(30) NOT NULL,
  `rep_comment` varchar(200) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Gem Details`
--
CREATE TABLE `tbl_gem` (
  `gemid` int(11) NOT NULL AUTO_INCREMENT,
  `gem_name` varchar(30) NOT NULL,
  `gem_description` varchar(30) NOT NULL,
  PRIMARY KEY (`gemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Memo Card`
--
CREATE TABLE `tbl_gemMemoCard` (
  `memoid` int(11) NOT NULL AUTO_INCREMENT,
  `reportid` int(11) DEFAULT NULL,
  `mem_date` date NOT NULL,
  `mem_paymentStatus` tinyint(1) NOT NULL DEFAULT 0,
  `mem_amount` decimal(4,2) NOT NULL,
  PRIMARY KEY (`memoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Gemstone Report`
--
CREATE TABLE `tbl_gemstoneReport` (
  `gsrid` int(11) NOT NULL AUTO_INCREMENT,
  `reportid` int(11) DEFAULT NULL,
  `gsr_date` date NOT NULL,
  `gsr_paymentStatus` tinyint(1) NOT NULL DEFAULT 0,
  `gsr_amount` decimal(4,2) NOT NULL,
  PRIMARY KEY (`memoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
