--
-- Database: `gemology_central_db`
--

-- --------------------------------------------------------

--
-- Table structure for `Lab Report`
--
CREATE TABLE IF NOT EXISTS `tbl_lab_report` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `rep_customerID` varchar(11) DEFAULT NULL,
  `rep_date` date NOT NULL,
  `rep_gemID` int(11) DEFAULT NULL,
  `rep_object` varchar(100) NOT NULL,
  `rep_identification` varchar(100) NOT NULL,
  `rep_type` varchar(04) NOT NULL,
  `rep_imagename` text NOT NULL,
  `rep_weight` decimal(4,2) NOT NULL,
  `rep_gemWidth` decimal(4,2) NOT NULL,
  `rep_gemHeight` decimal(4,2) NOT NULL,
  `rep_gemLength` decimal(4,2) NOT NULL,
  `rep_cut` varchar(100) NOT NULL,
  `rep_shape` varchar(30) NOT NULL,
  `rep_color` varchar(30) NOT NULL,
  `rep_comment` varchar(200) NOT NULL,
  `rep_other` varchar(200) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Memo Card`
--
CREATE TABLE IF NOT EXISTS `tbl_gem_memocard` (
  `memoid`  varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `mem_date` date NOT NULL,
  `mem_paymentStatus` tinyint(1) NOT NULL DEFAULT 0,
  `mem_amount` decimal(8,2) NOT NULL,
  PRIMARY KEY (`memoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Gemstone Report`
--
CREATE TABLE IF NOT EXISTS `tbl_gemstone_report` (
  `gsrid` varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `gsr_date` date NOT NULL,
  `gsr_paymentStatus` tinyint(1) NOT NULL DEFAULT 0,
  `gsr_amount` decimal(8,2) NOT NULL,
  PRIMARY KEY (`gsrid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for `Verbal Gemstone Report`
--
CREATE TABLE IF NOT EXISTS `tbl_gem_verbal` (
  `verbid`  varchar(20) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `veb_date` date NOT NULL,
  PRIMARY KEY (`verbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
